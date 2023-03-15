@extends('layouts.app')

@section('content')
<div class="title">
    <h3>
        User Referral
    </h3>
</div>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <form action="{{route('refer-friend')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <div class="col-sm-5">
                <input class="form-control" id="email" name="email" placeholder="Enter email" type="email">
                </input>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <button class="btn btn-default" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
