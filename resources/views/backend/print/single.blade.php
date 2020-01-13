<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ url('') }}/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
        background: rgb(204,204,204); 
        }
        page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        page[size="A4"] {  
        width: 21cm;
        height: 29.7cm; 
        }
        page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        height: 21cm;  
        }
        page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
        }
        page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;  
        }
        page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
        }
        page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;  
        }
        @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }
        }

        .invoice {
            width: 49%;
            border: 1px solid #000;
            display: inline-block;
            height: 98%;
            padding: 20px;
        }

        .invoice .shop-img {
            padding: 10px;
        }

        .invoice .shop-img img{
            width: 120px;
            height: auto;
        }

        .invoice .table {
            padding: 20px;
        }

        .product_info {
            background-color: #f9f9f9;
        }

        .invoice .section {
            background-color: #f9f9f9;
            text-align: center;
        }

        .invoice .section p {
            margin: 0;
            padding: 5px 0;
        }

        .bill-add p {
            margin: 0;
        }

        .table td {
            border: 1px solid #f9f9f9;
        }
    </style>
</head>
<body>
    <page size="A4" layout='landscape'>
        <div class="invoice">
            <div class="row">
                <div class="col-md-6">
                    <div class="shop-img">
                        <img src="{{ url('/') }}/storage/{{ $order->shop->shop_logo }}" alt="">
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <hr>
            <div class="section">
                <p>Purchase Summary</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Billing Address</h4>
                    <div class="bill-add">
                        <p>{{ $order->customer_address }}</p>
                        @foreach ($order->district as $item)
                            <p>{{ $item->name }}</p>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bill-add">
                        <p><b>Order Number: </b>{{ $order->order_id }}</p>
                        <p><b>Order Date: </b>{{ $order->created_at }}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr class="product_info">
                            <th>Item</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>{{ $order->product_name }}</td>
                            <td></td>
                            <td>{{ $order->product_quantity }}</td>
                            <td>{{ $order->product_price }}</td>
                            <td>{{ $order->product_price * $order->product_quantity }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="section">
                        <p>Courier Service</p>
                    </div>
                    <p style="margin: 10px 0;"><b>{{ $order->courier->name }}</b></p>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <table class="table">
                            <tr>
                                <td>SUBTOTAL</td>
                                <td style="text-align: right">{{ $order->product_price * $order->product_quantity }}/-</td>
                            </tr>
                            <tr>
                                <td>DISCOUNT</td>
                                <td style="text-align: right">{{ $order->discount }}/-</td>
                            </tr>
                            <tr>
                                <td>SHIPPING CHARGE</td>
                                <td style="text-align: right">{{ $order->shipping_charge }}/-</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Total</td>
                                <td style="text-align: right; font-weight: bold">{{ $order->total_charge }}/-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </page>
</body>
</html>