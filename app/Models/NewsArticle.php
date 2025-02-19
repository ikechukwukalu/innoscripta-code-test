<?php

namespace App\Models;

use App\Traits\TableFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsArticle extends Model
{
    use HasFactory, SoftDeletes, TableFilter;

    protected $fillable = [
        'news_source_id',
        'category_id',
        'news_source_name',
        'category_name',
        'source_external_id',
        'title',
        'description',
        'content',
        'authors',
        'imageUrl',
        'contentIsUrl',
        'published_at',
        'archived_at',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function newsSource(): BelongsTo
    {
        return $this->belongsTo(NewsSource::class, 'news_source_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
