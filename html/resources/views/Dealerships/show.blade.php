@extends('main')

@section('title', 'Dealership | show')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('dealerships.index') }}';">Вернуться</button>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('dealerships.edit', $dealership->id) }}';">Изменить</button>
        </p>
        <table class="w3-table w3-bordered">
            <caption class="w3-container w3-blue"><h1>Карточка дилерского центра ID = {{$dealership->id}}</h1></caption>
            <thead>
                <tr>
                    <th>Поле</th><th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID дилерского центра</td><td>{{$dealership->id}}</td>
                </tr>
                <tr>
                    <td>Название дилерского центра</td><td>{{$dealership->name}}</td>
                </tr>
                <tr>
                    <td>Адрес дилерского центра</td><td>{{$dealership->address}}</td>
                </tr>
                <tr>
                    <td>Дата добавления</td><td>{{$dealership->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата изменения</td><td>{{$dealership->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <p>
            <details class="w3-btn w3-pale-red">
                <summary style="cursor: pointer;">Удаление записи</summary>
                <form action="{{ route('dealerships.destroy', $dealership->id) }}" method="post">
                    <input class="w3-btn w3-red" type="submit" value="Удалить" />
                    @csrf
                    @method('delete')
                </form>
            </details>
        </p>
    </div>
@endsection

