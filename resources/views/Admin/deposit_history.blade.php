
@extends('adminlte::page')


@section('title','All Users')

@section('content')

    <div class="title"><h3>Deposit History</h3></div>
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sr.No</th>
            <th>User Id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $history as $info)
          <tr>
                <td>  {{ $info->id}}</td>
                <td>  {{ $info->user_id }}</td>
                <td>  {{ $info->name }} </td>
                <td>  {{ $info->amount }}</td>
                <td>  {{ $info->created_at }}</td>
          </tr>
        @endforeach
        </tbody>
    </table>

@endsection
