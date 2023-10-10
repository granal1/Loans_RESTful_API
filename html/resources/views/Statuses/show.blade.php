@extends('main')

@section('title', 'Status | show')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('statuses.index') }}';">Вернуться</button>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('statuses.edit', $status->id) }}';">Изменить</button>
        </p>
        <table class="w3-table w3-bordered">
            <caption class="w3-container w3-blue"><h1>Карточка статуса ID = {{$status->id}}</h1></caption>
            <thead>
                <tr>
                    <th>Поле</th><th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td><td>{{$status->id}}</td>
                </tr>
                <tr>
                    <td>Название статуса</td><td>{{$status->name}}</td>
                </tr>
                <tr>
                    <td>Дата добавления</td><td>{{$status->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата изменения</td><td>{{$status->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <p>
            <details class="w3-btn w3-pale-red">
                <summary style="cursor: pointer;">Удаление записи</summary>
                <form action="{{ route('statuses.destroy', $status->id) }}" method="post">
                    <input class="w3-btn w3-red" type="submit" value="Удалить" />
                    @csrf
                    @method('delete')
                </form>
            </details>
        </p>
    </div>
@endsection

