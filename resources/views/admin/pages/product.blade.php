@extends('admin.layout.admin')
@section('content')
<script type="text/javascript">
	function addProduct()
	{
		$("#addProducts").modal('show');
		let x = generateProductNumber(4);
		checkPNumber(x);
	}
	function generateProductNumber(length)
	{
		var res = "";
		var num = "1234567890";
		var ret = "";
		for(var i = 0; i < length;i++)
		{
			res += num.charAt(Math.floor(Math.random() * num.length));
		}
		ret = "WA-"+res;
		return ret;
	}
	function checkPNumber(n)
	{
		var x = "";
		$token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: "{{ route('checkPNumber') }}",
			type: "post",
			data:{"_token":$token,n:n},
			dataType: 'html',
			success: function(data)
			{
				if(data == 1)
				{
					generateProductNumber(4);
				}
				else
				{
					$("#productNo").val(n);
				}
			}
		});
	}
</script>
<style type="text/css">
	.productHover:hover
	{
		transition: .5s;
		background-color: #5bc0de;
		color:  white;
		cursor: pointer;
	}
</style>
<div class="container p-3">
	<div class="row">
		<div class="col-lg-6 col-md-5 col-6">	
			<h2>Product Management</h2>
		</div>
		<div class="col-lg-6 col-md-5 col-6 d-flex justify-content-center">
			<div class="float-right">
				<button class="btn btn-primary" onclick="addProduct()" title="Add Product"><i class="fa fa-plus"></i></button>
			</div>
		</div>
		
	</div>
</div>

<table class="table table-light table-responsive">
	<thead>
		<th>Picture</th>
		<th>Product No.</th>
		<th>Product Name</th>
		<th>Product Price</th>
		<th>Category</th>
		<th>Gender</th>
		<th>Quantity</th>
		<th>Status</th>
		<th>Actions</th>

	</thead>
	<tbody>
		@if(count($products))
			@foreach($products as $product)
				<tr>
					<td><span class="avatar avatar-md rounded-circle">
                    <img alt="Image placeholder" src="{{asset($product->product_imagelink)}}">
                  </span></td>
					<td>{{$product->product_number}}</td>
					<td style=" text-overflow: ellipsis; " class="text-wrap">{{$product->product_name}}</td>
					<td>{{$product->product_price}}</td>
					<td>{{$product->category}}</td>
					<td>{{$product->gender}}</td>
					<td>{{$product->quantity}}</td>
					<td>
						@if($product->quantity >= 499)
						<span class="badge badge-pill badge-success">Maximum</span>
						@elseif($product->quantity <= 499 && $product->quantity >= 300)
							<span class="badge badge-pill badge-success">Average</span>
						@elseif($product->quantity <= 299 && $product->quantity >= 100)
							<span class="badge badge-pill badge-info">Good</span>
						@elseif($product->quantity <= 99 && $product->quantity >= 1)
							<span class="badge badge-pill badge-warning">Critical</span>
						@elseif($product->quantity < 1)
							<span class="badge badge-pill badge-danger">Out of stock</span>
						@endif
					</td>
					<td>
						<button class="btn btn-info btn-sm" onclick="viewProduct({{$product->id}})">View</button>
						<button class="btn btn-warning btn-sm" onclick="edit({{$product->id}})">Edit</button> <button class="btn btn-danger btn-sm" onclick="del({{$product->id}})">Delete</button>
					</td>
				</tr>
			@endforeach
		@endif
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"><span class="">{{$products->links()}}</span></td>
		</tr>
	</tfoot>
</table>

{{-- Edit Products --}}
<div class="modal fade" id="edit" data-backdrop='static'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Product</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('editProduct') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-body">
				<div class="form-row">
					<label class="col-lg-4 col-md-4">Product Number</label>
					<div class="col-lg-8 col-md-3">
						<input type="text" class="form-control" name="edPnumber" id="edPnumber" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-4 col-md-4">Product Name</label>
					<div class="col-lg-8 col-md-3">
						<input type="text" class="form-control @error('edPname') is-invalid @enderror" name="edPname" id="edPname">
						@error('edPname')
						<script type="text/javascript">$("#edit").modal('show');</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-4 col-md-4">Product Price</label>
					<div class="col-lg-8 col-md-3">
						<input type="number" step="0.25" class="form-control @error('edPprice') is-invalid @enderror" name="edPprice" id="edPprice">
						@error('edPprice')
						<script type="text/javascript">$("#edit").modal('show');</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-4 col-md-4">Category</label>
					<div class="col-lg-8 col-md-3">
						<select class="form-control " name="edPcategory" id="edPcategory">
							<optgroup label="Men's Apparel">
								<option value="Mens Tops">Men's Tops</option>
								<option value="Mens Pants">Men's Pants</option>
								<option value="Mens Shorts">Men's Shorts</option>
								<option value="Mens Jacket & Hoodies">Jacket & Hoodies</option>
								<option value="Mens Socks">Socks</option>
								<option value="Mens Sneakers">Sneakers</option>
								<option value="Mens Sandals & Flip-flops">Sandals & Flip-flops</option>
								<option value="MensFormal">Formal</option>
							</optgroup>
							
							<optgroup label="Women's Apparel">
								<option value="Womens Dresses">Dresses</option>
								<option value="Womens Tops">Women's Tops</option>
								<option value="Womens Tees">Tees</option>
								<option value="Womens Pants">Women's Pants</option>
								<option value="Womens Skirts">Skirts</option>
								<option value="Womens Shorts">Women's Shorts</option>
								<option value="Womens Jackets">Jackets</option>
								<option value="Womens Shoes">Shoes</option>
								<option value="Womens Socks & Stockings">Socks & Stockings</option>
							</optgroup>
							<optgroup label="More Accessories">
								<option value="Shoulder Bags">Shoulder Bags</option>
								<option value="Hand Bags">Hand Bags</option>
								<option value="Backpacks">Backpacks</option>
								<option value="Drawstring Bags">Drawstring Bags</option>
								<option value="Tote Bags">Tote Bags</option>
								<option value="Clutches">Clutches</option>
								<option value="Purses">Purses</option>
							</optgroup>
						</select>
						
					</div>
					</div>
					<div class="form-row my-1">
					<label class="col-lg-4 col-md-4">Gender</label>
					<div class="col-lg-8 col-md-3">
						<select class="form-control @error('edGender') is-invalid @enderror" name="edGender" id="edGender">
							<option value="M">Male</option>
							<option value="F">Female</option>
							<option value="N">None</option>
						</select>
						@error('edGender')
						<script type="text/javascript">$("#edit").modal('show');</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
					<div class="form-row my-1">
						<label class="col-lg-4 col-md-4">Product Quantity</label>
						<div class="col-lg-8 col-md-3">
							<input type="number" class="form-control @error('edPquan') is-invalid @enderror" name="edPquan" id="edPquan">
							@error('edPquan')
							<script type="text/javascript">$("#edit").modal('show');</script>
								<div class="invalid-feedback">
									<strong>{{$message}}</strong>
								</div>
							@enderror
						</div>
					</div>
					<div class="form-row my-1">
					<label class="col-lg-3">Product Image</label>
					<div class="col-lg-9">
						<input type="file" name="edPImage" id="edPhoto" accept="image/x-png,image/jpeg" >
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Preview Image</label>
					<div class="col-lg-9">
						<img src="" class='edPreviewPic' style="border:1px solid black; width: 150px; height: 150px;">
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Description</label>
					<div class="col-lg-9">
						<textarea class="form-control" name='edpDesc' id="edpDesc" style="resize: none;overflow: hidden;" placeholder="Enter Description Here" rows="5"></textarea>
					</div>
				</div>
				</div>
			<div class="modal-footer">
				<button class="btn btn-primary" type="submit">Edit</button>
			</div>
			</form>
		</div>
	</div>
</div>
{{-- End Edit Products --}}
{{-- Add Products --}}
<div class="modal fade" id="addProducts" data-backdrop='static'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Products</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
			</div>
			<form action="{{ route('addProduct') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
			<div class="modal-body">
				
				<div class="form-row">
					<label class="col-lg-3">Product No.</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" id="productNo" name="pNo" readonly>
					</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">Product Name</label>
					<div class="col-lg-9">
						<input type="text" class="form-control @error('pName') is-invalid @enderror" name="pName">
						@error('pName')
						<script type="text/javascript">addProduct()</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">Product Price</label>
					<div class="col-lg-9">
						<input type="number" class="form-control @error('pPrice') is-invalid @enderror" step="0.25" name="pPrice" >
						@error('pPrice')
						<script type="text/javascript">addProduct()</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row">
					<label class="col-lg-3">Product Category</label>
					<div class="col-lg-9">
						<select class="form-control @error('pCategory') is-invalid @enderror" name="pCategory" >
							<optgroup label="Men's Apparel">
								<option value="Mens Tops">Men's Tops</option>
								<option value="Mens Pants">Men's Pants</option>
								<option value="Mens Shorts">Men's Shorts</option>
								<option value="Mens Jacket & Hoodies">Jacket & Hoodies</option>
								<option value="Mens Socks">Socks</option>
								<option value="Mens Sneakers">Sneakers</option>
								<option value="Mens Sandals & Flip-flops">Sandals & Flip-flops</option>
								<option value="MensFormal">Formal</option>
							</optgroup>
							
							<optgroup label="Women's Apparel">
								<option value="Womens Dresses">Dresses</option>
								<option value="Womens Tops">Women's Tops</option>
								<option value="Womens Tees">Tees</option>
								<option value="Womens Pants">Women's Pants</option>
								<option value="Womens Skirts">Skirts</option>
								<option value="Womens Shorts">Women's Shorts</option>
								<option value="Womens Jackets">Jackets</option>
								<option value="Womens Shoes">Shoes</option>
								<option value="Womens Socks & Stockings">Socks & Stockings</option>
							</optgroup>
							<optgroup label="More Accessories">
								<option value="Shoulder Bags">Shoulder Bags</option>
								<option value="Hand Bags">Hand Bags</option>
								<option value="Backpacks">Backpacks</option>
								<option value="Drawstring Bags">Drawstring Bags</option>
								<option value="Tote Bags">Tote Bags</option>
								<option value="Clutches">Clutches</option>
								<option value="Purses">Purses</option>
							</optgroup>
						</select>
						@error('pCategory')
							<div class="invalid-feedback">
								<script type="text/javascript">addProduct()</script>
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-4 col-md-4">Gender</label>
					<div class="col-lg-8 col-md-3">
						<select class="form-control @error('pGender') is-invalid @enderror" name="pGender" id="pGender">
							<option value="M">Male</option>
							<option value="F">Female</option>
							<option value="N">None</option>
						</select>
						@error('pGender')
						<script type="text/javascript">$("#edit").modal('show');</script>
							<div class="invalid-feedback">
								<strong>{{$message}}</strong>
							</div>
						@enderror
					</div>
				</div>
				<div class="form-row my-1">
						<label class="col-lg-4 col-md-4">Product Quantity</label>
						<div class="col-lg-8 col-md-3">
							<input type="text" class="form-control @error('pQuan') is-invalid @enderror" name="pQuan" id="pQuan">
							@error('pQuan')
							<script type="text/javascript">$("#edit").modal('show');</script>
								<div class="invalid-feedback">
									<strong>{{$message}}</strong>
								</div>
							@enderror
						</div>
					</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Product Image</label>
					<div class="col-lg-9">
						<input type="file" name="pImage" id="photo" required accept="image/x-png,image/jpeg" >
					</div>
				</div>
				<div class="form-row py-1">
					<label class="col-lg-3">Preview Image</label>
					<div class="col-lg-9">
						<img src="" class='previewPic' style="border:1px solid black; width: 150px; height: 150px;">
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Description</label>
					<div class="col-lg-9">
						<textarea class="form-control" name='pDesc' style="resize: none;overflow: hidden;" placeholder="Enter Description Here" rows="5" required></textarea>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="submit">Add</button>
			</div>
			</form>
		</div>
	</div>
</div>
{{-- End Add Products --}}

{{-- View Products --}}

<div class="modal fade" id="viewProduct" data-backdrop='static'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title">Product Information</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            </div>
		<div class="modal-body">
			<div class="form-row">
					<label class="col-lg-3">Product No.</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" id="VproductNo" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Product Name</label>
					<div class="col-lg-9">
						<input type="text" class="form-control" id="VpName" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Product Price</label>
					<div class="col-lg-9">
						<input type="number" class="form-control" step="0.25" id="VpPrice" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Product Category</label>
					<div class="col-lg-9">
						<input type="text" id="VpCategory" class="form-control" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Gender</label>
					<div class="col-lg-9">
						<input type="text" id="VpGender" class="form-control" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Product Quantity</label>
					<div class="col-lg-9">
						<input type="number" class="form-control" step="0.25" id="VpQuan" readonly>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Preview Image</label>
					<div class="col-lg-9">
						<a href="#" onclick="viewImage()" id="iViewer"><img src="" class='VpreviewPic' style="border:1px solid black; width: 150px; height: 150px;"></a>
					</div>
				</div>
				<div class="form-row my-1">
					<label class="col-lg-3">Description</label>
					<div class="col-lg-9">
						<textarea class="form-control" id='VpDesc' style="resize: none;overflow: hidden;" placeholder="Enter Description Here" rows="5" readonly></textarea>
					</div>
				</div>
		</div>
		<div class="modal-footer">
			<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
		</div>
		</div>
	</div>
</div>

{{-- End View PRoducts --}}
{{-- Image Viewer --}}

<div class="modal fade" id="viewImage">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title nv"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              		<span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            	<div class="form-row">
            		<div class="col-lg-12">
            			<img src="" id="viewer" class="w-100 h-100">
            		</div>
            	</div>
            </div>
		</div>
	</div>
</div>

{{-- End Image Viewer --}}
{{-- Session message --}}
@if(session()->has('message'))
				<script type="text/javascript">
					Swal.fire({
						title: 'Added Successfully',
						icon:'success'
					});
				</script>
				{{-- <div class="alert alert-info xx">
					{!! session()->get('message') !!}
				</div> --}}
@endif
@if(session()->has('editSuccess'))
				<script type="text/javascript">
					Swal.fire({
						title: 'Updated Successfully',
						icon:'success'
					});
				</script>
				{{-- <div class="alert alert-info xx">
					{!! session()->get('message') !!}
				</div> --}}
@endif

{{-- Scripts --}}
<script type="text/javascript">
	function viewImage()
	{
		var img = $(".VpreviewPic").attr('src');
		var name = $("#VpName").val();
		$("#viewImage").modal('show');
		$(".nv").text(name);
		$("#viewer").attr('src', img);
	}
	function viewProduct(id)
	{
		$token = $('meta[name="csrf-token"]').attr('content');
		
		$.ajax({
			url: '{{ route('getProduct') }}',
			type: 'post',
			data: {'_token':$token, id:id},
			dataType: 'json',
			success: function(data)
			{
				
				$.each(data,function(i,e){

					$("#VproductNo").val(e.product_number);
					$("#VpName").val(e.product_name);
					$("#VpPrice").val(e.product_price);
					$("#VpGender").val(e.gender);
					$("#VpCategory").val(e.category);	
					$("#VpDesc").val(e.product_desc);
					$("#VpQuan").val(e.quantity);				
					$(".VpreviewPic").attr('src', '{{ asset('') }}'+e.product_imagelink);

				});
				$("#viewProduct").modal('show');
			}
		});
	}
	function addProduct()
	{
		$("#addProducts").modal('show');
		let x = generateProductNumber(4);
		checkPNumber(x);
	}
	function generateProductNumber(length)
	{
		var res = "";
		var num = "1234567890";
		var ret = "";
		for(var i = 0; i < length;i++)
		{
			res += num.charAt(Math.floor(Math.random() * num.length));
		}
		ret = "WA-"+res;
		return ret;
	}
	function checkPNumber(n)
	{
		var x = "";
		$token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: "{{ route('checkPNumber') }}",
			type: "post",
			data:{"_token":$token,n:n},
			dataType: 'html',
			success: function(data)
			{
				if(data == 1)
				{
					generateProductNumber(4);
				}
				else
				{
					$("#productNo").val(n);
				}
			}
		});
	}
	function del(id){
		$token = $('meta[name="csrf-token"]').attr('content');
		Swal.fire({
						title: 'Are you sure you want to delete?',
						icon: 'question',
						showCancelButton: true,
					}).then((e) =>{
						if(e.isConfirmed)
						{
							$.ajax({
								url: '{{ route('deleteProduct') }}',
								type: 'post',
								data: {'_token':$token, id:id},
								dataType: 'html',
								success: function(data)
								{
									if(data == 1)
									{
										Swal.fire({
											title: 'Product deleted Successfully',
											icon: 'success',
											allowOutsideClick: false,
											allowEscapeKey: false
										}).then((e) =>{
											if(e.isConfirmed)
											{
												window.location.reload();
											}
										});
									}
									else
									{
										Swal.fire({
											title: 'Unexpected Error Occurred',
											icon: 'error',
											allowOutsideClick: false,
											allowEscapeKey: false
										});
									}
								}
							});
						}
					});
		
	}
	function edit(id)
	{
		
		$token = $('meta[name="csrf-token"]').attr('content');
		
		$.ajax({
			url: '{{ route('getProduct') }}',
			type: 'post',
			data: {'_token':$token, id:id},
			dataType: 'json',
			success: function(data)
			{
				
				$.each(data,function(i,e){

					$("#edPnumber").val(e.product_number);
					$("#edPname").val(e.product_name);
					$("#edPprice").val(e.product_price);
					$("#edPcategory").val(e.category);
					$("#edGender").val(e.gender);
					$("#edpDesc").val(e.product_desc);
					$("#edPquan").val(e.quantity);
					$(".edPreviewPic").attr('src', '{{ asset('') }}'+e.product_imagelink);
				});
				$("#edit").modal('show');
			}
		});


	}
	$(function(){
			$("#photo").change(function(){
	var input = this;
	var url = $(this).val();
	var ext = url.substring(url.lastIndexOf('.') +1).toLowerCase();

	if(input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")){
		var reader = new FileReader();
		reader.onload=function(e){
			$(".previewPic").attr("src",e.target.result);
			console.log(url);
		}
		reader.readAsDataURL(input.files[0]);

	}
	else{

		$(".previewPic").attr("src","");
		console.log(url);
	}


});
});
	$(function(){
			$("#edPhoto").change(function(){
	var input = this;
	var url = $(this).val();
	var ext = url.substring(url.lastIndexOf('.') +1).toLowerCase();

	if(input.files && input.files[0]&& (ext == "png" || ext == "jpeg" || ext == "jpg")){
		var reader = new FileReader();
		reader.onload=function(e){
			$(".edPreviewPic").attr("src",e.target.result);
			console.log(url);
		}
		reader.readAsDataURL(input.files[0]);

	}
	else{

		$(".edPreviewPic").attr("src","");
		console.log(url);
	}


});
});
</script>
@endsection
