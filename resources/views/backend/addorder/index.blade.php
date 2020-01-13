@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Order</h1>
		</div>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <div class="alert-title">Success</div>
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <form class="form-horizontal row-border" method="POST" action="{{ route('add.store') }}">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Add Customer Info</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Select Shop</label>
                            <div class="col-md-10">
                                <select class="form-control" name="shop" id="shop" value="{{ old('shop') }}" required>
                                    <option value="">Select</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}" @if(Session::has('shop'))
                                            @if(Session::get('shop') == $shop->id)
                                                selected
                                            @endif
                                            @endif>{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Customer Name</label>
                            <div class="col-md-10">
                                <input type="text" name="customerName" value="{{ old('customerName') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Customer Mobile</label>
                            <div class="col-md-10">
                                <input type="text" name="customerMobile" value="{{ old('customerMobile') }}" class="form-control" pattern="[0-9]{11}" minlength="11" maxlength="11" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Customer Address</label>
                            <div class="col-md-10">
                                <input type="text" name="customerAddress" value="{{ old('customerAddress') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Customer District</label>
                            <div class="col-md-10">
                                <select name="customerDistrict" id="customerDistrict" class="form-control"  data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->name }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Select Courier</label>
                            <div class="col-md-10">
                                <select class="form-control" id="courier" name="courier" value="{{ old('courier') }}" required>
                                    <option value="">Select</option>
                                    @foreach ($couriers as $courier)
                                        <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">Add Product Info</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12">Product Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="productName" value="{{ old('productName') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12">Product Price</label>
                                    <div class="col-md-12">
                                        <input type="text" onkeyup="getTotal()" id="productPrice" name="productPrice" value="{{ old('productPrice') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-12">Product Quantity</label>
                                    <div class="col-md-12">
                                        <input type="number" min="1" onkeyup="getTotal()" id="productQuantity" name="productQuantity" value="{{ old('productQuantity') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12">Shipping Charge</label>
                                    <div class="col-md-12">
                                        <input type="text" onkeyup="getTotal()" id="shippingCharge" name="shippingCharge" value="{{ old('shippingCharge') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12">Discount</label>
                                    <div class="col-md-12">
                                        <input type="text" onkeyup="getTotal()" id="discount" name="discount" value="{{ old('discount') }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12">Total Charge</label>
                                    <div class="col-md-12">
                                        <input type="text" id="totalCharge" name="totalCharge" value="{{ old('totalCharge') }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12">Delivery Date</label>
                                    <div class="col-md-12">
                                        <input type="date" name="deliveryDate" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-success">Add Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            $('#customerDistrict').selectpicker();

            if($('#productPrice').val() == ''){
                $('#productPrice').val(0);
            }
            if($('#productQuantity').val() == ''){
                $('#productQuantity').val(1);
            }
            if($('#shippingCharge').val() == ''){
                $('#shippingCharge').val(0);
            }
            if($('#discount').val() == ''){
                $('#discount').val(0);
            }
            if($('#totalCharge').val() == ''){
                $('#totalCharge').val(0);
            }

            $("#courier").change(function(){
                var id = $(this).val();
                if(id != ""){
                    $.ajax({
                        url: "{{ url('/') }}/add/"+id+"/charge",
                        method: 'get',
                        success: function(data){
                            $("#shippingCharge").val(data.charge);
                            getTotal();
                        }
                    });
                }
            });
            
        })

        function getTotal(){
            var productPrice = $('#productPrice').val();
            var productQuantity = $('#productQuantity').val();
            var shippingCharge = $('#shippingCharge').val();
            var discount = $('#discount').val();
            // var total = ((productPrice*productQuantity)+shippingCharge)-discount;
            var total = ((parseFloat(productPrice)*parseInt(productQuantity))+parseInt(shippingCharge))-parseInt(discount);
            $("#totalCharge").val(total);
        }

    </script>
@endpush