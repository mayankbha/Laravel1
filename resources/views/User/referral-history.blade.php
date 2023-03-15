@extends('layouts.app')

@section('content')
<div class="title">
    <h3>
        Referral History
    </h3>
</div>

<table cellspacing="0" class="table table-striped table-bordered" width="100%">
    <thead>
        <tr>
            <th>
                Sr.No
            </th>
            <th>
                Trans. Date
            </th>
            <th>
                Descripton
            </th>
            <th>
                Amount
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $result as $key => $info)
        <tr>
            <td>
                {{ $key+1}}
            </td>
            <td>
                {{ Carbon\Carbon::parse($info->created_at)->format('d-m-Y H:i') }}
            </td>
            <td>
                {{ucwords(str_replace('_', ' ',$info->description))}}
            </td>
            <td class="text-right" style="color: green">
                {{$info->amount}}
            </td>
           
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
