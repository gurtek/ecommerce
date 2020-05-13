@extends('layouts.adminlayout.dashboard')

@section('content')
    <section class="content-header">
      <h1>
      Attribute List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('attributes.index') }}"><i class="fa fa-dashboard"></i> Attributes</a></li>
        <li ><a href="{{ route('attributes.create') }}">Add New</a></li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-12">    
    @if($attributes->count()) 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribute Name</th>                
                <th>Action </th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($attributes as $attribute)
            <tr>
                <td>{{ $attribute->name }}</td>                
                <td>
				<a class="btn btn-light btn-xs edit_margin" href="{{ route('attribute.valueindex', $attribute) }}">Assign Values</a>
                <a class="btn btn-light btn-xs edit_margin" href="{{ route('attributes.edit', $attribute) }}">Edit</a>
                {{ Form::open([
                                'url' => route('attributes.destroy', $attribute), 
                                'method' => 'post'
                                ]) 
                }}
                    @method('delete')
                    {{ Form::submit('Delete' , ['class' => 'btn btn-danger btn-xs'] ) }}
                {{ Form::close() }}
                </td>
            </tr> 
        @endforeach
        {{ $attributes->links() }}
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