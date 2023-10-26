@extends('main')

@section('title', 'Employees | List')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('employees.create') }}';">Добавить</button>
        </p>
        <table class="w3-table-all w3-hoverable w3-card-4">
            <caption><h1>Список сотрудников</h1></caption>
            <thead>
            <tr class="w3-light-grey">
                <th>ID</th>
                <th>Сотрудник</th>
                <th>Дилерский центр</th>
                <th>Создано</th>
                <th>Изменено</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr onclick="window.location='{{ route('employees.show' , $employee->id) }}';" style="cursor: pointer;">
                <td>{{$employee->id}}</td>
                <td>{{$employee->name}}</td>
                <td>{{($employee->dealership_name) ?? null}}</td>
                <td>{{$employee->created_at}}</td>
                <td>{{$employee->updated_at}}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <br>  
        {{$employees->onEachSide(2)->links()}}
    </div>
@endsection

