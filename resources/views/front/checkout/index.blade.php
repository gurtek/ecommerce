@extends('layouts.frontlayout.fullwidth')

@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

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
			@if($cart->count())
			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-4 clearfix">
						<div class="bill-to">
							<p>Billing Detail</p>
							<div class="form-one" style="width:100%">
								 <form>
									<label for="firstname" style='font-weight: normal'>First Name*</label>
									<input readonly type="text" placeholder="First Name *" value="{{ auth()->user()->name }}">

									<label for="lastname" style='font-weight: normal'>Email</label>
									<input readonly type="text" value="{{ auth()->user()->name }}">

									<label for="mobile" style='font-weight: normal'>Mobile*</label>
									<input  readonly type="text" value="{{ auth()->user()->mobile }}">
								</form>
							</div>
							
						</div>
					</div>
					<div class="col-sm-8 clearfix">
						<div class="bill-to">
							<p>Address</p>
							<div class="form-one" style="width:100%">
								
								<div class="row">
										<div class="col-md-10">
										<label for="address" style='font-weight: normal'>Address</label>
									<select name="address" id="address-select">
										<option value="">Select an address</option>
										@if($addresses->count())
											@foreach($addresses as $address)
												<option value="{{ $address->id }}">
													{{ $address->name . '(' . $address->address . ')' }}
												</option>
											@endforeach
										@endif
									</select>
										</div>	
										<div class="col-md-2">
											<a style = "margin-top: 25px;" id="address-add-btn" class="btn btn-sm btn-block btn-primary">
											Add address</a>
										</div>	
									</div>

									<hr />

									<div id ="address-detail">
									<div class="row">
											<div class="col-md-12">
													<div id = "errors-wrapper"></div>
													<div class="form-group">
														<label 
														style='font-weight: normal'>Address Name*</label>
														<input class="form-control" type="text"  
														readonly
														id = "address-name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="city" 
														style='font-weight: normal'>City*</label>
														<input id = "address-city" 
														readonly
														class="form-control" type="text"  
														>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="state" 
														style='font-weight: normal'>State*</label>
														<input id = "address-state" 
														readonly
														class="form-control" type="text"
														>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label style='font-weight: normal'>
														Country*</label>
														<input  id = "address-country" 
														readonly
														class="form-control" type="text"
														>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label style='font-weight: normal'>
														Pincode*</label>
														<input readonly id = "address-pincode" class="form-control" type="text"
														>
													</div>		
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
														<label style='font-weight: normal'>
														Address*</label>
														<input class="form-control"
														readonly
														type="text"id="my-address">
													</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
														<label style='font-weight: normal'>
														Landmark (if any)</label>
														<input readonly type="text"  class="form-control" 
														id="address-landmark">
													</div>
												</div>
											</div>
									</div>

									<div class="address-add-wrapper">
										{{ Form::open(['url' => route('add.address'), 
										'method' => 'post', 'id' => 'address-form']) }}
											
											<div class="row">
											<div class="col-md-12">
													<div id = "errors-wrapper"></div>
													<div class="form-group">
														<label 
														style='font-weight: normal'>Address Name*</label>
														<input class="form-control" type="text"  
														name="name" id = "name">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label for="city" 
														style='font-weight: normal'>City*</label>
														<input id = "city" class="form-control" type="text"  name="city">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label for="state" 
														style='font-weight: normal'>State*</label>
														<input id = "state" class="form-control" type="text" name="state">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label style='font-weight: normal'>
														Country*</label>
														<input  id = "country" class="form-control" type="text" name="country">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label style='font-weight: normal'>
														Pincode*</label>
														<input id = "pincode" class="form-control" type="text"
														 name="pincode">
													</div>		
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
														<label style='font-weight: normal'>
														Address*</label>
														<input class="form-control"
														type="text" name = "address" id="address">
													</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
														<label style='font-weight: normal'>
														Landmark (if any)</label>
														<input type="text" name = "land_mark" class="form-control" 
														id="land_mark">
													</div>
												</div>
											</div>
											<button>Add New Address</button>
										{{ Form::close() }}
									</div>
								
							</div>
						</div>
					</div>
					 					
				</div>
			</div>
			<div id = "paypal-button-container">
			</div>

			<br /><br /> 
			@endif
		</div>
	</section> <!--/#cart_items-->
	
	<!-- overlay -->

	<div class="overlay hidden">
		<div class="overlay__inner">
			<div class="overlay__content"><span class="spinner"></span>
		</div>
		</div>
	</div>
	
	<script src="https://www.paypal.com/sdk/js?client-id=AWoKoY6QgMDpMN5ZYHAnTDkHL9_lY1Iojuf-JMr7JoOAQpf-SeGliLXBxqZSDvQ1jyYfOmD2Ar6HUZpz"></script>
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
								}, 100);
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
								}, 100);
							}
						}
					});
				}
			});
		});
	</script>
	
	<script>
      paypal.Buttons({
		style: {
                layout: 'horizontal'
		},
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: "{{ $cartTotal }}"
              }
            }]
          });
        },
        onApprove: function(data, actions) {
			$('.overlay').removeClass('hidden');
          return actions.order.capture().then(function(details) {
			  if(details.status === 'COMPLETED') {
				  	
					const addressId = $('#address-select option:selected').val();
					$.ajax({
						method: 'POST',
						url: "{{ route('execute.payment') }}",
						data: {
							address_id: addressId,
							transaction_id: details.id,
							_token: "{{ csrf_token() }}",
							amount: details.purchase_units[0].amount.value
						},
						success: function(response){
							if(response.status == 200) {
								window.location.href = "{{ route('my.orders') }}";
							}
						}
					});
			  }
          });
        }
      }).render('#paypal-button-container'); // Display payment options on your web page
    </script>

	<script>
		$(document).ready(function(){
			$('#address-add-btn').on('click', function(){
				$('.address-add-wrapper').show();
			});

			$('#address-form').on('submit', function(e){
				e.preventDefault();
				const form = $(this).serialize();
				$.ajax({
					url: "{{ route('add.address') }}",
					data: {
						formdata : form, 
						_token: "{{ csrf_token() }}"
					},
					type: "POST",
              		success: function (response) {
						if(response.status == 400) {
							if(response.message.length > 0) {
								let errors = "<ul class='alert alert-danger' style = 'list-style-type: none'>";
								response.message.forEach(function(e){
								errors+= "<li>" + e + "</li>";
								});
								errors+= "</ul>";

								$('#errors-wrapper').html(errors);
							}
						} else {
							alert(response.message);
							setTimeout(() => {
								window.location.reload();
							}, 100);
						}
					}
				});

				});

				$('#address-select').on('change', function(){
					$('.address-add-wrapper').hide();
					const paypalContainer = $('#paypal-button-container');
					const value = $(this).val();
					if(value == null || value == undefined || value == '') {
						$('#address-detail').hide();
						return false;
						paypalContainer.hide();
					}

					paypalContainer.show();

					$.ajax({
						method:'GET',
						url: "{{ route('address.detail') }}",
						data: {
							id: value
						}, 
						success: function(response) {
							if(response.status == 200) {
								$('#address-detail').show();
								$('#address-name').val(response.data.name);
								$('#address-city').val(response.data.city);
								$('#address-state').val(response.data.state);
								$('#address-country').val(response.data.country);
								$('#address-pincode').val(response.data.pincode);
								$('#my-address').val(response.data.address);
								$('#address-landmark').val(response.data.land_mark);
							} else {
								$('#address-detail').hide();
							}
						}
					});
				}); 

			}); // end of document
		 
	</script>
  
@endsection