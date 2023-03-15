@extends('layouts.app')

@section('content')
<div class="title">
    <h3>
        Deposite of trade group
    </h3>
</div>
<h4 class="text-right">Balance : {{$balance}}</h4>
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
                Deposite
            </th>
            <th>
                Withdrawal
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
            @if($info->type == "DEPOSIT")
        		<td class="text-right" style="color: green">{{$info->amount}}</td>
                <td></td>
            @elseif($info->type == "PROFIT")
                <td class="text-right" style="color: green">{{$info->amount}}</td>
                <td></td>
	        @else
                <td></td>
	        	<td class="text-right" style="color: red">{{$info->amount}}</td>
	        @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
