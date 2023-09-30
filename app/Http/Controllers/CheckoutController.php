<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      function index()
    {
        // Lấy user ID hiện tại từ Auth
        $userId = Auth::id();

        // Lấy danh sách các carts của user hiện tại
        $carts = Cart::where('user_id', $userId)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->leftJoin('product_colors', 'carts.product_color_id', '=', 'product_colors.id')
        ->leftJoin('colors', 'product_colors.color_id', '=', 'colors.id') // Thêm join với bảng colors
        ->select(
            'carts.id',
            'carts.user_id',
            'carts.product_id',
            'carts.product_color_id',
            'carts.quantity',
            'carts.created_at',
            'carts.updated_at',
            'products.name AS product_name',
            'products.price AS product_price',
            'products.promotion_price AS product_promotion_price',
            'product_colors.color_id',
            'colors.name AS color_name', // Lấy ra trường name từ bảng colors
            'colors.code AS color_code' // Lấy ra trường code từ bảng colors
        )
        ->get();

        // Tạo một mảng để lưu thông tin checkout
        $checkoutData = [];

        // Lặp qua từng cart để lấy thông tin cần thiết
        foreach ($carts as $cart) {
            // Kiểm tra nếu promotion_price không null, lấy promotion_price, ngược lại lấy price
            $productPrice = $cart->product_promotion_price ?? $cart->product_price;

            // Tính giá ship
            $shippingCost = 0.01 * $productPrice * $cart->quantity;

            // Thêm thông tin vào mảng checkoutData
            $checkoutData[] = [
                'product_id' => $cart->product_id,
                'product_color_id' => $cart->product_color_id,
                'product_name' => $cart->product_name,
                'product_price' => $productPrice,
                'quantity' => $cart->quantity,
                'color_name' => $cart->color_name,
                'color_code' => $cart->color_code,
                'shipping_cost' => $shippingCost,
            ];
        }
        // Truyển dữ liệu checkoutData tới view 'frontend.pages.checkout'
        return view('frontend.pages.checkout', ['checkoutData' => $checkoutData]);
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

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'country' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'zipcode' => 'required|max:255',
            'company' => 'nullable|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'payment_mode' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Tạo mới order
        $order = new Order;
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('lastname');
        $order->country = $request->input('country');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->zipcode = $request->input('zipcode');
        $order->company = $request->input('company');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->status = 'pending';
        $order->payment_mode = $request->input('payment_mode');
        $order->user_id = Auth::id();
        $order->save();

        // Lấy tất cả các cart items có user_id trong Auth
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        // Lặp qua từng cart để tạo order_items
        foreach ($carts as $cart) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;
            $orderItem->product_color_id = $cart->product_color_id;
            $orderItem->quantity = $cart->quantity;

            // Kiểm tra nếu bảng products có promotion_price cho sản phẩm trong cart
            $product = Product::find($cart->product_id);
            if ($product->promotion_price) {
                $orderItem->price = $product->promotion_price;
            } else {
                $orderItem->price = $product->price;
            }

            $orderItem->save();
            $cart->delete();
        }

        return redirect('/order');
        // Xóa các cart items sau khi đã tạo order_items

        // Thực hiện các thao tác khác, ví dụ: gửi email xác nhận đơn hàng, tính toán tổng giá trị đơn hàng, v.v.

        // Redirect hoặc trả về thông báo thành công
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
