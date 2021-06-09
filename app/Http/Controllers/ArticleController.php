<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Models\ArticleImage;
use Illuminate\Http\Request;
use App\Jobs\GoogleVisionWaterMark;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ArticleRequest;
use App\Jobs\GoogleVisionRemoveFaces;
use Intervention\Image\Facades\Image;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show','index','search_results']);

        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(6);
        View::share('articles',$articles);
    }

    public function index(Category $cate)
    {

        $articles_category =Article::where('is_accepted', true)->where('category_id',$cate->id)->orderBy('created_at', 'desc')->paginate(6);
        $category = $cate;
        return view ('article.index', compact('category','articles_category'));
    }

    public function create(Request $request)
    {
        $uniqueSecret = $request->old('uniqueSecret',base_convert(sha1(uniqid(mt_rand())), 16, 36));
        return view ('article.create',compact('uniqueSecret'));
    }

    public function uploadImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120
        ));

        session()->push("images.{$uniqueSecret}", $fileName);

        return response()->json(
            [
                'id' => $fileName
            ]
        );
    }

    public function removeImages(Request $request){

        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->input('id');
        session()->push("removedimages.{$uniqueSecret}",$fileName);
        Storage::delete($fileName);
        return response()->json('ok');
    }

    public function oldImages(Request $request){

        $uniqueSecret = $request->input('uniqueSecret');
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
        $images = array_diff($images,$removedImages);
        $data = [];
        foreach ($images as $image) {
            $data[]=[
                'id'=>$image,
                'src'=>ArticleImage::getUrlByFilePath($image, 120, 120)
            ];
        }

        return response()->json($data);
    }

    public function store(ArticleRequest $request)
    {
        $categories = Category::all();
        $category_name="";
        foreach ($categories as $category) {
            if($category->id == $request->category){
                $category_name = $category->name;
            }
        }
        $article = Article::create([
            'title'=> $request->title,
            'body'=> $request->body,
            'category_id'=>$request->category,
            'category_name'=>$category_name,
            'price'=>$request->price,
            'user_id'=>Auth::id()

        ]);

        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []);

        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images,$removedImages);

        foreach ($images as $image) {
            $fileName = basename($image);
            $newFileName = "public/articles/{$article->id}/{$fileName}";
            Storage::move($image,$newFileName);

            $i = ArticleImage::create([
                'file'=> $newFileName,
                'article_id'=> $article->id,
            ]);

            GoogleVisionSafeSearchImage::withChain(
                [new GoogleVisionLabelImage($i->id),
                 new GoogleVisionRemoveFaces($i->id),
                new ResizeImage(
                    $newFileName,
                    200,
                    200
                ),
                new ResizeImage(
                    $newFileName,
                    500,
                    500
                )
                ])->dispatch($i->id);
        }

        Storage::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        return redirect()->back()->with('message','Complimenti, annuncio creato con successo!');
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    public function preferite(Request $request, Article $article){
        $message="Complimenti, hai aggiunto il prodotto ai preferiti";
        $button="Unsave";
        if ($article->preferite->isEmpty()) {
            $article->preferite()->attach(Auth::id());
        }
        foreach ($article->preferite as $preferite) {
            if($preferite->pivot->article_id==$article->id){
                $article->preferite()->detach(Auth::id());
                $message="Complimenti, hai eliminato il prodotto dai preferiti";
                $button="Save";
                break;
            }else{
                $article->preferite()->attach(Auth::id());
                break;
            }
        }
        return redirect()->back()->with('message',$message)->with('button',$button);
    }

    public function preferiteShow(Article $article){
        $articles= Auth::user()->articlesPreferite;
        return view('user.preferite',compact('articles'));
    }

}
