@extends('layouts.adminlayout.dashboard')

@section('content')
<div class="container">
    <h3> All Customer Orders </h3>

    <table class="table table-bordered">
          <tr>
              <th>Order Number</th>
              <th>Order Date</th>
              <th>Customer</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          @if($orders->count())
            @foreach($orders as $order)
                <tr  style="background: #ededed">
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ '$'. $order->total_amount }}</td>
                    <td>
                        
                        @if($order->status == 'P')
                            Pending
                        @elseif($order->status == 'DIS')
                            Dispatched
                        @elseif($order->status == 'S')
                            Shipped
                        @elseif($order->status == 'D')
                            Delivered
                        @endif
                    </td>
                    <td width = "10%" class="text-center">
                        {{ Form::select('status-options', ['P' => 'Pending', 'DIS' => 'Dispatched', 'S' => 'Shipped', 'D' => 'Delivered'], $order->status, ['class' => 'status-options', 'data-id' => $order->id ]) }}
                    </td>
                </tr>
                <tr >
                    <td colspan="6" style = "background-color: #ededed">
                    <table  class="table table-condensed table-stripped">
                            <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                        @foreach($order->orderItems as $item)
                        @php
                            $options = null;
                            if($item->attributes != null) {
                                $options = unserialize($item->attributes);
                            }
                        @endphp
                            <tr>
                                <td>
                                    {{ $item->product->product_name }}
                                    <br />
                                    @if($options)
                                            @foreach($options as $option)
                                                <div style = "font-weight: bold;">
                                                    {{ $option['attribute_name'] . '-' . $option['attribute_value'] }}
                                                </div>
                                            @endforeach
                                        @endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ '$ ' . $item->product_price }}</td>
                                <td>{{ '$ ' . $item->total_price }}</td>
                            </tr>
                        @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
            @else
            <tr>
                <td  colspan="6" class="text-center"> No item found</td>
            </tr>
          @endif
      </table>

      @if($orders->count())
        {{ $orders->links() }}
      @endif
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
           $('.status-options').on('change', function(){
            const status = $(this).val();
            const orderId = $(this).data('id');

           if(status == '' || orderId == '') {
            return false;
           } 

           if(confirm('are you sure to change the status of the order?')) {
             $.ajax({
                 url: "{{ route('change.status') }}",
                 method: 'POST',
                 data: {
                     _token: "{{ csrf_token() }}",
                     order_id: orderId,
                     status: status
                 },
                 success: function(response) {
                    if(response.status == 200) {
                        alert(response.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 100);
                    }
                 }
             });
           }
             
           });
        });
    </script>
@endsection