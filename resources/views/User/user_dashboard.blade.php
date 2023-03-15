@extends('layouts.app')

@section('content')

<div class="col-sm-12 col-lg-4">
    <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

        <img class="u-mb-small" src="{{asset('images/icon-intro1.svg')}}" alt="iPhone icon">

        <h4 class="u-h6 u-text-bold u-mb-small">
            Now you can withdraw your funds easily. Click here for withdraawl.
        </h4>
        <a class="c-btn c-btn--info" data-toggle="modal" data-target="#withdraw" href="#">Withdraw Funds</a>
    </div>
</div>

<div class="col-sm-12 col-lg-4">
    <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

        <img class="u-mb-small" src="{{asset('images/icon-intro2.svg')}}" alt="iPhone icon">

        <h4 class="u-h6 u-text-bold u-mb-small">
            Now you can deposit your funds easily. Click here for withdraawl.
        </h4>
        <a class="c-btn c-btn--info" data-toggle="modal" data-target="#deposit" href="#">Deposit Funds</a>
    </div>
</div>

@endsection
