<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->join('product_colors', 'product_colors.id', '=', 'carts.product_color_id')
        ->leftJoin('product_images', function ($join) {
            $join->on('products.id', '=', 'product_images.product_id')
                ->whereRaw('product_images.id = (SELECT MIN(id) FROM product_images WHERE product_id = products.id)');
        })
        ->select('products.name as product_name', 'product_images.image as product_image', 'carts.quantity', 'carts.product_color_id', 'products.price', 'products.promotion_price', 'product_colors.quantity as max_color_quantity')
        ->where('carts.user_id', Auth::user()->id)
        ->get();

        return view('frontend.pages.cart', compact('carts') );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existCart = Cart::where('user_id', $request->input('user_id'))
            ->where('product_id', $request->input('product_id'))
            ->where('product_color_id', $request->input('color_id'))
            ->exists();

        $product_color_qty = ProductColor::find($request->input('color_id'))->quantity;

        if ($existCart) {
            $existCartQty = Cart::where('user_id', $request->input('user_id'))
                ->where('product_id', $request->input('product_id'))
                ->where('product_color_id', $request->input('color_id'))
                ->first();

            // Kiểm tra số lượng
            if ($product_color_qty < ($existCartQty->quantity + $request->input('quantity'))) {
                return 'Add error: Product is out of quantity';
            } else {
                $existCartQty->update([
                    'quantity' => $existCartQty->quantity + $request->input('quantity')
                ]);
                return 'Add success: Product added to cart successfully';
            }
        } else {
            $validateData = $request->validate([
                'user_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'color_id' => 'required',
            ]);

            Cart::create([
                'user_id' => $validateData['user_id'],
                'product_id' => $validateData['product_id'],
                'quantity' => $validateData['quantity'],
                'product_color_id' => $validateData['color_id'],
            ]);

            return 'Add success: Product added to cart successfully';
        }
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
