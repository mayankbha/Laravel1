
@extends('adminlte::page')


@section('title','All Users')

@section('content')
    <div class="title"><h3>Withdrawal History</h3></div>
    @if( Session::has( 'success' ))
         {{ Session::get( 'success' ) }}
    @elseif( Session::has( 'error' ))
         {{ Session::get( 'error' ) }} <!-- here to 'withWarning()' -->
    @endif
    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
              <th>Sr.No</th>
              <th>User Id</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach( $history as $info)
          <tr>
              <td>  {{ $info->id}}</td>
              <td>  {{ $info->user_id }}</td>
              <td>  {{ $info->name }} </td>
              <td>  -{{ $info->amount }}</td>
              <td>  {{ $info->status }} </td>
              <td>  {{ $info->created_at }}</td>

              <td>
                  @if ($info->status !='Approved' || $info->status =='')
                    <form action="{{url('admin/admin_dashboard/approve/'.$info->id)}}" action="POST" name="frm-approve">
                      <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    @if ($info->status !='Cancled')
                    <form action="{{url('admin/admin_dashboard/disapprove/'.$info->id)}}" action="POST" name="frm-approve">
                      <button type="submit" class="btn btn-danger">Cancle</button>
                    </form>
                    @endif
                  @endif
              </td>

          </tr>
        @endforeach
        </tbody>
    </table>

@endsection
