@extends('layouts.frontlayout.fullwidth')

@section('content')
  <div class="container">
      <h3>My Orders</h3>

      <table class="table table-bordered">
          <tr>
              <th>Order Number</th>
              <th>Order Date</th>
              <th>Amount</th>
              <th>Status</th>
          </tr>
          @if($orders->count())
            @foreach($orders as $order)
                <tr  style="background: #ededed">
                    <td>{{ $order->order_no }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
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
                </tr>
                <tr >
                    <td colspan="4" style = "background-color: #ededed;">
                    <table class="table table-condensed table-stripped">
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
                <td  colspan="4" class="text-center"> No item found</td>
            </tr>
          @endif
      </table>

      
  </div>
@endsection