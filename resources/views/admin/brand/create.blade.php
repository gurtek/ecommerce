@extends('layouts.adminlayout.dashboard')

@section('content')

	<section class="content-header">
      <h1>
      Add Brand
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('brands.index') }}"><i class="fa fa-dashboard"></i> Brands</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-8">
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
    {{ Form::open(['url' => route('brands.store'), 'method'=>'post', 'files' => true ]) }}
        <div class="form-group">
            {{ Form::label('brand_name') }}
            {{ Form::text('brand_name', null, ['class' => 'form-control']) }}
           
        </div>
        <div class="form-group">
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