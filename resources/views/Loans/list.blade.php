@extends('main')

@section('title', 'Loans | List')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('loans.create') }}';">Добавить</button>
        </p>
        <table class="w3-table-all w3-hoverable w3-card-4">
            <caption><h1>Список заявок</h1></caption>
            <thead>
            <tr class="w3-light-grey">
                <th>ID</th>
                <th>Дилерский центр</th>
                <th>Сотрудник</th>
                <th>Размер кредита, р.</th>
                <th>Срок, мес.</th>
                <th>%</th>
                <th>Основание для выдачи</th>
                <th>Статус</th>
                <th>Банк</th>
                <th>Создано</th>
                <th>Изменено</th>
            </tr>
            </thead>
            <tbody>
            @forelse($loans as $loan)
                <tr onclick="window.location='{{ route('loans.show' , $loan->id) }}';" style="cursor: pointer;">
                <td>{{$loan->id}}</td>
                <td>{{($loan->dealership_name) ?? null}}</td>
                <td>{{($loan->employee_name) ?? null}}</td>
                <td>{{$loan->amount}}</td>
                <td>{{$loan->months}}</td>
                <td>{{$loan->interest}}</td>
                <td>{{$loan->reason}}</td>
                <td>{{$loan->status_name ?? null }}</td>
                <td>{{$loan->bank_name ?? null}}</td>
                <td>{{$loan->created_at}}</td>
                <td>{{$loan->updated_at}}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <br>
        {{$loans->onEachSide(2)->links()}}
    </div>
@endsection

