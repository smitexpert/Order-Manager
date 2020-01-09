@extends('backend.layouts.app')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Courier Services</h1>
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
    
    <form class="form-horizontal row-border" method="POST" action="{{ route('courier.store') }}">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Add Courier Info</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @error('courierName') has-error @enderror">
                                    <label class="col-md-12">Courier Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="courierName" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group @error('courierCharge') has-error @enderror">
                                    <label class="col-md-12">Charge</label>
                                    <div class="col-md-12">
                                        <input type="text" name="courierCharge" class="form-control" required>
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
                <div class="panel-heading clearfix">Courier List</div>
                <div class="panel-body">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Charge</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($couriers as $courier)  
                                <tr>
                                    <td>{{ $courier->name }}</td>
                                    <td>{{ $courier->charge }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i></a>
                                            <a onclick="return confirm('Are You Sure?');" href="{{ route('courier.delete', $courier->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
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
            $("#table").DataTable();
        });
    </script>
@endpush