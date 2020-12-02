@include('layouts.header')

<body>

	<div class="super_container">
		<header class="header">
			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col d-flex flex-row">
							<div class="top_bar_contact_item">
								<div class="top_bar_icon"><img src="{{asset('frontend/images/phone.png')}}" alt=""></div>+38 068 005 3570
							</div>
							<div class="top_bar_contact_item">
								<div class="top_bar_icon"><img src="{{asset('frontend/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
							</div>
							<div class="top_bar_content ml-auto">

								@guest

								@else
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">

										<li>
											<a href="" data-toggle="modal" data-target="#exampleModal">My Order Traking</a>
										</li>

									</ul>
								</div>
								@endguest
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">

										@php
										$language = Session()->get('lang');
										@endphp

										<li>
											@if(Session()->get('lang') == 'farsi' )
											<a href="{{ route('language.english') }}">English<i class="fas fa-chevron-down"></i></a>
											@else
											<a href="{{ route('language.farsi') }}">Farsi<i class="fas fa-chevron-down"></i></a>
											@endif



										</li>

									</ul>
								</div>
								<div class="top_bar_user">
									@guest
									<div><a href="{{ route('login') }}">
											<div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div> Register/Login
										</a></div>
									@else

									<ul class="standard_dropdown top_bar_dropdown">
										<li>
											<a href="{{ route('home') }}">
												<div class="user_icon"><img src="{{ asset('frontend/images/user.svg')}}" alt=""></div> Profile<i class="fas fa-chevron-down"></i>
											</a>
											<ul>
												<li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
												<li><a href="{{route('user.checkout')}}">Checkout</a></li>
												<li><a href="#">Others</a></li>
											</ul>
										</li>

									</ul>
									@endguest

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header_main">
				<div class="container">
					<div class="row">

						<!-- Logo -->
						<div class="col-lg-2 col-sm-3 col-3 order-1">
							<div class="logo_container">
								<div class="logo"><a href="{{url('/')}}"><img src="{{asset('frontend/images/logo.png')}}" alt=""></a></div>
							</div>
						</div>

						@php
						$category = DB::table('categories')->get();

						@endphp
						<!-- Search -->
						<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
							<div class="header_search">
								<div class="header_search_content">
									<div class="header_search_form_container">
										<form method="post" action="#" class="header_search_form clearfix">
											@csrf
											<input type="search" required="required" class="header_search_input" placeholder="Search for products..." name="search">
											<div class="custom_dropdown">
												<div class="custom_dropdown_list">
													<span class="custom_dropdown_placeholder clc">All Categories</span>
													<i class="fas fa-chevron-down"></i>
													<ul class="custom_list clc">
														@foreach($category as $row)
														<li><a class="clc" href="#">{{ $row->category_name }}</a></li>
														@endforeach
													</ul>
												</div>
											</div>
											<button type="submit" class="header_search_button trans_300" value="Submit">
											<img src="{{ asset('./frontend/images/search.png')}}" alt=""></button>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Wishlist -->
						<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
							<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist d-flex flex-row align-items-center justify-content-end">
									@guest
									@else
									@php
									$wishlist = DB::table('wishlists')->where('user_id',Auth::id())->get();
									@endphp
									<div class="wishlist_icon"><img src="{{asset('frontend/images/heart.png')}}" alt=""></div>
									<div class="wishlist_content">
										<div class="wishlist_text"><a href="{{route('user.wishlist')}}">Wishlist</a></div>
										<div class="wishlist_count">{{count($wishlist)}}</div>
									</div>
								</div>
								@endguest
								<!-- Cart -->
								<div class="cart">
									<div class="cart_container d-flex flex-row align-items-center justify-content-end">
										<div class="cart_icon">
											<img src="{{asset('frontend/images/cart.png')}}" alt="">
											<div class="cart_count"><span>{{ Cart::count() }}</span></div>
										</div>
										<div class="cart_content">
											<div class="cart_text"><a href="{{ route('show.cart') }}">Cart</a></div>
											<div class="cart_price">${{ Cart::subtotal() }}</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			@yield('content')

			@include('layouts.footer')