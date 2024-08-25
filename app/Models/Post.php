<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function place(){
        return $this->belongsTo(Place::class);
    }
    
    
}
