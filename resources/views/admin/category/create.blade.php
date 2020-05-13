@extends('layouts.adminlayout.dashboard')

@section('content')
    
    <section class="content-header">
      <h1>
      Add Category
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-dashboard"></i> Categories</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-8">
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
    {{ Form::open(['url' => route('categories.store'), 'method'=>'post', 'files' => 'true' ]) }}
        <div class="form-group">
            {{ Form::label('category_name') }}
            {{ Form::text('category_name', null, ['class' => 'form-control']) }}
           
        </div>
        <div class="form-group">
            @error('category_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('parent') }}
            {{ Form::select('parent', $categories, null, ['class' => 'form-control']) }}            
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