@extends('adminlte::page')

@section('title','Search Users')

@section('content')

   <center> <h3> Search Users</h3> </center>

    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sr.No</th>
            <th>User Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>View Profile</th>

        </tr>
        </thead>
        <tbody>
        @foreach( $data as $da)
            <tr>
                <td>  {{  $number++}}</td>
                <td>  {{ $da->id }}</td>
                <td>  {{ $da->name }} </td>
                <td>  {{ $da->email }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('/admin/admin_dashboard/user_profile',$da->id) }}"> View Profile</a>

                </td>
            </tr>
        @endforeach
        </tbody>


    </table>
    {{ $data->links() }}

@endsection