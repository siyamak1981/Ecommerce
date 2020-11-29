
    <!-- Trends -->

    <div class="trends">
        <div class="trends_background" style="background-image:url({{ asset('public/frontend/images/trends_background.jpg')}})"></div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Buy One Get One</h2>
                        <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>


@php
 $buyget = DB::table('products')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','brands.brand_name') 
            ->where('status',1)->where('buyone_getone',1)->orderBy('id','DESC')->limit(6)->get();

@endphp

                <!-- Trends Slider -->
                <div class="col-lg-9">
                    <div class="trends_slider_container">

                        <!-- Trends Slider -->

                        <div class="owl-carousel owl-theme trends_slider">
       @foreach($buyget as $row)
                            <!-- Trends Slider Item -->
            <div class="owl-item">
                <div class="trends_item is_new">
                    <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset( $row->image_one )}}" alt=""></div>
                    <div class="trends_content">
        <div class="trends_category"><a href="#">{{ $row->brand_name }}</a></div>
                        <div class="trends_info clearfix">
          <div class="trends_name"><a href="{{ url('product/details/'.$row->id.'/'.$row->product_name) }}">{{ $row->product_name }}</a></div>
                             

 @if($row->discount_price == NULL)
<div class="product_price discount">${{ $row->selling_price }}<span> </div>
      @else
<div class="product_price discount">${{ $row->discount_price }}<span>${{ $row->selling_price }}</span></div>
      @endif 

      <button id="{{ $row->id }}" class="btn btn-primary btn-sm addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
                        </div>
                    </div>
                    <ul class="trends_marks">
                       @if($row->discount_price == NULL)
                        <li class="trends_mark trends_new">BuyGet</li>
                       @else
                       <li class="trends_mark trends_new bg-danger">	@php
												$amount = $row->selling_price - $row->discount_price;
												$discount = $amount/$row->selling_price*100;

												@endphp

												{{ intval($discount) }}%</li>
                       @endif
                    </ul>
                     <button class="addwishlist" data-id="{{ $row->id }}" >
                    <div class="trends_fav"><i class="fas fa-heart"></i></div>
                </button>

                </div>
            </div>

        @endforeach
                           

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

 