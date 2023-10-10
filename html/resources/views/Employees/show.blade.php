@extends('main')

@section('title', 'Employee | show')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('employees.index') }}';">Вернуться</button>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('employees.edit', $employee->id) }}';">Изменить</button>
        </p>
        <table class="w3-table w3-bordered">
            <caption class="w3-container w3-blue"><h1>Карточка сотрудника ID = {{$employee->id}}</h1></caption>
            <thead>
                <tr>
                    <th>Поле</th><th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID сотрудника</td><td>{{$employee->id}}</td>
                </tr>
                <tr>
                    <td>Дилерский центр</td><td>{{($employee->dealership_name) ?? null}}</td>
                </tr>
                <tr>
                    <td>Имя сотрудника</td><td>{{$employee->name}}</td>
                </tr>
                <tr>
                    <td>Ключ сотрудника</td><td>{{$employee->key}}</td>
                </tr>
                <tr>
                    <td>Дата добавления</td><td>{{$employee->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата изменения</td><td>{{$employee->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <p>
            <details class="w3-btn w3-pale-red">
                <summary style="cursor: pointer;">Удаление записи</summary>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                    <input class="w3-btn w3-red" type="submit" value="Удалить" />
                    @csrf
                    @method('delete')
                </form>
            </details>
        </p>
    </div>
@endsection

