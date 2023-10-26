@extends('main')

@section('title', 'Employee | edit')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('employees.index') }}';">Вернуться</button>
        </p>
        <form action="{{route('employees.update', $employee)}}" method="post">
            @csrf
            @method('patch')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Изменение сведений о сотруднике ID = {{$employee->id}}</h1></caption>
                <tr>
                    <td><label for="id">ID</label></td>
                    <td><input type="text" class="w3-input" name="id" disabled value="{{$employee->id}}"></td>
                </tr>
                <tr>
                    <td><label for="dealership_id">Дилерский центр</label></td>
                    <td><select class="w3-select w3-teal" id="dealership_id" name="dealership_id" required>
                            <option value="">Выберете из списка</option>
                            @forelse($dealerships as $dealership)
                                <option @if($employee->dealership_id === $dealership->id) selected @endif value="{{$dealership->id}}">{{$dealership->name}}</option>
                            @empty
                                <option value="">Не определены</option>
                            @endforelse
                        </select></td>
                </tr>
                <tr>
                    <td><label for="employee">Имя сотрудника</label></td>
                    <td><input type="text" class="w3-input" name="name" value="{{$employee->name}}" required>
                        <input type="hidden" name="id" value="{{$employee->id}}"></td>
                </tr>
                <tr>
                    <td><label for="key">Ключ сотрудника</label></td>
                    <td><input type="text" class="w3-input" name="key" value="{{$employee->key}}" required></td>
                </tr>
                <tr>
                    <td><label for="created_at">Дата создания</label></td>
                    <td><input type="datetime-local" name="created_at" disabled value="{{$employee->created_at}}"></td>
                </tr>
                <tr>
                    <td><label for="updated_at">Дата изменения</label></td>
                    <td><input type="datetime-local" name="updated_at" disabled value="{{$employee->updated_at}}"></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
@endsection

