<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ArticleImage extends Model
{
    use HasFactory;

    protected $fillable = ['file','article_id','labels','adult','spoof','medical','violence','racy'];

    protected $casts = [
        'labels'=>'array'
    ];

    public function article(){
        return $this->belongsTo(Article::class);
    }

    static public function getUrlByFilePath($filePath, $width = null, $height = null)
    {
        if(!$width && !$height)
        {
            return Storage::url($filePath);
        }

        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop{$width}x{$height}_{$filename}";

        return Storage::url($file);
    }

    public function getUrl($width = null, $height = null)
    {
        return ArticleImage::getUrlByFilePath($this->file, $width, $height);
    }
}
