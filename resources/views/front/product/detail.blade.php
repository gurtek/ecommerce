@extends('layouts.frontlayout.home')
@section('content')
<div class="product-details"><!--product-details-->
	@if(session()->get('message'))
		<div class="alert alert-success">{{ session()->get('message') }}</div>
	@endif
	<div class="col-sm-5">

	
	@if(optional($product->attachements) && count($product->attachements) )
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
	@if(count($product->attachements) > 1)
		<ol class="carousel-indicators">
			@foreach($product->attachements as $image)
				<li data-target="#myCarousel" data-slide-to="{{ $loop->index }}" 
				class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
			@endforeach
		</ol>
	@endif

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	  	@foreach($product->attachements as $image)
		  <div class="active">
			<img src="{{ $image->file_path }}" style="width:100%;">
		</div>
		@endforeach
    </div>

    <!-- Left and right controls -->
	@if(count($product->attachements) > 1)
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only">Next</span>
		</a>
		@endif
  </div>
	@else 
	<img src = "{{ asset('images/no-image.png') }}" alt = "no image"  class="img img-responsive" />
  @endif

	</div>
	<div class="col-sm-7">
		{{ Form::open(['url' => route('add.to.cart'), 'method' => 'post']) }}
		<input type="hidden" name = "product_id" value = "{{ $product->id }}" />
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2 style = 'text-transform:capitalize;'>{{ $product->product_name }}</h2> 
			<span>
				<input type="hidden" value = "{{ $product->product_price }}" id = "#price">
				<span id = "price-wrapper">{{ 'Rs ' . $product->product_price }}</span>
				<label>Quantity:</label>
				<input type="number" value="1" name = "quantity" min = "1" 
				max = "{{ $product->quantity }}"/>
			</span>
			<p><b>Quantity:</b> {{ $product->quantity }} - In Stock</p>
			<p><b>Brand:</b> E-SHOPPER</p>
			@if(count($attributes))
				<div>
					@foreach($attributes as $key => $attribute)
						<label  style = 'margin-top: 4px;'>{{ $key }}</label>
						<select name="attribute_values[]" id="{{ $key }}" 
						class="form-control mb-1 attribute_values">
							<option value="0" data-price = "0">Choose an option</option>
							@if($attribute->count())
								@foreach($attribute as $value)

									<option data-price="{{ $value->attribute_price }}" 
									value="{{ $value->attribute_value_id }}">
									{{ $value->attribute_value }}
									</option>
								@endforeach
							@endif
						</select>
					@endforeach
				</div>
			@endif
			<br />
			<button type="submit" class="btn btn-fefault cart" style = 'margin-left: 0px !important;'>
					<i class="fa fa-shopping-cart"></i>
					Add to cart
			</button>
			
		</div><!--/product-information-->
		{{ Form::close() }}
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li  class="active"><a href="#details" data-toggle="tab">Details</a></li>
			
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details" >
			{{ $product->product_description }}
		</div>
	</div>
</div><!--/category-tab-->

<!-- <div class="recommended_items"> 
	<h2 class="title text-center">recommended items</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">	
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend1.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend2.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend3.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="item">	
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend1.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend2.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/recommend3.jpg" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
			</a>
			<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
			</a>			
	</div>
</div>  -->
					
@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
			let price = "{{ $product->product_price }}"; 
			price = parseFloat(price);
			let attributePrice;
			$('.attribute_values').on('change', function(){
				attributePrice = 0;
				let total = 0;
				$.each($(".attribute_values option:selected"), function(){
					let value = $(this).data('price');
						attributePrice+= parseFloat(value);
				});
				total = price + attributePrice;
				$('#price-wrapper').html('Rs ' + total.toFixed(2));
			});
		});
	</script>
@endsection