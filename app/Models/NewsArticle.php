<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'news_source_id',
        'category_id',
        'news_source_name',
        'category_name',
        'source_external_id',
        'title',
        'content',
        'imageUrl',
        'published_at',
        'archived_at',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

}
