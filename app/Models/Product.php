<?php

namespace App\Models;

use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        "sub_category_id",
        "name",
        "slug",
        "brand",
        "small_description",
        "description",
        "price",
        "promotion_price",
        "quantity",
        "hot",
        "status",
        "publish_date",
        "meta_keyword",
        "meta_description",

  ];
  public function productImages () {
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
  }
  public function productColor () {
    return $this->hasMany(ProductColor::class, 'product_id', 'id');
  }
  public function getExistColors () {
    return $this->belongsToMany(Color::class, 'product_colors');
  }
  public function scopeFilter($query, array $filters) {
    if($filters['filterOptions']  ) {
        $query->when($filters['filterOptions'] == 'lowest' ,function($query) {
            $query->orderBy('price', 'DESC');
        });
        $query->when($filters['filterOptions'] == 'highest' ,function($query) {
            $query->orderBy('price', 'ASC');
        });
    }

    // if($filters['search'] ?? false) {
    //     $query->where('title', 'like', '%' . request('search') . '%')
    //         ->orWhere('description', 'like', '%' . request('search') . '%')
    //         ->orWhere('tags', 'like', '%' . request('search') . '%');
    // }
}
}
