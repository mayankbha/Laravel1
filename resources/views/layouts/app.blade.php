<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/user/dashboard') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{url('user/withdrawal-history')}}">Withdrawal History</a></li>
                                    <li><a href="{{url('user/fund-history')}}">fund History</a></li>
                                    <li><a href="{{url('user/all-transaction')}}">All Transaction</a></li>
                                    <li><a href="{{url('user/service-paymant-fee')}}">Sevice & Fees</a></li>
                                    <li><a href="{{url('user/deposite-of-trade-group')}}">Deposite of trade group</a></li>
                                    <li><a href="{{url('user/invesement-history')}}">Investment History</a></li>
                                    <li><a href="{{url('user/deposit-profit-history')}}">Deposite and profit history</a></li>
                                    <li><a href="{{url('user/referral-history')}}">Referral History</a></li>
                                    <li><a href="{{url('user/refer-friend')}}">Refer Friend</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-md-12">
              @yield('content')
            </div>
        </div>
    </div>

    <div id="withdraw" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Withdraw Funds</h4>
          </div>
          <div class="modal-body">
            <form method="post" name="frm-withdrawal" action="{{url('user/withdraw-funds')}}">
              {{ csrf_field() }}
              <input type="hidden" name="userid" value="{{Auth::user()->id}}">
              <div class="form-group">
                <h4>Total Funds = {{Auth::user()->user_funds}}</h4>
              </div>
              <div class="form-group">
                <h4>Enter the amount</h4>
                <input type="number" min=0 name="addamount" class="form-control" id="amount">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Ok</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="deposit" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Funds</h4>
          </div>
          <div class="modal-body">
            <form method="post" name="frm-deposit" action="{{url('user/add-funds')}}">
              {{ csrf_field() }}
              <input type="hidden" name="userid" value="{{Auth::user()->id}}">
              <div class="form-group">
                <h4>Total Funds = {{Auth::user()->user_funds}}</h4>
              </div>
              <div class="form-group">
                <h4>Enter the amount</h4>
                <input type="number" min=0 name="addamount" class="form-control" id="amount">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
