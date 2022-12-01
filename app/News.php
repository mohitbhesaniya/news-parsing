<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'source', 'author', 'title', 'description','url', 'urlToImage', 'publishedAt', 'content'
    ];
}
