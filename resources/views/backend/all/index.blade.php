@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Find Order</h1>
		</div>
    </div><!--/.row-->
    <div class="row">
        <div class="float-right">
            <div class="col-md-3">
                <form action="" method="POST">
                    @csrf
                    <label for="">Created Date</label>
                    <div class="input-group">
                        <input type="date" name="created" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-info">GO</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Find Order
                </div>
                <div class="panel-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>Product</th>
                                <th>Courier</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>D.D</th>
                                <th style="min-width: 120px">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th>{{ $order->order_id }}</th>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->customer_mobile }}</td>
                                    <td>{{ $order->customer_address }}</td>
                                    {{-- <td>{{ $order->district }}</td> --}}
                                    <td>
                                        @foreach ($order->district as $item)
                                            {{ $item->name }}
                                        @endforeach
                                    </td>
                                    <td>{{ $order->product_name }}</td>
                                    <td>{{ $order->courier->name }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($order->delivery_date)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button id="order_{{ $order->id }}" class="btn btn-sm btn-info showOrderModal"><i class="fa fa-eye"></i></button>
                                            <a href="{{ route('all.delete', $order->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<!-- Modal -->
<div id="orderModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Order Details</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <table class="table">
                      <tr>
                          <th>Order ID</th>
                          <th>Customer Name</th>
                          <th>Number</th>
                          <th>Address</th>
                      </tr>
                      <tr>
                          <th id="order_id"></th>
                          <td id="customer_name"></td>
                          <td id="customer_mobile"></td>
                          <td id="customer_address"></td>
                      </tr>
                  </table>
                  <p>Product Info</p>
                  <table class="table">
                      <tr>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Shipping Charge</th>
                          <th>Discount</th>
                          <th>Total</th>
                      </tr>
                      <tr>
                          <th id="product_name"></th>
                          <td id="product_price"></td>
                          <td id="product_quantity"></td>
                          <td id="shipping_charge"></td>
                          <td id="discount"></td>
                          <td id="total_charge"></td>
                      </tr>
                  </table>
                  <p>Shipping Info</p>
                  <table class="table">
                      <tr>
                          <th>Shop Name</th>
                          <th>Courier Name</th>
                          <th>Delivery Date</th>
                      </tr>
                      <tr>
                          <td id="shop_name"></td>
                          <td id="courier_name"></td>
                          <th id="delivery_date"></th>
                      </tr>
                  </table>
                  <p>Action</p>
                  <input type="hidden" name="update_status_id" id="update_status_id">
                  <div class="row">
                      <form action="#" id="up_status_form">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <select name="status" id="up_status" class="form-control">
                                      <option value="">--</option>
                                      <option value="pending">Pending</option>
                                      <option value="shipped">Shipped</option>
                                      <option value="cancelled">Cancelled</option>
                                      <option value="returned">Returned</option>
                                      <option value="delivered">Delivered</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" id="status_update_btn">Update</button>
                            </div>
                        </form>
                  </div>
                  <div class="row">
                      <form action="" id="add_remarks_form">
                          <div class="col-md-12">
                            <label for="">Remarks</label>
                          </div>
                            <div class="col-md-10">
                                <input type="text" name="remark" id="remark" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" id="remark_add_btn">Add</button>
                            </div>
                      </form>
                  </div>
                  <br>
                  <p>Remarks</p>
                  <table class="table" id="remark_table">
                  </table>
                  <div class="row">
                      <form action="" id="payment_add_form">
                          <div class="col-md-12">
                              <p>Payment</p>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">Method</label>
                                  {{-- <input type="text" name="method" id="method" class="form-control" required> --}}
                                  <select name="method" id="method" class="form-control" required>
                                      <option value="bKash">bKash</option>
                                      <option value="cash">Cash</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">Amount</label>
                                  <input type="text" name="amount" id="amount" class="form-control" required>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="">Remind Code</label>
                                  <input type="text" name="remindCode" id="remindCode" class="form-control" required>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <br>
                              <button class="btn btn-success">Add Payment</button>
                          </div>
                      </form>
                      <br>
                      <div class="col-md-12">
                        <p>Payment Table</p>
                      </div>
                      <div class="col-md-12">
                        <table class="table" id="payment_table">
                          
                        </table>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){

            $("#payment_add_form").submit(function(e){
                e.preventDefault();
                var id = $("#update_status_id").val();
                var method = $("#method").val();
                var amount = $("#amount").val();
                var remindCode = $("#remindCode").val();

                var table = '<tr><td>'+method+'</td><td>'+amount+'</td><td>'+remindCode+'</td></tr>'

                $.ajax({
                    url: "{{ url('/') }}/all/"+id+"/"+method+"/"+amount+"/"+remindCode+"/payment",
                    method: 'get',
                    success: function(data){
                        $("#amount").val('');
                        $("#remindCode").val('');
                        if(data == 'OK'){
                            alert('Payment Added successfully!');
                            $("#payment_table").append(table);
                        }else{
                            alert('Something Wrong!');
                        }
                    }
                });

            })

            $("#add_remarks_form").submit(function(e){
                e.preventDefault();
                var id = $("#update_status_id").val();
                var remark = $("#remark").val();
                var table = '<tr><td>'+remark+'</td></tr>'
                if(remark != ""){
                    $.ajax({
                        url: "{{ url('/') }}/all/"+id+"/"+remark+"/remark",
                        method: 'get',
                        success: function(data){
                            $("#remark").val("");
                            if(data == "OK"){
                                alert('Remark Added Successfully!');
                                $("#remark_table").append(table);
                            }else{
                                alert('Something Wrong@');
                                console.log(data);
                            }

                        }
                    });
                }
            });



            $("#up_status_form").submit(function(e){
                e.preventDefault();
                $("#status_update_btn").hide();
                var status = $("#up_status").val();
                var id = $("#update_status_id").val();
                if(status != ""){
                    $.ajax({
                        url: "{{ url('/') }}/all/"+id+"/"+status+"/status",
                        method: 'get',
                        success: function(data){
                            if(data == "OK"){
                                alert("Status Update");
                                $("#orderModal").modal('hide');
                            }else{
                                alert("Something is wrong!");
                                $("#orderModal").modal('hide');
                            }
                            $("#status_update_btn").show();
                        }
                    });
                }
            })

            $("#table").DataTable();
            $("#table").on("click", ".showOrderModal", function(){
                var id = $(this).attr('id');
                // console.log(id);
                id = id.replace('order_', '');

                $.ajax({
                    method: 'get',
                    url: "{{ url('/') }}/all/"+id+"/remark",
                    success: function(data){
                        $("#remark_table").find('*').remove();
                        $("#remark_table").append(data);
                    }
                });
                
                $.ajax({
                    method: 'get',
                    url: "{{ url('/') }}/all/"+id+"/payments",
                    success: function(data){
                        $("#payment_table").find('*').remove();
                        $("#payment_table").append(data);
                        // console.log(data);
                    }
                });

                
                $.ajax({
                    method: 'get',
                    url: "{{ url('/') }}/all/"+id+"/get",
                    dataType: 'json',
                    success: function(data){
                        $("#order_id").text(data.order_id);
                        $("#update_status_id").val(data.id);
                        $("#customer_name").text(data.customer_name);
                        $("#customer_mobile").text(data.customer_mobile);
                        $("#customer_address").text(data.customer_address);
                        $("#product_name").text(data.product_name);
                        $("#product_price").text(data.product_price);
                        $("#product_quantity").text(data.product_quantity);
                        $("#shipping_charge").text(data.shipping_charge);
                        $("#discount").text(data.discount);
                        $("#total_charge").text(data.total_charge);
                        $("#shop_name").text(data.shop.name);
                        $("#courier_name").text(data.courier.name);
                        $("#delivery_date").text(data.delivery_date);
                        $("#up_status").val(data.status);
                        // console.log(data);
                        $("#orderModal").modal('show');
                    }
                });

            })
        })
    </script>
@endpush