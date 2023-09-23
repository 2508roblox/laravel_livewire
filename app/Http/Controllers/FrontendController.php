<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::all()->where('status', '=', 'published');
        $number  = [
            '1' => 'one',
            '2' => 'two',
            '3' => 'three',
            '4' => 'four',
            '5' => 'five',
            '6' => 'six',
        ];
        return view('home', compact('sliders', 'number', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showCategories($category_slug)
{
    $categories = Category::with(['sub_categories.products'])
    ->where('status', 'published')
    ->get();

        foreach ($categories as $category) {
        $totalCategoryProducts = 0;
        $subCategoriesWithProductCount = [];

        foreach ($category->sub_categories as $subCategory) {
            $productCount = $subCategory->products->count();
            $totalCategoryProducts += $productCount;

            $subCategoriesWithProductCount[] = [
                'subCategory' => $subCategory,
                'productCount' => $productCount,
            ];
        }

        $category->subCategoriesWithProductCount = $subCategoriesWithProductCount;
        $category->totalProducts = $totalCategoryProducts;

    }

    //current category
    $currentCategory =   Category::with(['sub_categories.products'])
    ->where('status', 'published')
    ->where('slug', $category_slug)
    ->get();

    foreach ($currentCategory as $currentCate) {
        $totalCategoryProducts = 0;
        $subCategoriesWithProductCount = [];

        foreach ($currentCate->sub_categories as $subCategory) {
            $productCount = $subCategory->products->count();
            $totalCategoryProducts += $productCount;

            $subCategoriesWithProductCount[] = [
                'subCategory' => $subCategory,
                'productCount' => $productCount,
            ];
        }
        $currentCate->subCategoriesWithProductCount = $subCategoriesWithProductCount;
            $currentCate->totalProducts = $totalCategoryProducts;
    }

    //current category
    return view('frontend.categories', compact('categories', 'currentCategory'));
}
    public function showCategoryProducts(SubCategory $subcategory, $category_slug, $sub_slug)
    {

        $category =Category::with(['sub_categories'])
        ->where('slug', $category_slug)
        ->get()[0];

        $sub_category = $category->sub_categories->where('slug', $sub_slug)[0] ;
        $products = $sub_category->products()->get();

        return view('frontend.categoryProduct', compact('sub_category', 'products'));

    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
