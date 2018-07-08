@extends('backend.layouts.master')

@section('title', 'View Order')

@section('content')
    <div class="container-fluid">
    	<div class="col-md-12">
            <div class="card card-plain">
                <div class="header">
                    <div class="col-md-6">
                        <h4 class="title">View Order</h4>
                        <p class="order">Order By {{ $order->user->name }}</p>
                    </div>

                    <div class="col-md-6 text-right">
                        
                        
                            <button class="btn btn-primary" type="button" id="btn-update">Update Status and Apply Recipt Number</button>

                            <a href="{{ route('admin.order.index') }}" class="btn btn-success">Back</a>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <table class="table table-primary table-custom">
                            <thead>
                                <tr class="alert-success">
                                    <td colspan="2">Order Details</td>
                                    <td colspan="2">Customer Information</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Number</strong></td>
                                    <td>{{ $order->number }}</td>

                                    <td><strong>Full Name</strong></td>
                                    <td>{{ $order->fullname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Method</strong></td>
                                    <td>{{ $order->payment_type }}</td>

                                    <td><strong>Phone Number</strong></td>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Transaction Date</strong></td>
                                    <td>{{ Carbon\Carbon::parse($order->transaction_date)->format('F jS, Y h:i A') }}</td>

                                    <td><strong>Email</strong></td>
                                    <td>{{ $order->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        <label class="label label-{{ $order->status_transaction['label'] }}" style="color:#fff">
                                        {{ $order->status_transaction['status'] }}</label>
                                    </td>

                                    <td rowspan="4"><strong>Address</strong></td>
                                    <td rowspan="4">
                                        {!! nl2br($order->address) !!}, {{ $order->zip }}
                                        <br>
                                        {{ RajaOngkir::getProvinceAttr($order->ship->province_id) }}
                                        <br>
                                        {{ RajaOngkir::getCityAttr($order->ship->city_id, $order->ship->province_id) }}
                                    </td>
                                </tr>

                                <tr>
                                    <td rowspan="3"><strong>Coupon Code</strong></td>
                                    <td rowspan="3"><span class="label label-primary">{{ $order->coupon_code }}</span></td>
                                </tr>

                            </thead>
                        </table>
                    </div>

                    <div class="col-md-12">
                        
                        <table class="table table-primary table-custom">
                            <thead>
                                <tr class="alert-info">
                                    <td colspan="4">Shipping Info #{{ $order->ship->receipt_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping To</strong></td>
                                    <td>{{ $order->ship->first_name.' '.$order->ship->last_name }}</td>
                                    <td><strong>Shipping Phone Number</strong></td>
                                    <td>
                                        {{ $order->ship->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Shipping Address</strong></td>
                                    <td>
                                        {!! nl2br($order->ship->address) !!}
                                        <br>
                                        {{ RajaOngkir::getCityAttr($order->ship->city_id, $order->ship->province_id) }}
                                        <br>
                                        {{ RajaOngkir::getProvinceAttr($order->ship->province_id) }}
                                        <br>
                                    </td>
                                    <td><strong>Courier Details</strong></td>
                                    <td>
                                        {{ strtoupper($order->ship->courier_id) }}
                                        <br>
                                        {{ $order->ship->service_name }} ({{ $order->ship->service_description }})
                                        <br>
                                        {{ $order->ship->estimate_delivery }} (Days)
                                    </td>
                                </tr>
                            </thead>
                        </table>
                            
                    </div>

                    <div class="col-md-12">
                        <h3 class="heading">Transaction Details</h3>
                        <table class="table table-primary table-bordered">
                            <thead class="alert-info">
                                <tr>
                                    <th>Product Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $data_details)
                                <tr>
                                    <td>{{ $data_details->product->name }}</td>
                                    <td class="text-right">{{ Helper::currency($data_details->price) }}</td>
                                    <td class="text-center">{{ $data_details->qty }}</td>
                                    <td class="text-right">{{ Helper::currency($data_details->price * $data_details->qty) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Sub Total</th>
                                    <th class="text-right">{{ Helper::currency($order->subtotal) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Tax</th>
                                    <th class="text-right">{{ Helper::currency($order->tax) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Discount</th>
                                    <th class="text-right">({{ Helper::currency($order->discount) }})</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Shipping Fee</th>
                                    <th class="text-right">{{ Helper::currency($order->ship->cost) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th class="text-right">
                                        {{-- Helper::currency($order->total) --}}
                                        {{ Helper::currency(($order->subtotal + $order->tax + $order->ship->cost ) - $order->discount ) }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

<form action="{{ route('admin.order.update', $order->id) }}" method="post">

    @csrf
    @method('PUT')

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-update">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Update Status</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Receipt Number</label>
                        <input type="text" name="receipt_number" class="form-control" placeholder="Receipt Number">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select name="status" class="select2" data-placeholder="Select Status" style="width: 100%">
                            <option value="0" {{ $order->status == '0' ? 'selected=selected' : '' }}>PROCESSING</option>
                            <option value="1" {{ $order->status == '1' ? 'selected=selected' : '' }}>COMPLETE</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>

@push('js')
<script src="{{ url('backend/js/pages/order-show.js') }}"></script>
@endpush