@extends('layouts.adminlayout.dashboard')

@section('content')
<section class="content-header">
      <h1>
      Add Product
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('products.index') }}"><i class="fa fa-dashboard"></i> Products</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    <section class="content container-fluid">
    <div class="col-md-12">
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Attachments</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Attributes</a>
  </li>
</ul>
{{ Form::open(['url' => route('categories.store'), 'method'=>'post', 'files' => 'true' ]) }}   
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="form-group">
            {{ Form::label('product_name') }}
            {{ Form::text('product_name', null, ['class' => 'form-control']) }}
            @error('product_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
            {{ Form::label('product_description') }}
            {{ Form::textarea('product_description', null, ['class' => 'form-control']) }}
            @error('product_description')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
            {{ Form::label('categories') }}
            {{ Form::select('parent', $categories, null, ['multiple' => 'multiple', 'class' => 'form-control']) }}
            @error('category_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
            {{ Form::label('category_name') }}
            {{ Form::text('category_name', null, ['class' => 'form-control']) }}
            @error('category_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
            {{ Form::label('category_name') }}
            {{ Form::text('category_name', null, ['class' => 'form-control']) }}
            @error('category_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
    </div>


  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel">
  
   <div class="form-group">
            {{ Form::label('attributes') }}
            {{ Form::select('attributes', $attributes, null, 
            ['class' => 'form-control', 'id' => 'attribute', 
                'data-route' => route('attribute.value') ]) }}
            @error('category_name')
              <span class="alert alert-danger">  {{ $message }}</span>
            @enderror
   </div>

   <div id = "attribute-values-wrapper">
        attribute values will be here
   </div>

  </div>
</div>
  {{ Form::close() }}
  </section>
@endsection

@section('scripts')
    <script>
        $(function(){
           $('#attribute').on('change', function () {
                const value = $(this).val();
                const route = $(this).data('route');
                $.ajax({
                    url: route,
                    method: 'GET',
                    data: { 
                        'id': value 
                    },
                    success: function(res) {
                        console.log(res);
                    }
                });
           }) 
        });
    </script>
@endsection