<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_id'
    ];

     // relasi table user / model user
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
