@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Shop Manager</h1>
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
    
    <form class="form-horizontal row-border" method="POST" action="{{ route('shop.store') }}">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Add Shop Info</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @error('shopName') has-error @enderror">
                                    <label class="col-md-12">Shop Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="shopName" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="col-md-12">Shop Contact No.</label>
                                    <div class="col-md-12">
                                        <input type="text" name="shopContact" pattern="[0-9]{11}" minlength="11" maxlength="11" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button class="btn btn-success btn-lg">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Shop List</div>
                <div class="panel-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Shop Contact</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)  
                                <tr>
                                    <td>{{ $shop->name }}</td>
                                    <td>{{ $shop->shop_contact }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-primary shop-update-modal" id="shop_{{ $shop->id }}"><i class="fa fa-cog"></i></a>
                                            <a onclick="return confirm('Are You Sure?');" href="{{ route('shop.delete', $shop->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        @if ($shop->shop_logo != NULL)
                                            <img style="width: 90px; height: auto;" src="{{ url('/') }}{{ $shop->shop_logo }}" alt="">
                                        @endif
                                        <div class="pull-right">
                                            <form action="{{ route('shop.upload', $shop->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="file" name="shopLogo" class="form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success">Upload</button>
                                                    </div>
                                                </div>
                                            </form>
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

<div id="shopModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Shop Details</h4>
        </div>
        <div class="modal-body">
            <form action="" id="shop-update-form">
                @csrf
                <input type="hidden" name="shopId" id="shopId">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Shop Name</label>
                            <input type="text" name="shopName" id="shopName" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Shop Contact</label>
                            <input type="text" name="shopContact" id="shopContact" pattern="[0-9]{11}" minlength="11" maxlength="11" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-success btn-block">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
     </div>
 </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $("#table").DataTable();
        });

        // $(".shop-edit").click(function(e){
        //     e.preventDefault();
        //     $("#shopModal").modal('toggle');
        // })

        $("#table").on('click', '.shop-update-modal', function(e){
            e.preventDefault();
            var id = $(this).attr('id');
            id = id.replace('shop_', '');
            
            $.ajax({
                url: "{{ url('/shop') }}/"+id+"/get",
                method: 'get',
                dataType: 'json',
                success: function(data){
                    $("#shopId").val(data.id);
                    $("#shopName").val(data.name);
                    $("#shopContact").val(data.shop_contact);
                    $("#shopModal").modal('toggle');
                }
            });
        })

        $("#shop-update-form").submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: "{{ route('shop.update') }}",
                method: 'POST',
                data: data,
                success: function(data){
                    if(data == 'OK'){
                        alert('Success!');               
                        location.reload();
                    }else{
                        alert("Something is Wrong@");
                        location.reload();
                    }
                }
            })
        })
    </script>
@endpush