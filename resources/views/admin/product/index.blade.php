@extends('layouts.adminlayout.dashboard')

@section('content')
    <section class="content-header">
      <h1>
      Products
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('products.index') }}"><i class="fa fa-dashboard"></i> Products</a></li>
        <li ><a href="{{ route('products.create') }}">Add New</a></li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-12">    
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
    @if($products->count()) 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Categories</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->product_name }}</td>
            <td>
               @if($product->has('productCategories'))
                @foreach($product->productCategories as $c)
                  <span class="label label-success">{{ $c->category_name }}</span>
                @endforeach
               @endif
            </td>
            <td>
               {{ $product->product_price }}
            </td>
            <td>
               {{ $product->quantity }}
            </td>
            <td><a class="btn btn-light btn-xs edit_margin"
               href="{{ route('products.edit', $product) }}">Edit</a>
           
                {{ Form::open([
                                'url' => route('products.destroy', $product), 
                                'method' => 'post'
                                ]) 
                }}
                    @method('delete')
                    {{ Form::submit('Delete' , 
                    ['class' => 'btn btn-danger btn-xs']) }}
                {{ Form::close() }}
            </td>
            </tr>
        @endforeach
        {{ $products->links() }}
        </tbody>
        @else 
        <tr>
            <td colspan="5">No result found.</td>
        </tr>
       
    @endif
    </table>
    </div>
	</section>
@endsection