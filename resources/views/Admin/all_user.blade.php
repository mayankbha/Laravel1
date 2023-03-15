
@extends('adminlte::page')


@section('title','All Users')

@section('content')

    @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
    @endif

    @if(session()->has('error'))
      <div class="alert alert-danger">
          {{ session()->get('error') }}
      </div>
    @endif    

     <form class="navbar-form navbar-right" method="post" action="{{ url('/admin/admin_dashboard/search_user') }}">
         {{ csrf_field() }}
        <div class="form-group">
            <input type="text" name="search_user" class="form-control" placeholder="Search User">
            <button class="btn btn-secondary" type="submit">Search</button>
        </div>

    </form>



    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sr.No</th>
            <th>User Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>View Profile</th>
            <th>Add Profit</th>
            <th>Total Funds</th>
            <th>Action</th>

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
              <td><a class="c-btn c-btn--info" onclick="ProfitModal('{{ $da->id }}')">Add Profit</a></td>
              <td>
                 {{ $da->user_funds }}
              </td>
            <td>
                 <a class="btn btn-primary" href="{{ url('/admin/admin_dashboard/add_funds',$da->id) }}"> Add Funds</a>
              </td>
        </tr>
        @endforeach
        </tbody>


    </table>
    {{ $data->links() }}


    <div id="addProfit" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Funds</h4>
          </div>
          <div class="modal-body">
            <form method="post" name="frm-deposit" action="{{route('add_deposit_profit')}}">
              {{ csrf_field() }}
              <input type="hidden" id="user_id" name="user_id">
              <div class="form-group">
                <h4>Month</h4>
                <select name="month" class="form-control">
                    <?php
                    for ($i = 0; $i < 12; $i++) {
                        $time = strtotime(sprintf('%d months', $i));   
                        $label = date('F', $time);   
                        $value = date('n', $time);
                        echo "<option value='$value'>$label</option>";
                    }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <h4>Year</h4>
                <select name="year" class="form-control">
                    <?php
                    for ($i = -1; $i < 9; $i++) {
                        $year = date('Y') + $i;
                        if($i == 0){
                          echo "<option selected='selected' value='$year'>$year</option>";
                        }else{
                          echo "<option value='$year'>$year</option>";
                      }
                    }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <h4>Enter the amount</h4>
                <input type="number" min=0 name="amount" class="form-control" id="amount">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function ProfitModal(userID)
      {
        $('#user_id').val(userID);
        $('#addProfit').modal('show');
      }
    </script>
@endsection