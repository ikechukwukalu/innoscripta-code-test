<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsAuthor extends Model
{
    //

    protected $fillable = [
        'news_source_id',
        'author_id',
    ];

}
