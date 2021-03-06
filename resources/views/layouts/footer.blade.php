@php
$setting = DB::table('sitesetting')->first();
@endphp
<footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 footer_col">
                    <div class="footer_column footer_contact">
                        <div class="logo_container">
                            <div class="logo"><a href="#">{{ $setting->company_name }}</a></div>
                        </div>
                        <div class="footer_title">Got Question? Call Us 24/7</div>
                        <div class="footer_phone">{{ $setting->phone_two }}</div>
                        <div class="footer_contact_text">
                            <p>{{ $setting->company_address }}</p>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{ $setting->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ $setting->instagram }}"><i class="fab fa-google"></i></a></li>
                                 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 offset-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Find it Fast</div>
                        <ul class="footer_list">
                            <li><a href="#">Computers & Laptops</a></li>
                            <li><a href="#">Cameras & Photos</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Smartphones & Tablets</a></li>
                            <li><a href="#">TV & Audio</a></li>
                        </ul>
                        <div class="footer_subtitle">Gadgets</div>
                        <ul class="footer_list">
                            <li><a href="#">Car Electronics</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <ul class="footer_list footer_list_2">
                            <li><a href="#">Video Games & Consoles</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Cameras & Photos</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Computers & Laptops</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footer_column">
                        <div class="footer_title">Customer Care</div>
                        <ul class="footer_list">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Customer Services</a></li>
                            <li><a href="#">Returns / Exchange</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Product Support</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </footer>

			<!-- Copyright -->

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
								<div class="copyright_content">
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
									Copyright &copy;<script>
										document.write(new Date().getFullYear());
									</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								</div>
								<div class="logos ml-sm-auto">
									<ul class="logos_list">
										<li><a href="#"><img src="{{asset('frontend/images/logos_1.png')}}" alt=""></a></li>
										<li><a href="#"><img src="{{asset('frontend/images/logos_2.png')}}" alt=""></a></li>
										<li><a href="#"><img src="{{asset('frontend/images/logos_3.png')}}" alt=""></a></li>
										<li><a href="#"><img src="{{asset('frontend/images/logos_4.png')}}" alt=""></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>

<!--Order Traking Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your Status Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <form method="post" action="{{ route('order.tracking') }}">
    @csrf
    <div class="modal-body">
        <label> Status Code</label>
        <input type="text" name="code" required="" class="form-control" placeholder="Your Order Status Code">        
    </div>
     
     <button class="btn btn-danger" type="submit">Track Now </button>  

   </form>
  
        
      </div>
       
    </div>
  </div>
</div>







	<script src="{{asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('frontend/styles/bootstrap4/popper.js')}}"></script>
	<script src="{{asset('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
	<script src="{{asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
	<script src="{{asset('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
	<script src="{{asset('frontend/plugins/easing/easing.js')}}"></script>
	<script src="{{asset('frontend/js/custom.js')}}"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="{{ asset('frontend/js/product_custom.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

	<script>
		$(document).on("click", "#return", function(e) {
			e.preventDefault();
			var link = $(this).attr("href");
			swal({
					title: "Are you Want to Return?",
					text: "Once Teturn, this will return your money!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						window.location.href = link;
					} else {
						swal("Cancel!");
					}
				});
		});
	</script>
	<script>
		@if(Session::has('messege'))
		var type = "{{Session::get('alert-type','info')}}"
		switch (type) {
			case 'info':
				toastr.info("{{ Session::get('messege') }}");
				break;
			case 'success':
				toastr.success("{{ Session::get('messege') }}");
				break;
			case 'warning':
				toastr.warning("{{ Session::get('messege') }}");
				break;
			case 'error':
				toastr.error("{{ Session::get('messege') }}");
				break;
		}
		@endif
	</script>
</body>

</html>