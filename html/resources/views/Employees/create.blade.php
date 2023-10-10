@extends('main')

@section('title', 'Employee | create')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('employees.index') }}';">Вернуться</button>
        </p>
        <form action="{{route('employees.store')}}" method="post">
            @csrf
            @method('post')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Добавление сотрудника</h1></caption>

                <tr>
                    <td><label for="dealership_id">Дилерский центр</label></td>
                    <td><select class="w3-select w3-teal" id="dealership_id" name="dealership_id" required>
                            <option value="">Выберете из списка</option>
                            @forelse($dealerships as $dealership)
                                <option value="{{$dealership->id}}">{{$dealership->name}}</option>
                            @empty
                                <option value="">Не определены</option>
                            @endforelse
                        </select></td>
                </tr>
                <tr>
                    <td><label for="name">Фамилия И.О.</label></td>
                    <td><input class="w3-input" type="text" name="name" required></td>
                </tr>
                <tr>
                    <td><label for="key">Ключ сотрудника</label></td>
                    <td><input class="w3-input" name="key" required></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
@endsection

