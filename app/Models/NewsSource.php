<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'logo',
        'model',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function newArticles(): HasMany
    {
        return $this->hasMany(NewsArticle::class, 'news_source_id');
    }

}
