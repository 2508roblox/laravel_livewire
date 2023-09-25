<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\SubCategory;
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


        $products = DB::table('products')
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->leftJoin('product_colors', 'products.id', '=', 'product_colors.product_id')
        ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
        ->select('products.id as product_id', 'products.name as product_name', 'sub_categories.name as sub_category_name', DB::raw('SUM(product_colors.quantity) as total_quantity'), 'products.price as price', 'products.id as id', 'product_images.image')
        ->groupBy('products.id', 'products.name', 'sub_categories.name', 'products.price', 'products.id', 'product_images.image')
        ->get();

       return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = SubCategory::all();
        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        $colors = Color::all();
        return view('admin.product.create', compact('sub_categories', 'colors', 'brands'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , SubCategory $sub_category, Product $product)
    {
       $validateData  = $request->validate([
        "sub_category_id"=> 'required',
        "name"=> 'required|max:255',
        "slug"=> 'required',
        "brand_id"=> 'nullable',
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
    $sub_category = SubCategory::find($validateData['sub_category_id']);

    $product =  $sub_category == null
   ?
   $sub_category->products()->create($validateData)
    :
    Product::create($validateData);

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
if ($request->colors ?? false) {
    foreach ($request->colors as $key => $value) {

        $product->productColor()->create([
         'color_id' => $key,
         'quantity' => $request->quantities[$key]

        ]);
     }
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

        $sub_categories = SubCategory::all();
        $brands = Brand::all();
        $product = Product::find($id);
        $images = $product->productImages()->get();

        $colors_quantity =  DB::table('product_colors')->join('colors', 'product_colors.color_id', '=', 'colors.id')
        ->select('*',  'colors.name as colors_name', 'product_colors.id as product_colors_id' )
        ->where('product_colors.product_id', '=', $id)
        ->get();
        //whereDoesntHave return all This Model which is not existing in relationsip table
        //default => all in relationsip table
        $colors = Color::whereDoesntHave('products', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();
        return view('admin.product.edit', compact('product', 'sub_categories', 'images', 'colors_quantity', 'colors', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData  = $request->validate([
            "sub_category_id"=> 'required',
            "brand_id"=> 'nullable',
            "name"=> 'required|max:255',
            "slug"=> 'required',
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


if ($request->colors ?? false) {
    foreach ($request->colors as $key => $value) {

        $product->productColor()->create([
         'color_id' => $key,
         'quantity' => $request->quantities[$key]

        ]);

 }
}

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
        return redirect('admin/product')->with('message', 'SubCategory deleted successfully');
    }
    public function destroyImg ($id)
    {
       dd($id);
    }
}
