<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'features',
        'thumbnail',
        'gallery',
        'url',
        'category_id',
        'technology',
        'completion_date',
        'is_featured',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
        'gallery' => 'array', 

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
