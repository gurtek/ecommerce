@php
        $menus = menus();
@endphp
<div class="left-sidebar">
					
	<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		@if($menus->count())
			@foreach($menus as $menu)
				@if(count($menu->children))
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" 
								data-parent="#accordian" 
								href="#{{ $menu->category_slug }}">
								<span class="badge pull-right"><i class="fa fa-plus"></i></span>
								{{ $menu->category_name }}
							</a>
						</h4>
					</div>
					<div id="{{ $menu->category_slug }}" class="panel-collapse collapse">
						<div class="panel-body">
							<ul>
								@foreach($menu->children as $child)
									<li><a href="{{ route('front.products', ['type' => 'category', 'value' => $child->id ]) }}">{{ $child->category_name }}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div> 
				@else		
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="{{ route('front.products', ['type' => 'category', 'value' => $menu->id ]) }}">
								{{ $menu->category_name }}</a></h4>
					</div>
				</div>
				@endif
			@endforeach
		@endif
		
		
		
	</div><!--/category-products-->

	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		<div class="brands-name">
			@php
				$brands = getBrands();
			@endphp

			@if($brands->count())
			<ul class="nav nav-pills nav-stacked">
				@foreach($brands as $brand)
					<li><a href="{{ route('front.products', ['type' => 'brand', 'value' => $brand->id ]) }}"> <span class="pull-right">({{ $brand->products->count() }})</span>{{ $brand->brand_name  }}</a></li>
				@endforeach
			</ul>
			@endif
		</div>
	</div><!--/brands_products-->
	
	<!-- <div class="price-range">
		<h2>Price Range</h2>
		<div class="well text-center">
				<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
				<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div> -->
	<!--/price-range-->
	
	<div class="shipping text-center"><!--shipping-->
		<img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
	</div><!--/shipping-->

	<br /><br />

</div>