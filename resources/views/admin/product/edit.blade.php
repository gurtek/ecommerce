@extends('layouts.adminlayout.dashboard')

@section('content')
<section class="content-header">
      <h1>
      Edit Product
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('products.index') }}"><i class="fa fa-dashboard"></i> Products</a></li>
        <li class="active">Add</li>
      </ol>
    </section>
    <hr>
    {{ Form::model($product, ['url' => route('categories.update', $product), 'method'=>'post' , 'id' => 'product-form' ]) }}  

    <section class="content container-fluid">
    <div class="col-md-12">

    <div id="errors-wrapper"></div>


    <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Attribute</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Images</a></li>
  </ul>


  <!-- Tab panes -->
  <div class="tab-content" style = "padding: 10px;">
    <div role="tabpanel" class="tab-pane active" id="home">
      <div class="form-group">
              {{ Form::label('product_name') }}
              {{ Form::text('product_name', null, ['class' => 'form-control']) }}
              {{ Form::hidden('product_id', $product->id) }}
              
      </div>
      <div class="form-group">
              {{ Form::label('product_description') }}
              {{ Form::textarea('product_description', null, ['class' => 'form-control']) }}
              
      </div>

      <div class="form-group">
              {{ Form::label('price') }}
              {{ Form::number('price', $product->product_price, ['class' => 'form-control']) }}
              
      </div>

      <div class="form-group">
              {{ Form::label('quantity') }}
              {{ Form::number('quantity', null, ['class' => 'form-control']) }}
              
      </div>

      <div class="form-group">
              {{ Form::label('brand') }}
              {{ Form::select('brand', $brands, $product->brand_id, ['class' => 'form-control']) }}
              
      </div>

    <div class="form-group">
            {{ Form::label('categories') }}
            {{ Form::select('categories[]', $categories, $productCategories, ['multiple' => 'multiple', 'class' => 'form-control']) }}
            
    </div> 

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
                    {{ Form::label('attributes') }}
                    {{ Form::select('attributes', $attributes, null, 
                    ['class' => 'form-control', 'id' => 'attribute', 
                    'data-route' => route('attribute.value') ]) }}
            </div>
          </div>
        </div>

      <div class="row">
            <div class="col-md-6">
            <div id = "attribute-values-wrapper"></div>
            </div>
            <div class="col-md-6">
                  <div id="render-wrapper">
                      @if($productAttributes->count())
                        @php
                          $ids = [];
                        @endphp
                        @foreach($productAttributes as $attributeValue)
                          @php
                            $ids[] =  $attributeValue->attribute_value_id;
                          @endphp
                          <div id="attribute_name_{{ $attributeValue->attribute_id }}">
                            <div class="well"> 
                              <p style="font-weight: bold; font-size: 16px; text-transform: capitalize; font-family: sans-serif;">{{ $attributeValue->attribute_name }} - {{ $attributeValue->attribute_value }}</p> 
                              <div class="row">     
                              <div class="col-md-12"> <label>price</label>
                              <input type="number" value = "{{ $attributeValue->attribute_price }}" step="0.01" class="form-control" name="attribute_price[]"> 
                              <input type="hidden" class="form-control" name="attribute_value_id[]" value="{{ $attributeValue->attribute_value_id }}"> </div> 
                               </div>
                               <!-- <a href="javascript:void(0);" class = "remove" data-id = "{{ $attributeValue->attribute_id }}">Remove</a> -->
                               </div>
                              
                              </div>
                        @endforeach
                      @endif
                  </div>
            </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
      @php
            $totalImages = 5;
      @endphp
      @if($product->has('attachements') && optional($product->attachements->count()))
            @php
                $totalImages = abs(5 - $product->attachements->count());
            @endphp
          @foreach($product->attachements as $image)
            <div class="row" id="attachment_row1">
              <div class="col-md-6" >
                <div class="input-group">
                <span class="input-group-btn">
                  <a data-input="thumbnail{{ $image->id }}" data-preview="holder{{ $image->id }}" 
                  class="lfm btn btn-primary">
                  <i class="fa fa-picture-o"></i> CHOOSE
                  </a>
                </span>
                <input id="thumbnail{{ $image->id }}" 
                      value = "{{ $image->file_path }}"
                  class="form-control" type="text" name="image[]" readonly>
                </div>
                <img id="holder{{ $image->id }}" style="margin-top:15px;max-height:100px;">
              </div> 
          </div>
          @endforeach
      @endif

  @for($i = 1; $i <= $totalImages; $i++)
  <div class="row" id="attachment_row_x_{{ $i }}">
      <div class="col-md-6" >
        <div class="input-group">
        <span class="input-group-btn">
          <a data-input="thumbnail_x_{{ $i }}" data-preview="holder_x_{{ $i }}" class="lfm btn btn-primary">
          <i class="fa fa-picture-o"></i> CHOOSE
          </a>
        </span>
        <input id="thumbnail_x_{{ $i }}" class="form-control" type="text" name="image[]" readonly>
        </div>
        <img id="holder_x_{{ $i }}" style="margin-top:15px;max-height:100px;">
      </div> 
  </div>
  @endfor
   

	<div id="product_attachment_area">
			
  </div>
	<!-- <div class="row" style="margin-bottom:30px;">
		<div class="col-md-12">
			<a href="javascript:void(0)" class="btn btn-default" id="add_more_attachment">Add More</a>
			<input type="hidden" name="attachment_count" id="attachment_count" value="1">
		</div>
	</div>  -->

    </div>

    <input type= "submit" class = "btn btn-primary btn-lg"  value = "Save" /> 
  </section>
  {{ Form::close() }}
@endsection

@section('scripts')
    <script>
        //var ids = [];
        $(function(){
          const routePrefix = "{{ env('APP_URL', 'localhost/ecommerce/public') }}/laravel-filemanager";
           
          $('[class*="lfm"]').each(function() {
              $(this).filemanager('file', {prefix: routePrefix});
          }); 

          
           $('#attribute').on('change', function () {
                const value = $(this).val();
                const route = $(this).data('route');
                $.ajax({
                    url: route,
                    method: 'GET',
                    contentType: 'text/html',
                    data: { 
                        'id': value 
                    },
                    success: function(res) {
                        $('#attribute-values-wrapper').html(res);
                        $('#render-wrapper').append("<div id ='attribute_name_" + value +"' ></div>");
                    }
                });
           });

           $('#attribute-values-wrapper').on('click', '.attribute-value-button', function(){
              const attributeId = $('#attribute').val();
              const attributeName = $('#attribute option:selected').html();
              const attributeValueName = $(this).data('value-name');
              if(attributeId == undefined || attributeId == null || 
                  attributeName == undefined || attributeName == null || 
                  attributeValueName == undefined || attributeValueName == null) {
                return false;
              } 
              //ids = JSON.parse("{{ isset($ids) ? json_encode($ids) : json_encode([]) }}");

              let ids = [];
              const id = $(this).data('id');
              console.log(typeof(ids), ids);
              if(!ids.includes(id)) {
                  ids.push(id); 
                renderControls(id, attributeId, attributeName, attributeValueName);
                $(".attribute-value-button[data-id='"+ id +"']").attr('disabled', 'disabled');
              }
              
           });
        });


        function renderControls(id, attributeId, attributeName, attributeValueName) {
          const raw = "<div class = 'well'> <p style ='font-weight: bold; font-size: 16px; text-transform: capitalize; font-family: sans-serif;' >"+ attributeName +" - "+ attributeValueName +"</p> <div class='row'> <div class = 'col-md-6'> <label>Quantity</label> <input type = 'number' step='0.01' class = 'form-control' name = 'attribute_quantity[]' /> </div>  <div class = 'col-md-6'> <label>price</label><input type = 'number' step='0.01' class = 'form-control' name = 'attribute_price[]' /> <input type = 'hidden' class = 'form-control' name = 'attribute_value_id[]' value = "+ id +" /> </div>  </div>";
          $('#attribute_name_' + attributeId).append(raw);
        }


          $('#product-form').on('submit', function(e){
            e.preventDefault();
            let form = $(this).serialize();
            $.ajax({
              url: "{{ route('products.ajax.update') }}",
              data: {
                formdata : form, 
                _token: "{{ csrf_token() }}"
              },
              type: "POST",
              success: function (response) {
                if(response.status == 400) {
                  if(response.message.length > 0) {
                    let errors = "<ul class='alert alert-danger' style = 'list-style-type: none'>";
                    response.message.forEach(function(e){
                      errors+= "<li>" + e + "</li>";
                    });
                    errors+= "</ul>";

                    $('#errors-wrapper').html(errors);
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                  }
                } else if(response.status == 422) {
                  let error = "<ul class = 'alert alert-danger' style = 'list-style-type: none'><li>"+ response.message +"</li></ul>";
                  $('#errors-wrapper').html(error);
                  $("html, body").animate({ scrollTop: 0 }, "slow");
                } else if(response.status == 200) {
                  alert(response.message);
                  setTimeout(function() {
                    window.location.reload();
                  }, 2000);
                }
              }
          });
			
			
            
          }); // end of the jQuery
		  
		  $(document).ready(function() {

        
			  
				$('#add_more_attachment').on('click',function() {				
            count = Number($('#attachment_count').val());
            count++;								
          addMoreAttachment(count);
          $('#attachment_count').val(count);
			  })
		  })
		
		  function addMoreAttachment(id) {
				var nwrow='<div class="row"><div class="col-md-6" id="attachment_row_'+id+'"><div class="input-group"><span class="input-group-btn"><a data-input="thumbnail_'+id+'" data-preview="holder_'+ id +'" class="lfm btn btn-primary"><i class="fa fa-picture-o"></i>CHOOSE</a></span><input id="thumbnail_'+ id +'" class="form-control" type="text" name="image[]" readonly></div><img id="holder_'+ id +'" style="margin-top:15px;max-height:100px;"></div></div>';
				//var div = document.getElementById('product_attachment_area');
        //div.innerHTML += nwrow;
        $("#product_attachment_area").append(nwrow); 
		  }		 
      
      $('.remove').on('click', function(){
          const id = $(this).data('id');
          if(ids && ids.length > 0) {
            const index = ids.indexOf(id);
            if (index > -1) {
              ids.splice(index, 1);
              
            }

            $(this).parent('well').remove();
          }
      });
    </script>
 
     
@endsection