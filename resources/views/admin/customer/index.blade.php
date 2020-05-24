@extends('layouts.adminlayout.dashboard')

@section('content')
    <section class="content-header">
      <h1>
      Customer List
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
    @if($customers->count()) 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer Name</th>                
                <th>Email</th>
                <th>Mobile</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>                
                <td>{{ $customer->email }}</td>                
                <td>{{ $customer->mobile }}</td>
            </tr> 
        @endforeach
        {{ $customers->links() }}
        </tbody>
        @else 
        <tr>
            <td colspan="3">No result found.</td>
        </tr>
    @endif
    </table>
    </div>
	</section>
@endsection