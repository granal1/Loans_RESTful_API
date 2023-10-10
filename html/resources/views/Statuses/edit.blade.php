@extends('main')

@section('title', 'Statuses | edit')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('statuses.index') }}';">Вернуться</button>
        </p>
            
        <form action="{{route('statuses.update', $status)}}" method="post">
            @csrf
            @method('patch')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Изменение статуса ID = {{$status->id}}</h1></caption>

                <tr>
                    <td><label for="id">ID</label></td>
                    <td><input type="text" class="w3-input" name="id" disabled value="{{$status->id}}"></td>
                </tr>
                <tr>
                    <td><label for="name">Название статуса</label></td>
                    <td><input type="text" class="w3-input" name="name" value="{{$status->name}}" required></td>
                </tr>

            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
@endsection

