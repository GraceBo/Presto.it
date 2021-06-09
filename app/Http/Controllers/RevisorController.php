<?php

namespace App\Http\Controllers;


use App\Models\Article;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
    }

    public function index()
    {

        $article = Article::where('is_accepted', null)->orderBy('created_at', 'asc')->first();

        return view('revisor.index', compact('article'));
    }

    private function setAccepted($article, $value)
    {
        $article_id = $article->id;
        $article = Article::find($article_id);
        $article -> is_accepted = $value;
        $article ->save();
        return redirect(route('revisor.index'));
    }

    public function accepted(Article $article)
    {
        return $this->setAccepted($article, true);
    }

    public function rejected(Article $article)
    {
        return $this->setAccepted($article, false);
    }

    public function undo(Article $article)
    {
        return $this->setAccepted($article, null);
    }

    public function bin()
    {
        $articles = Article::where('is_accepted', false)->orderBy('created_at', 'asc')->get();

         return view('revisor.bin', compact('articles'));
     
    }

    public function delete(Article $article)
    {
       $article->delete();
       return redirect(route('revisor.bin'))->with('message', 'Articolo eliminato con successo');
    }

    //viste index e bin
}
