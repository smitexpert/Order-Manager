@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Image Frame</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Select Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Old Price</label>
                            <input type="text" name="old" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Select Shop</label>
                            <select name="shop" id="" class="form-control" required>
                                <option value=""></option>
                                <option value="shobi">SHOBI.COM.BD</option>
                                <option value="baby">babyNYouth</option>
                                <option value="bd">BDWHOLESALE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-success">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>