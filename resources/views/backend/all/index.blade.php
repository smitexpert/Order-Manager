@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Find Order</h1>
		</div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Find Order
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Product</th>
                                <th>Courier</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th>{{ $order->order_id }}</th>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_mobile }}</td>
                                    <td>{{ $order->customer_address }}</td>
                                    <td>{{ $order->product_name }}</td>
                                    <td>{{ $order->courier_id }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
                                            <a href="#" onclick="event.preventDefault(); return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $(".table").DataTable();
        })
    </script>
@endpush