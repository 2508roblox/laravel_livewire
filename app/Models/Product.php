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
        "category_id",
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

}
