<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function category(){

        return $this->belongsToMany(Category::class);
    }

    public function subcategory(){

        return $this->belongsToMany(SubCategory::class);
    }
    public function brand(){

        return $this->belongsToMany(Brand::class);
    }
}
