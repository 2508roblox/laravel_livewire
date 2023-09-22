<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        "name"  ,
        "image",
        "slug",
        "title",
        "description",
        "status",
        "publish_date",
        "seo_description"

  ];
  public function products() 
   {
    return $this->hasMany(Product::class, 'category_id', 'id');
  }
}
