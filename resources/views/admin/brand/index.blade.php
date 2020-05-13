@extends('layouts.adminlayout.dashboard')

@section('content')    
    <section class="content-header">
      <h1>
      Brand List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('brands.index') }}"><i class="fa fa-dashboard"></i> Brands</a></li>
        <li ><a href="{{ route('brands.create') }}">Add New</a></li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-12">    
    @if($brands->count()) 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Brand Name</th>
                <th>Image</th>
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->brand_name }}</td>
                <td></td>
                <td>
                <a class="btn btn-light btn-xs edit_margin"  href="{{ route('brands.edit', $brand) }}">Edit</a>
                {{ Form::open([
                                'url' => route('brands.destroy', $brand), 
                                'method' => 'post'
                                ]) 
                }}
                    @method('delete')
                    {{ Form::submit('Delete' , ['class' => 'btn btn-danger btn-xs']) }}
                {{ Form::close() }}
                </td>
            </tr> 
        @endforeach
        {{ $brands->links() }}
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