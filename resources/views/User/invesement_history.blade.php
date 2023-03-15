@extends('layouts.app')

@section('content')
<div class="title">
    <h3>
        Deposite of trade group
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
                {{$info->type}}
            </td>
            @if($info->type == "DEPOSIT")
        		<td class="text-right" style="color: green">	
	        @else
	        	<td class="text-right" style="color: red">
	        @endif
                {{$info->amount}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
