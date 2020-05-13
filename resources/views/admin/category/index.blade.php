@extends('layouts.adminlayout.dashboard')

@section('content')
    <section class="content-header">
      <h1>
      Categories List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-dashboard"></i> Categories</a></li>
        <li ><a href="{{ route('categories.create') }}">Add New</a></li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-12">    
    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }} </div>
    @endif
    @if($categories->count()) 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Image</th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->category_name }}</td>
            <td>
                @if($category->image!='') 
                    <img src="{{ asset('storage/uploads/'.$category->image) }}" height="50">
                @endif
            </td>
            <td><a class="btn btn-light btn-xs edit_margin" href="{{ route('categories.edit', $category) }}">Edit</a>
           
                {{ Form::open([
                                'url' => route('categories.destroy', $category), 
                                'method' => 'post'
                                ]) 
                }}
                    @method('delete')
                    {{ Form::submit('Delete' , ['class' => 'btn btn-danger btn-xs']) }}
                {{ Form::close() }}
            </td>
            </tr>
        @endforeach
        {{ $categories->links() }}
        </tbody>
        @else 
        <tr>
            <td colspan="2">No result found.</td>
        </tr>
       
    @endif
    </table>
    </div>
	</section>
@endsection