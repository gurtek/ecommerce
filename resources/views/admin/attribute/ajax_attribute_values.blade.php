@if(count($values) > 0)
    
        @foreach($values as $key => $value)
        <div class="row" style = 'margin-bottom:5px;'>
            <div class="col-md-8">
                {{ $value }}
            </div>
            <div class="col-md-4">
                <a href = "javascript:void(0)" data-id="{{ $key }}" 
                data-value-name = "{{ $value }}"
                class="attribute-value-button btn btn-sm btn-primary"><i class="fa fa-plus"></i></a>
            </div> 
        </div>   
        @endforeach
    
@endif