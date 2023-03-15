@extends('adminlte::page')

@section('title','User Profile')

@section('content')


    <center><h3> Add Funds to User {{ $profile->name }}</h3></center>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <form class="form-group" method="POST" action="{{ url('admin/admin_dashboard/add_funds_user') }}">
                    {{ csrf_field() }}
                    <h3>Add funds</h3>
                    <label>Enter Amount </label>
                    <input type="hidden" name="userid" value="{{$profile->id }}">
                    <input class="form-control" type="number" name="addamount" value="" required>
                    <br>
                    <div class="row">
                        <div class="col-md-10">
                            <button class="btn btn-primary" type="submit">Add Funds</button>
                            <a href="{{url('admin/admin_dashboard/all_users')}}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
