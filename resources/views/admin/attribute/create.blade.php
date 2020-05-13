@extends('layouts.adminlayout.dashboard')

@section('content')
	<section class="content-header">
      <h1>
      Add Attribute
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('attributes.index') }}"><i class="fa fa-dashboard"></i> Attributes</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-8">
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
        {{ Form::open(['url' => route('attributes.store'), 'method'=>'post']) }}
        <div class="form-group">
                    {{ Form::label('name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @error('name')
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