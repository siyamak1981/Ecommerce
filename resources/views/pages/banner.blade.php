  <!-- Banner -->
  @php
     $mid = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','brands.brand_name','categories.category_name')
            ->where('products.mid_slider',1)->orderBy('id','DESC')->limit(3)
            ->get();

  @endphp


    <div class="banner_2">
        <div class="banner_2_background" style="background-image:url({{ asset('frontend/images/banner_2_background.jpg')}})"></div>
        <div class="banner_2_container">
            <div class="banner_2_dots"></div>
            <!-- Banner 2 Slider -->

            <div class="owl-carousel owl-theme banner_2_slider">
            @foreach($mid as $row)
                <!-- Banner 2 Slider Item -->
    <div class="owl-item">
    <div class="banner_2_item">
        <div class="container fill_height">
            <div class="row fill_height">
                <div class="col-lg-4 col-md-6 fill_height">
                    <div class="banner_2_content">
                        <div class="banner_2_category"><h4>{{ $row->category_name }}</h4></div>
                        <div class="banner_2_title">{{ $row->product_name }}</div>
                        <div class="banner_2_text"><h4> {{ $row->brand_name }}</h4> <br>
                            <h2>${{ $row->selling_price }} </h2>

                        </div>
                        <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                        <div class="button banner_2_button"><a href="#">Explore</a></div>
                    </div>
                    
                </div>
                <div class="col-lg-8 col-md-6 fill_height">
                    <div class="banner_2_image_container">
                        <div class="banner_2_image"><img src="{{ asset( $row->image_one )}} " alt="" style="height: 300px; width: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    </div>
             @endforeach
               
            </div>
        </div>
    </div>