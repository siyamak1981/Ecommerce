<!-- Hot New Category One -->

@php
$cats = DB::table('categories')->skip(1)->first();
$catid = $cats->id;

$product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)->orderBy('id','DESC')->get();

@endphp

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                        <ul class="clearfix">
                            <li class="active"> </li>

                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">

                                    @foreach($product as $row)
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset( $row->image_one )}}" alt="" style="height: 120px; width: 100px;"></div>
                                            <div class="product_content">

                                                @if($row->discount_price == NULL)
                                                <div class="product_price discount">${{ $row->selling_price }}<span> </div>
                                                @else
                                                <div class="product_price discount">${{ $row->discount_price }}<span>${{ $row->selling_price }}</span></div>
                                                @endif



                                                <div class="product_name">
                                                    <div><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                                                </div>
                                                <div class="product_extras">
                                                  
                                                    <button id="{{ $row->id }}" class="product_cart_button addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                </div>
                                            </div>


                                            <button class="addwishlist" data-id="{{ $row->id }}">
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                            </button>


                                            <ul class="product_marks">
                                                @if($row->discount_price == NULL)
                                                <li class="product_mark product_discount" style="background: blue;">New</li>
                                                @else
                                                <li class="product_mark product_discount">
                                                    @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = $amount/$row->selling_price*100;

                                                    @endphp

                                                    {{ intval($discount) }}%

                                                </li>
                                                @endif



                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<!-- Hot New Category Two -->

@php
$cats = DB::table('categories')->skip(3)->first();
$catid = $cats->id;

$product = DB::table('products')->where('category_id',$catid)->where('status',1)->limit(10)->orderBy('id','DESC')->get();

@endphp

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">{{ $cats->category_name }}</div>
                        <ul class="clearfix">
                            <li class="active"> </li>

                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="z-index:1;">

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="arrivals_slider slider">

                                    @foreach($product as $row)
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset( $row->image_one )}}" alt="" style="height: 120px; width: 100px;"></div>
                                            <div class="product_content">

                                                @if($row->discount_price == NULL)
                                                <div class="product_price discount">${{ $row->selling_price }}<span> </div>
                                                @else
                                                <div class="product_price discount">${{ $row->discount_price }}<span>${{ $row->selling_price }}</span></div>
                                                @endif



                                                <div class="product_name">
                                                    <div><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                                                </div>
                                                <div class="product_extras">
                                                    <button id="{{ $row->id }}" class="product_cart_button addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                                                </div>
                                            </div>


                                            <button class="addwishlist" data-id="{{ $row->id }}">
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                            </button>


                                            <ul class="product_marks">
                                                @if($row->discount_price == NULL)
                                                <li class="product_mark product_discount" style="background: blue;">New</li>
                                                @else
                                                <li class="product_mark product_discount">
                                                    @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = $amount/$row->selling_price*100;

                                                    @endphp

                                                    {{ intval($discount) }}%

                                                </li>
                                                @endif



                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
