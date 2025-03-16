<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'ingredients',
        'instructions',
        'cooking_time',
        'image_path',
        'user_id',
    ];

    // relasi table user / model user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi table favorite / model favorite
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
}
