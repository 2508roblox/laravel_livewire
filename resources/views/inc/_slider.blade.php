      <!-- Slider Section -->
      <div class="mb-5">
          <div class="bg-img-hero" style="background-image: url(client/img/1920X714/img1.jpg);">
              <div class="container">
                  <div class="mb-6 pt-3">
                      <div class="row align-items-end">
                          <div class="col">
                              <!-- Tab Content -->
                              <div class="tab-content">
                                  @php
                                      $count = 0;
                                  @endphp




                                  @forelse ($sliders as $slider)
                                      @php

                                          $count++;
                                      @endphp
                                      <div class="tab-pane fade show  {{ $number[$count] == 'one' ? 'active' : '' }}"
                                          id="pills-{{ $number[$count] }}-code-features" role="tabpanel"
                                          aria-labelledby="pills-{{ $number[$count] }}-code-features-tab">
                                          <div class="row align-items-end">
                                              <div class="col-lg-5">

                                                  <div class="mb-6"   data-scs-animation-in="fadeInUp"
                                                      data-scs-animation-delay="200">


                                                    @php
                                                          echo $slider->description;
                                                          @endphp
                                                          </div >
                                                          <style>
                                                            h1{
                                                                font-size: 3rem;
                                                            }
                                                          </style>
                                                  <a href="{{ url('/shop') }}"
                                                      class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                      data-scs-animation-in="fadeInUp" data-scs-animation-delay="300">
                                                      Start Buying
                                                  </a>
                                              </div>
                                              <div class="col-lg-7" data-scs-animation-in="zoomIn"
                                                  data-scs-animation-delay="500">
                                                  <img style="max-height: 310px" class="img-fluid rounded-lg"
                                                      src="{{ $slider->image ? asset('storage/' . $slider->image) : 'client/img/724X360/img2.png' }}"
                                                      alt="Image Description">
                                              </div>
                                          </div>
                                      </div>
                                  @empty
                                  @endforelse



                              </div>

                              <!-- End Tab Content -->
                          </div>
                          <div class="col-auto">
                              <!-- Features Section -->
                              <div class="bg-light max-width-216">
                                  <!-- Nav -->
                                  <ul class="nav nav-box-custom bg-white rounded-sm py-2" role="tablist">
                                      @php
                                          $count = 0;
                                      @endphp
                                      {{-- start title --}}
                                      @forelse ($sliders as $slider)
                                          @php
                                              $count++;
                                          @endphp
                                          <li class="nav-item mx-0">
                                              <a class="nav-link p-2 px-4 {{ $number[$count] == 'one' ? 'active' : '' }}"
                                                  id="pills-{{ $number[$count] }}-code-features-tab" data-toggle="pill"
                                                  href="#pills-{{ $number[$count] }}-code-features" role="tab"
                                                  aria-controls="pills-{{ $number[$count] }}-code-features"
                                                  aria-selected="true">
                                                  <span class="font-size-14">{{ $slider->title }}</span>
                                              </a>
                                          </li>
                                      @empty
                                      @endforelse


                                  </ul>
                                  <!-- End Nav -->
                              </div>
                              <!-- End Features Section -->
                          </div>
                      </div>
                  </div>
                  <div class="mb-4 position-relative">
                      <div class="js-slick-carousel u-slick u-slick--gutters-0 position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                          data-arrows-classes="u-slick__arrow u-slick__arrow--flat u-slick__arrow-centered--y rounded-circle"
                          data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-2 ml-xl-n3"
                          data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-2 mr-xl-n3"
                          data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                          data-slides-show="7" data-slides-scroll="1"
                          data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 5
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 3
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]'>

                            @foreach ($products as $product)
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer  " >
                                        <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3" style="height: 330px">
                                            <div class="product-item__body pb-xl-2" style="
                                            display: flex;
                                            flex-direction: column;
                                            justify-content: space-between;
                                            height: 288px;
                                        ">
                                                <div class="mb-2"><a
                                                        href="{{ route('frontend.category.show', ['product_slug' => $product->slug]) }}"
                                                        class="font-size-12 text-gray-5">{{$product->sub_category_name}}</a></div>
                                                <h5 class="mb-1 product-item__title"><a href="{{ route('frontend.category.show', ['product_slug' => $product->slug]) }}"
                                                        class="text-blue font-weight-bold">   @php
                                                        echo ucwords($product->name)
                                                    @endphp</a></h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('frontend.category.show', ['product_slug' => $product->slug]) }}" class="d-block text-center"><img
                                                            class="img-fluid" src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('client/img/212X200/img2.jpg') }}"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if ($product->promotion_price)

                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none">${{ $product->promotion_price }},00</ins>
                                                            <del
                                                                class="font-size-12 tex-gray-6  ">${{ $product->price }},00</del>


                                                @else

                                                            <div class="text-gray-100">${{ $product->price }}.00</div>


                                                @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="{{ route('frontend.category.show', ['product_slug' => $product->slug]) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                          {{-- <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img3.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img4.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img5.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img6.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img7.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img1.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-slide products-group">
                            <div class="product-item mx-1 remove-divider">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner bg-white px-wd-3 p-2 p-md-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a
                                                    href="../shop/product-categories-7-column-full-width.html"
                                                    class="font-size-12 text-gray-5">Speakers</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ url('/shop') }}"
                                                    class="text-blue font-weight-bold">Wireless Audio System Multiroom
                                                    360 degree Full base audio</a></h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/shop') }}" class="d-block text-center"><img
                                                        class="img-fluid" src="client/img/212X200/img1.jpg"
                                                        alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">$685,00</div>
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ url('/shop') }}"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Slider Section -->
