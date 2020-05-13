@extends('layouts.adminlayout.dashboard')

@section('content')
	<section class="content-header">
      <h1>
      Edit Brand
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('brands.index') }}"><i class="fa fa-dashboard"></i> Brands</a></li>
        <li class="active">Edit Brand</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">   
    <div class="col-md-8">

    {{ Form::model($brand, ['url' => route('brands.update', $brand), 'method'=>'post']) }}
    @method('put')
        <div class="form-group">
            {{ Form::label('brand_name') }}
            {{ Form::text('brand_name', null, ['class' => 'form-control']) }}
            @error('brand_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('image') }}
            {{ Form::file('image') }}            
        </div>
        <div class="form-group">
           
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div>

    {{ Form::close() }}
    </div>
</section>	
@endsection