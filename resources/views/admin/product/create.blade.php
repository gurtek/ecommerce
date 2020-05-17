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
    {{ Form::open(['url' => route('categories.store'), 'method'=>'post' , 'id' => 'product-form' ]) }}  

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
              
      </div>
      <div class="form-group">
              {{ Form::label('product_description') }}
              {{ Form::textarea('product_description', null, ['class' => 'form-control']) }}
              
      </div>

      <div class="form-group">
              {{ Form::label('price') }}
              {{ Form::number('price', null, ['class' => 'form-control']) }}
              
      </div>

      <div class="form-group">
              {{ Form::label('quantity') }}
              {{ Form::number('quantity', null, ['class' => 'form-control']) }}
              
      </div>

    <div class="form-group">
            {{ Form::label('categories') }}
            {{ Form::select('categories[]', $categories, null, ['multiple' => 'multiple', 'class' => 'form-control']) }}
            
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
                  
                  </div>
            </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">

    <div class="row" id="attachment_row1">
		<div class="col-md-6" >
		  <div class="input-group">
			<span class="input-group-btn">
			  <a data-input="thumbnail" data-preview="holder" class="lfm btn btn-primary">
				<i class="fa fa-picture-o"></i> CHOOSE
			  </a>
			</span>
			<input id="thumbnail" class="form-control" type="text" name="image[]" readonly>
		  </div>
		  <img id="holder" style="margin-top:15px;max-height:100px;">
		</div>
		
	</div>
	<div id="product_attachment_area">
			
		</div>
	<div class="row" style="margin-bottom:30px;">
		<div class="col-md-12">
			<a href="javascript:void(0)" class="btn btn-default" id="add_more_attachment">Add More</a>
			<input type="hidden" name="attachment_count" id="attachment_count" value="1">
		</div>
	</div>
	
	


    </div>

    <input type= "submit" class = "btn btn-primary btn-lg"  value = "Save" /> 
  </section>
  {{ Form::close() }}
@endsection

@section('scripts')
    <script>
        $(function(){
          const routePrefix = "{{ env('APP_URL', 'localhost/ecommerce/public') }}/laravel-filemanager";
           
          $('[class*="lfm"]').each(function() {
              $(this).filemanager('file', {prefix: routePrefix});
          }); 
          let ids = [];
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
              
              const id = $(this).data('id');
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
              url: "{{ route('products.store') }}",
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
				var nwrow='<div class="row"><div class="col-md-6" id="attachment_row'+id+'"><div class="input-group"><span class="input-group-btn"><a data-input="thumbnail2" data-preview="holder2" class="lfm btn btn-primary"><i class="fa fa-picture-o"></i>CHOOSE</a></span><input id="thumbnail2" class="form-control" type="text" name="image[]" readonly></div><img id="holder2" style="margin-top:15px;max-height:100px;"></div></div>';
				var div = document.getElementById('product_attachment_area');
				div.innerHTML += nwrow;
		  }		//$("#product_attachment_area").append(nwrow);  
        
    </script>
 
     
@endsection