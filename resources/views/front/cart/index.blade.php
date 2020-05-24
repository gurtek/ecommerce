@extends('layouts.frontlayout.fullwidth')

@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@if($cart->count())
						@foreach($cart as $item)
						@php
							$options = null;
							$image = asset('images/no-image.png');
							
							if($item->attributes->image != null) {
								$image = $item->attributes->image;
							}

							if($item->attributes->options != null) {
								$options = unserialize($item->attributes->options);
							}
						@endphp
						<tr>
								<td class="cart_product">
									<a href="javascript:void(0);"><img src="{{ $image }}" 
									style = "width: 100px; height: 100px;"
									class="img img-thumbnail"></a>
								</td>
								<td class="cart_description">
									<h4><a href="javascript:void(0);">{{ $item->name }}</a></h4>
									@if($options)
										@foreach($options as $option)
											<div>
												{{ $option['attribute_name'] . '-' . $option['attribute_value'] }}
											</div>
										@endforeach
									@endif
									
								</td>
								<td class="cart_price">
									<p>{{ '$ '. number_format($item->price, 2) }}</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input
										class="cart_quantity_input" 
										id="{{ $item->id }}"
										type="number" name="quantity" 
										value="{{ $item->quantity }}" autocomplete="off" style = "width: 40px;">
										
										<a data-id="{{ $item->id }}" href="javascript:void(0);"
										 class="btn btn-xs update-item" title = "click here to update quantity">
											<i class="fa fa-refresh" aria-hidden="true"></i>
										</a>

									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">
										{{ '$ ' . number_format($item->price * $item->quantity, 2) }}
									</p>
								</td>
								<td class="cart_delete">
									<a data-id="{{ $item->id }}" class="cart_quantity_delete" href="javascript:void(0);">
										<i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
							@endforeach
						@else
						<tr>
							<td colspan="5" class="text-center">
								<h4>Cart is empty</h4>
								<p><a href="{{ route('home') }}" class="btn btn-danger">Continue Shopping</a></p>
							</td>
						</tr>
					@endif
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	@if($cart->count()) 
		<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
			<div class="col-md-3"> <div class="total_area">
						<ul>
							<li>Total <span>{{ '$ '. number_format($cartTotal, 2) }}</span></li>
						</ul>
						</div> 
						
						</div>
		</div>

		<a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a> 
		</div>
		<br /><br /><br >
	@endif
@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
			$('.cart_quantity_delete').on('click', function(){
				const id = $(this).data('id');
				if(confirm('are you sure to remove item from cart?')) {
					$.ajax({
						method: 'GET',
						data: {
							id: id
						},
						url: "{{ route('remove.item') }}",
						success: function(result) {
							if(result.status == 200) {
								alert(result.message);
								setTimeout(() => {
									window.location.reload();
								}, 300);
							}
						}
					});
				}
			});
			
			$('.update-item').on('click', function(){
				const id = $(this).data('id');
				const quantity = $('#' + id).val();

				if(confirm('are you sure to update item?')) {
					$.ajax({
						method: 'GET',
						data: {
							id: id,
							quantity: quantity
						},
						url: "{{ route('update.item') }}",
						success: function(result) {
							if(result.status == 200) {
								alert(result.message);
								setTimeout(() => {
									window.location.reload();
								}, 300);
							}
						}
					});
				}
			});
		});
	</script>
@endsection