@extends('adminlte::page')

@section('title','User Profile')

@section('content')

  @if(Session::has('success'))
      <p class="alert {{ Session::get('alert-class', 'alert alert-success') }}">{{ Session::get('success') }}</p>
  @endif
        <center><h3> User Profile View</h3></center>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <form class="form-group" method="POST" action="{{ url('admin/admin_dashboard/update_profile', $profile->id) }}">
                        {{ csrf_field() }}
                        <h3>Basic Information</h3>
                        <label>Username</label>
                        <input class="form-control" name="name" value=" {{ $profile->name }}">

                        <label>Role</label>
                        <input class="form-control" name="role_name" value=" {{ $profile->role_name }}">

                        <lable>Email</lable>
                        <input class="form-control" name="email" value="{{ $profile->email }}">

                        <lable>Mobile Number</lable>
                        <input class="form-control" name="mobile" value="{{ $profile->mobile }}">

                        <lable>Gender</lable>
                        <input class="form-control" name="gender" value="{{ $profile->gender }}">

                        <hr>
                        <h3>Address</h3>
                        <lable>Address 1</lable>
                        <input class="form-control" name="address_1" value="{{ $profile->address_1 }}">

                        <lable>Address 2</lable>
                        <input class="form-control" name="address_2" value="{{ $profile->address_2 }}">

                        <lable>City</lable>
                        <input class="form-control" name="city" value="{{ $profile->city }}">

                        <lable>State</lable>
                        <input class="form-control" name="state" value="{{ $profile->state }}">

                        <lable>Country</lable>
                        <input class="form-control" name="country" value="{{ $profile->country }}">


                        <hr>
                        <h3>All links</h3>

                        <lable>Twitter Link</lable>
                        <input class="form-control" name="twitter_link" value="{{ $profile->twitter_link }}">

                        <lable>Facebook Link</lable>
                        <input class="form-control" name="facebook_link" value="{{ $profile->facebook_link }}">
                         <br>
                        <div class="row">
                            <div class="col-md-10">
                                <button class="btn btn-primary" type="submit">Update Info</button>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-danger" href="{{ url('admin/admin_dashboard/delete_profile', $profile->id) }}">Delete User</a>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-4">


                   <div>
                     <center> <img src="{{ '/images/default.png' }}"> </center>
                   </div>
                    <center><label>Avatar</label></center>
                   <hr>
                        <center>
                          <a class="btn btn-primary" href="{{ url('admin/admin_dashboard/user_financial_details',$profile->id) }}">User Financial Details</a>
                        </center>

                    <hr>
                    <center>
                        <h3>Status Section</h3>
                       <form method="post" action=" {{ url('admin/admin_dashboard/change_status', $profile->id) }}">
                           <div>
                               @if($profile->status == '1')
                                   <input type="radio" name="status" value="true" checked="checked"><lable>Activate</lable><br>
                                   <input type="radio" name="status" value="false"><lable>Deactivate</lable><br>
                               @elseif($profile->status == '0')
                                   <input type="radio" name="status" value="true"><lable>Activate</lable><br>
                                   <input type="radio" name="status" value="false" checked="checked"><lable>Deactivate</lable><br>
                                   @endif
                           </div>
                           <button class="btn btn-primary">Change Staus</button>
                       </form>
                    </center>

                    <hr>
                    <center>
                        <h3>Change Password Section</h3>
                        <form action="{{ url('admin/admin_dashboard/change_user_password', $profile->id) }}" method="post">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="pwd">New Password:</label>
                                <input type="password"  id="pwd" placeholder="Enter New password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Conf Password:</label>
                                <input type="password"  id="pwd" placeholder="Confirm password" name="confirm_password">
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>

                    </center>


                </div>
            </div>
          </div>


@endsection