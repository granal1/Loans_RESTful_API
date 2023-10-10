@extends('main')

@section('title', 'Loan | show')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('loans.index') }}';">Вернуться</button>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('loans.edit', $loan->id) }}';">Изменить</button>
        </p>
        <table class="w3-table w3-bordered">
            <caption class="w3-container w3-blue"><h1>Карточка заявки ID = {{$loan->id}}</h1></caption>
            <thead>
                <tr>
                    <th>Поле</th><th>Значение</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID заявки</td><td>{{$loan->id}}</td>
                </tr>
                <tr>
                    <td>Дилерский центр</td><td>{{($loan->dealership_name) ?? null}}</td>
                </tr>
                <tr>
                    <td>Имя сотрудника</td><td>{{($loan->employee_name ?? null)}}</td>
                </tr>
                <tr>
                    <td>Размер кредита</td><td>{{$loan->amount}}</td>
                </tr>
                <tr>
                    <td>Срок кредита</td><td>{{$loan->months}}</td>
                </tr>
                <tr>
                    <td>Процент по кредиту</td><td>{{$loan->interest}}</td>
                </tr>
                <tr>
                    <td>Основание длявыдачи кредита</td><td>{{$loan->reason}}</td>
                </tr>
                <tr>
                    <td>Статус заявки</td><td>{{$loan->status_name ?? null}}</td>
                </tr>
                <tr>
                    <td>Банк, предоставляющий кредит</td><td>{{$loan->bank_name ?? null}}</td>
                </tr>
                <tr>
                    <td>Дата создания</td><td>{{$loan->created_at}}</td>
                </tr>
                <tr>
                    <td>Дата изменения</td><td>{{$loan->updated_at}}</td>
                </tr>
            </tbody>
        </table>
        <p>
            <details class="w3-btn w3-pale-red">
                <summary style="cursor: pointer;">Удаление записи</summary>
                <form action="{{ route('loans.destroy', $loan->id) }}" method="post">
                    <input class="w3-btn w3-red" type="submit" value="Удалить" />
                    @csrf
                    @method('delete')
                </form>
            </details>
        </p>
    </div>
@endsection

