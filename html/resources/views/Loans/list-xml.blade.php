@extends('main-xml')

@section('content')
    <loans_list>
    @forelse($loans as $loan)
        <loan>
            <id>{{$loan->id}}</id>
            <dealership_name>{{$loan->dealership->name}}</dealership_name>
            <employee_name>{{$loan->employee->name}}</employee_name>
            <amount>{{$loan->amount}}</amount>
            <month>{{$loan->months}}</month>
            <interest>{{$loan->interest}}</interest>
            <reason>{{$loan->reason}}</reason>
            <status_name>{{$loan->status->name ?? ''}}</status_name>
            <bank_name>{{$loan->bank->name ?? ''}}</bank_name>
            <created_at>{{$loan->created_at}}</created_at>
            <updated_at>{{$loan->updated_at}}</updated_at>
        </loan>
    @empty
    @endforelse
    </loans_list>
@endsection