@extends('layouts.app')

@section('content')
<div class="title">
    <h3>
        All Transaction History
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
                Type
            </th>
            <th>
                Amount
            </th>
            <th>
                Charges
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $result as $key => $info)
        
        <tr>
            <td>
                {{ $key+1}}
            </td>
            @if($info->reference_type == "DEPOSIT")
            <td>
                {{ Carbon\Carbon::parse($info->deposite->created_at)->format('d-m-Y H:i') }}
            </td>
            @else
            <td>
                {{ Carbon\Carbon::parse($info->withdrawal->created_at)->format('d-m-Y H:i') }}
            </td>
            @endif
            <td>
                {{$info->reference_type}}
            </td>
            @if($info->reference_type == "DEPOSIT")
                <td class="text-right" style="color: green">{{$info->deposite->amount}}</td>
        		<td class="text-right" style="color: green">{{$info->amount}}</td>
	        @else
                <td class="text-right" style="color: red">{{$info->withdrawal->amount}}</td>
	        	<td class="text-right" style="color: red">{{$info->amount}}</td>
	        @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
