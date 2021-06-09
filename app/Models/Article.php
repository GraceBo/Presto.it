<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    use HasFactory;
    protected $fillable = ['title', 'body','category_id', 'price', 'user_id','category_name'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    static public function notifyArticlesForRevisor(){
        return Article::where('is_accepted', null)->count();
    }

    public function customTitle(Article $article, $num){
        if(strlen($article->title)>$num){
            $article->title = substr($article->title, 0, -(strlen($article->title)-$num))."...";
        }

        return $article->title;

    }

    public function images(){
        return $this->hasMany(ArticleImage::class);
    }

    public function toSearchableArray()
    {
        $array = [
            'id'=> $this->id,
            'title'=> $this->title,
            'body'=> $this->body,
            'category_name'=> $this->category_name,
            'altro' => 'pippo',
        ];

        // Customize the data array...

        return $array;
    }
    public function preferite(){
        return $this->belongsToMany(User::class);
    }
}
