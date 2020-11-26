@extends('layouts.app')
@section('content')
@include('layouts.menubar')
@php
$featured = DB::table('products')->where('status',1)->orderBy('id','desc')->limit(12)->get();
$trend = DB::table('products')->where('status',1)->where('trend',1)->orderBy('id','desc')->limit(8)->get();
$best = DB::table('products')->where('status',1)->where('best_rated',1)->orderBy('id','desc')->limit(8)->get();

$hot = DB::table('products')
->join('brands','products.brand_id','brands.id')
->select('products.*','brands.brand_name')
->where('products.status',1)->where('hot_deal',1)->orderBy('id','desc')->limit(3)
->get();

@endphp

<div class="characteristics">
	<div class="container">
		<div class="row">

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">

				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('frontend/images/char_1.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">

				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('frontend/images/char_2.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">

				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('frontend/images/char_3.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>

			<!-- Char. Item -->
			<div class="col-lg-3 col-md-6 char_col">

				<div class="char_item d-flex flex-row align-items-center justify-content-start">
					<div class="char_icon"><img src="{{asset('frontend/images/char_4.png')}}" alt=""></div>
					<div class="char_content">
						<div class="char_title">Free Delivery</div>
						<div class="char_subtitle">from $50</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

				<!-- Deals -->

				<div class="deals">
					<div class="deals_title">Deals of the Week</div>
					<div class="deals_slider_container">

						<!-- Deals Slider -->
						<div class="owl-carousel owl-theme deals_slider">


							@foreach($hot as $ht)
							<!-- Deals Item -->
							<div class="owl-item deals_item">
								<div class="deals_image"><img src="{{ asset( $ht->image_one )}}" alt=""></div>
								<div class="deals_content">
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_category"><a href="#">{{ $ht->brand_name }}</a></div>

										@if($ht->discount_price == NULL)
										@else
										<div class="deals_item_price_a ml-auto">${{ $ht->selling_price }}</div>
										@endif


									</div>
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_name">{{ $ht->product_name }}</div>

										@if($ht->discount_price == NULL)
										<div class="deals_item_price ml-auto">${{ $ht->selling_price }}</div>
										@else

										@endif

										@if($ht->discount_price != NULL)
										<div class="deals_item_price ml-auto">${{ $ht->discount_price }}</div>
										@else

										@endif



									</div>
									<div class="available">
										<div class="available_line d-flex flex-row justify-content-start">
											<div class="available_title">Available: <span>{{ $ht->product_quantity  }}</span></div>
											<div class="sold_title ml-auto">Already sold: <span>28</span></div>
										</div>
										<div class="available_bar"><span style="width:17%"></span></div>
									</div>
									<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
										<div class="deals_timer_title_container">
											<div class="deals_timer_title">Hurry Up</div>
											<div class="deals_timer_subtitle">Offer ends in:</div>
										</div>
										<div class="deals_timer_content ml-auto">
											<div class="deals_timer_box clearfix" data-target-time="">
												<div class="deals_timer_unit">
													<div id="deals_timer1_hr" class="deals_timer_hr"></div>
													<span>hours</span>
												</div>
												<div class="deals_timer_unit">
													<div id="deals_timer1_min" class="deals_timer_min"></div>
													<span>mins</span>
												</div>
												<div class="deals_timer_unit">
													<div id="deals_timer1_sec" class="deals_timer_sec"></div>
													<span>secs</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach


						</div>

					</div>

					<div class="deals_slider_nav_container">
						<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
						<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
					</div>
				</div>

				<!-- Featured -->
				<div class="featured">
					<div class="tabbed_container">
						<div class="tabs">
							<ul class="clearfix">
								<li class="active">Featured</li>
								<li>Trend</li>
								<li>Best Rated</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<!-- Product Panel -->
						<div class="product_panel panel active">
							<div class="featured_slider slider">

								@foreach($featured as $row)
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
												<div class="product_color">
													<input type="radio" checked="" name="product_color" style="background:#b19c83" tabindex="0">
													<input type="radio" name="product_color" style="background:#000000" tabindex="0">
													<input type="radio" name="product_color" style="background:#999999" tabindex="0">
												</div>
												<button id="{{ $row->id }}" class="product_cart_button addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
											</div>
										</div>


										<button class="addwishlist" data-id="{{ $row->id }}">
											<div class="product_fav"><i class="fas fa-heart"></i></div>
										</button>


										<ul class="product_marks">
											@if($row->discount_price == NULL)
											<li class="product_mark product_discount bg-primary">New</li>
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

						<!-- Product Trend -->

						<div class="product_panel panel">
							<div class="featured_slider slider">
								@foreach($trend as $row)
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
												<div class="product_color">
													<input type="radio" checked="" name="product_color" style="background:#b19c83" tabindex="0">
													<input type="radio" name="product_color" style="background:#000000" tabindex="0">
													<input type="radio" name="product_color" style="background:#999999" tabindex="0">
												</div>
												<button id="{{ $row->id }}" class="product_cart_button addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
											</div>
										</div>


										<button class="addwishlist" data-id="{{ $row->id }}">
											<div class="product_fav"><i class="fas fa-heart"></i></div>
										</button>


										<ul class="product_marks">
											@if($row->discount_price == NULL)
											<li class="product_mark product_discount bg-primary">New</li>
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

						<!-- Product best Rated -->
						<div class="product_panel panel">
							<div class="featured_slider slider">
								@foreach($best as $row)
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
												<div class="product_color">
													<input type="radio" checked="" name="product_color" style="background:#b19c83" tabindex="0">
													<input type="radio" name="product_color" style="background:#000000" tabindex="0">
													<input type="radio" name="product_color" style="background:#999999" tabindex="0">
												</div>
												<button id="{{ $row->id }}" class="product_cart_button addcart" data-toggle="modal" data-target="#cartmodal" onclick="productview(this.id)">Add to Cart</button>
											</div>
										</div>


										<button class="addwishlist" data-id="{{ $row->id }}">
											<div class="product_fav"><i class="fas fa-heart"></i></div>
										</button>


										<ul class="product_marks">
											@if($row->discount_price == NULL)
											<li class="product_mark product_discount bg-primary">New</li>
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

@include('pages.popularcategory')
@include('pages.banner')
@include('pages.new_arrivals')
@include('pages.best_seller')
@include('pages.adverts')
@include('pages.trends')
@include('pages.reviews')
@include('pages.viewed')
@include('pages.brands')
@include('pages.newsletter')




<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script type="text/javascript">
	function productview(id) {
		$.ajax({
			url: "{{ url('/cart/product/view/') }}/" + id,
			type: "GET",
			dataType: "json",
			success: function(data) {
				$('#pcode').text(data.product.product_code);
				$('#pcat').text(data.product.category_name);
				$('#psub').text(data.product.subcategory_name);
				$('#pbrand').text(data.product.brand_name);
				$('#pname').text(data.product.product_name);
				$('#pimage').attr('src', data.product.image_one);
				$('#product_id').val(data.product.id);

				var d = $('select[name="color"]').empty();
				$.each(data.color, function(key, value) {
					$('select[name="color"]').append('<option value="' + value + '">' + value + '</option>');
				});

				var d = $('select[name="size"]').empty();
				$.each(data.size, function(key, value) {
					$('select[name="size"]').append('<option value="' + value + '">' + value + '</option>');
				});


			}
		})
	}
</script>



<!-- <script type="text/javascript">
    
   $(document).ready(function(){
     $('.addcart').on('click', function(){
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: " {{ url('/add/to/cart/') }}/"+id,
                type:"GET",
                datType:"json",
                success:function(data){
             const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })

             if ($.isEmptyObject(data.error)) {

                Toast.fire({
                  icon: 'success',
                  title: data.success
                })
             }else{
                 Toast.fire({
                  icon: 'error',
                  title: data.error
                })
             }
 

                },
            });

        }else{
            alert('danger');
        }
     });

   });


</script> -->












<script type="text/javascript">
	$(document).ready(function() {
		$('.addwishlist').on('click', function() {
			var id = $(this).data('id');
			if (id) {
				$.ajax({
					url: " {{ url('add/wishlist/') }}/" + id,
					type: "GET",
					datType: "json",
					success: function(data) {
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
							onOpen: (toast) => {
								toast.addEventListener('mouseenter', Swal.stopTimer)
								toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
						})

						if ($.isEmptyObject(data.error)) {

							Toast.fire({
								icon: 'success',
								title: data.success
							})
						} else {
							Toast.fire({
								icon: 'error',
								title: data.error
							})
						}


					},
				});
			} else {
				alert('danger');
			}
		});

	});
</script>
@endsection