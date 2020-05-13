@extends('layouts.adminlayout.dashboard')

@section('content')
<section class="content-header">
      <h1>
      Product List
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
	</div>
	</section>
@endsection;