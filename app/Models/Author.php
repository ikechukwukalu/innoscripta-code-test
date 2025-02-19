<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'twitter',
        'website',
        'imageUrl',
        'batch_no',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

}
