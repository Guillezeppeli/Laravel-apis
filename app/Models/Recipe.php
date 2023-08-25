<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description',
        'ingredients', 
        'preparation_steps', 
        'cooking_time',
        'category_id',
        'status',
        'image'
    ];

        public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return null;
    }
}
