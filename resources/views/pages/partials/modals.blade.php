
<!-- Modal -->
<div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" 
aria-labelledby="exampleModalLavel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLavel">Product Quick View</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<img src="" id="pimage" style="height: 220px; width: 200px;">
							<div class="card-body">
								<h5 class="card-title text-center" id="pname"> </h5>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<ul class="list-group">
							<li class="list-group-item">Product Code:<span id="pcode"></span> </li>
							<li class="list-group-item">Category: <span id="pcat"></span></li>
							<li class="list-group-item">Subcategory: <span id="psub"></span></li>
							<li class="list-group-item">Brand:<span id="pbrand"></span> </li>
							<li class="list-group-item">Stock: <span class="badge" style="background: green;color: white;"> Available</span> </li>
						</ul>
					</div>

					<div class="col-md-4">
						<form method="post" action="{{ route('insert.into.cart') }}">
							@csrf
							<input type="hidden" name="product_id" id="product_id">
							<div class="form-group">
								<label for="exampleInputcolor">Color</label>
								<select name="color" class="form-control" id="color">
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputcolor">Size</label>
								<select name="size" class="form-control" id="size">
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputcolor">Quantity</label>
								<input type="number" class="form-control" name="qty" value="1">
							</div>
							<button type="submit" class="btn btn-primary">Add to Cart </button>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>


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
