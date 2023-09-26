@extends('layout.layout')

@section('content')
@include('inc/_header')
<main id="content" role="main" class="cart-page">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="my-6">
            <h1 class="text-center">My wishlist on Electro</h1>
        </div>
        <div class="mb-16 wishlist-table">
            <form class="mb-4" action="#" method="post">
                <div class="table-responsive">
                    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif
                    <table class="table" cellspacing="0">


                        <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-Stock w-lg-15">Stock Status</th>
                                <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($wishlists as $wishlist)
                          <form action="" method="POST">
                            @csrf
                            <tr>
                                <td class="text-center">
                                    <a href="#" class="text-gray-32 font-size-26">×</a>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1"

                                        src="{{ $wishlist->image ? asset('storage/' . $wishlist->image) : 'client/img/300X300/img6.jpg'}} "
                                        alt="Image Description"></a>
                                </td>

                                <td data-title="Product">
                                    <a href="#" class="text-gray-90">@php
                                        echo ucwords($wishlist->product_name)
                                    @endphp</a>
                                </td>

                                <td data-title="Unit Price">
                                    @if ($wishlist->promotion_price)

                                    <span class="">${{$wishlist->promotion_price}}.00</span>
                                    @else
                                    <span class="">${{$wishlist->price}}.00</span>

                                    @endif

                                </td>

                                <td data-title="Stock Status">
                                    <!-- Stock Status -->
                                    <span>{{$wishlist->total_quantity ? 'In stock' : 'Out of Stock' }}</span>
                                    <!-- End Stock Status -->
                                </td>

                                <td>
                                    <button type="button" class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Add to Cart</button>
                                </td>
                            </tr>
                          </form>
                           @empty

                           @endforelse

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</main>


@endsection
