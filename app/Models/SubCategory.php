<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'status',
    ];
    public function products()
{
    return $this->hasMany(Product::class);
}
}
