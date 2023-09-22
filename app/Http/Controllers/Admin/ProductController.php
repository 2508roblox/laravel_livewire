<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {

        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('*',  'categories.name as category_name', 'products.id as product_id', 'products.name as product_name',)
        ->get();
       return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.create', compact('categories', 'brands', 'colors'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Category $category, Product $product)
    {

       $validateData  = $request->validate([
        "category_id"=> 'required',
        "name"=> 'required|max:255',
        "slug"=> 'required',
        "brand"=> 'nullable',
        "small_description"=> 'required',
        "description"=> 'required',
        "price"=> 'required',
        "promotion_price"=> 'required',
        "quantity"=> 'nullalbe',
        "hot"=> 'nullable',
        "status"=> 'required',
        'images.*' => 'required|mimes:pdf,jpg,xlx,csv|max:2048',
        "publish_date"=> 'nullable',
        "meta_keyword"=> 'required',
        "meta_description"=> 'required',
       ]);



    // create
    $validateData['publish_date'] = $validateData['status'] == 'scheduled' ?  $validateData['publish_date'] : date("d/m/Y");
    $validateData['hot'] =  ( $validateData['hot'] ?? false)  ?  '1': '0';
    $category = Category::find($validateData['category_id']);
   $product =  $category->products()->create($validateData);


 // product_imgs
 if ($request->hasFile('images')) {
    foreach($request->images as $image){
        $path = $image->store('images','public');
        $product->productImages()->create([
           'image' => $path,
        ]);
    }
}
//product color quantity
    foreach ($request->colors as $key => $value) {

       $product->productColor()->create([
        'color_id' => $key,
        'quantity' => $request->quantities[$key]

       ]);
    }
    return redirect('/admin/product');

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
    public function edit( $id, Product $product)
    {

        $categories = Category::all();
        $product = Product::find($id);
        $images = $product->productImages()->get();
        $colors_quantity = DB::table('product_colors')
        ->where('product_id', '=', $id)
        ->get();

        $colors_quantity =  DB::table('product_colors')->join('colors', 'product_colors.color_id', '=', 'colors.id')
        ->select('*',  'colors.name as colors_name', 'product_colors.id as product_colors_id' )
        ->get();

        $colors = Color::all();
        return view('admin.product.edit', compact('product', 'categories', 'images', 'colors_quantity', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData  = $request->validate([
            "category_id"=> 'required',
            "name"=> 'required|max:255',
            "slug"=> 'required',
            "brand"=> 'nullable',
            "small_description"=> 'required',
            "description"=> 'required',
            "price"=> 'required',
            "promotion_price"=> 'required',
            "quantity"=> 'nullalbe',
            "hot"=> 'nullable',
            "status"=> 'required',
            'images.*' => 'required|mimes:pdf,jpg,xlx,csv|max:2048',
            "publish_date"=> 'nullable',
            "meta_keyword"=> 'required',
            "meta_description"=> 'required',
           ]);


        // create
        $validateData['publish_date'] = $validateData['status'] == 'scheduled' ?  $validateData['publish_date'] : date("d/m/Y");
        $validateData['hot'] =  ( $validateData['hot'] ?? false)  ?  '1': '0';
        $product = Product::find($id);
       $product->update($validateData);


     // product_imgs
     if ($request->hasFile('images')) {
        foreach($request->images as $image){
            $path = $image->store('images','public');
            $product->productImages()->create([
               'image' => $path,
            ]);
        }

    }
    return redirect('/admin/product') ;

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        Product::destroy($id);
        return redirect('admin/product')->with('message', 'Category deleted successfully');
    }
    public function destroyImg ($id)
    {
       dd($id);
    }
}
