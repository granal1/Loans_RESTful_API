@extends('main')

@section('title', 'Banks | show')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('banks.index') }}';">Вернуться</button>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('banks.edit', $bank->id) }}';">Изменить</button>
        </p>
        <table class="w3-table w3-bordered">
            <caption class="w3-container w3-blue"><h1>Карточка банка ID = {{$bank->id}}</h1></caption>
            <thead>
                <tr>
                    <th>Поле</th><th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td><td>{{$bank->id}}</td>
                </tr>
                <tr>
                    <td>Название статуса</td><td>{{$bank->name}}</td>
                </tr>
                <tr>
                    <td>Дата добавления</td><td>{{$bank->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата изменения</td><td>{{$bank->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <p>
            <details class="w3-btn w3-pale-red">
                <summary style="cursor: pointer;">Удаление записи</summary>
                <form action="{{ route('banks.destroy', $bank->id) }}" method="post">
                    <input class="w3-btn w3-red" type="submit" value="Удалить" />
                    @csrf
                    @method('delete')
                </form>
            </details>
        </p>
    </div>
@endsection

