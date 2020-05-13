@extends('layouts.adminlayout.dashboard')

@section('content')
    <section class="content-header">
      <h1>
      Attribute Values For {{ $attribute->name }}
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('attributes.index') }}"><i class="fa fa-dashboard"></i> Attributes</a></li>
        <li><a href="{{ route('attribute.valueindex',$attribute) }}"><i class="fa fa-dashboard"></i> Attribute Values</a></li>
        <li ><a href="{{ route('attribute.valuecreate',$attribute) }}">Add New</a></li>
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
            
        @foreach($attributes as $attribute_value)
            <tr>
                <td>{{ $attribute_value->attribute_value }}</td>                
                <td>
				
                <a class="btn btn-light btn-xs edit_margin" href="{{ route('attribute.valueedit', [$attribute,$attribute_value]) }}">Edit</a>
                {{ Form::open([
                                'url' => route('attribute.valuedestroy', $attribute,$attribute_value), 
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