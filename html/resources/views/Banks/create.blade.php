@extends('main')

@section('title', 'Banks | create')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('banks.index') }}';">Вернуться</button>
        </p>
        <form action="{{route('banks.store')}}" method="post">
            @csrf
            @method('post')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Добавление банка</h1></caption>
                <tr>
                    <td><label for="name">Название банка</label></td>
                    <td><input type="text" class="w3-input" name="name" value="" required></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
@endsection
