@extends('layouts.frontlayout.home')


@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Products</h2>
    @if($products->count())
        @foreach($products as $product)
        <div class="col-sm-4"> <!-- start of the product item wrapper  -->
            <div class="product-image-wrapper">
                <a href="{{ route('front.product.detail', ['slug' => $product->product_slug]) }}">
                    <div class="single-products">
                            <div class="productinfo text-center">
                            
                                @if(optional($product->attachements) && count($product->attachements))
                                    <img src="{{ $product->attachements->first()->file_path }}" 
                                        alt="{{ $product->product_name }}" />
                                    @else
                                    <img src = "{{ asset('images/no-image.png') }}" alt = "no image" 
                                            class="img img-responsive" 
                                        />
                                @endif
                                
                                <h2>{{ '$ '. $product->product_price }}</h2>
                                <p>{{ $product->product_name }}</p>
                                <a href="{{ route('front.product.detail', ['slug' => $product->product_slug]) }}" class="btn btn-default add-to-cart">
                                <i class="fa fa-shopping-cart"></i>View</a>
                            </div>
                    </div>
                </a>									
            </div>
        </div> <!-- end of the product item wrapper  -->
        @endforeach

        @else 
        <p class="text-center" style = "padding: 30px 0px;">No Product Found </p>
        
    @endif


    </div> 
					 
					
@endsection