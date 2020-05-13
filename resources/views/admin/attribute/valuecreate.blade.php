@extends('layouts.adminlayout.dashboard')

@section('content')
	<section class="content-header">
      <h1>
      Add Attribute Value
        <small></small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ route('attributes.index') }}"><i class="fa fa-dashboard"></i> Attributes</a></li>
        <li><a href="{{ route('attribute.valueindex',$attribute) }}"><i class="fa fa-dashboard"></i> Attribute Values</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-8">
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
        {{ Form::open(['url' => route('attribute.valuestore',$attribute), 'method'=>'post']) }}
        <div class="form-group">
                    {{ Form::label('attribute_value') }}
                    {{ Form::text('attribute_value', null, ['class' => 'form-control']) }}
                   
        </div>
        <div class="form-group">
            @error('attribute_value')
                <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
        </div>
                <div class="form-group">            
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                </div>
        {{ Form::close() }} 
    </div>  
</section>
@endsection