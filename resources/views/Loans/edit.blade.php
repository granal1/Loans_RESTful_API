@extends('main')

@section('title', 'Loan | edit')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('loans.index') }}';">Вернуться</button>
        </p>
        
        <form action="{{route('loans.update', $loan)}}" method="post">
            @csrf
            @method('patch')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Изменение заявки ID = {{$loan->id}}</h1></caption>
                <tr>
                    <td><label for="id">ID</label></td>
                    <td><input type="text" class="w3-input" name="id" disabled value="{{$loan->id}}"></td>
                </tr>
                <tr>
                    <td><label for="dealership">Дилерский центр</label></td>
                    <td><input type="text" class="w3-input" name="dealership" disabled value="{{($loan->dealership->name) ?? null}}" required>
                        <input type="hidden" name="dealership_id" value="{{$loan->dealership_id}}"></td>
                </tr>
                <tr>
                    <td><label for="employee">Имя сотрудника</label></td>
                    <td><input type="text" class="w3-input" name="employee" disabled value="{{($loan->employee->name) ?? null}}" required>
                        <input type="hidden" name="employee_id" value="{{$loan->employee_id}}"></td>
                </tr>
                <tr>
                    <td><label for="amount">Размер кредита</label></td>
                    <td><input type="text" class="w3-input" name="amount" value="{{$loan->amount}}" required></td>
                </tr>
                <tr>
                    <td><label for="months">Срок кредита</label></td>
                    <td><input type="number" class="w3-input" name="months" value="{{$loan->months}}" required></td>
                </tr>
                <tr>
                    <td><label for="interest">Процент по кредиту</label></td>
                    <td><input type="number" class="w3-input" min="0" max="100" step="0.01" name="interest" value="{{$loan->interest}}" required></td>
                </tr>
                <tr>
                    <td><label for="reason">Основание для выдачи кредита</label></td>
                    <td><textarea name="reason" class="w3-input" id="textarea" rows="1" required>{{$loan->reason}}</textarea></td>
                </tr>
                <tr>
                    <td><label for="status">Статус заявки</label></td>
                    <td><select class="w3-select w3-teal" name="status_id">
                            <option value="">Выберете из списка</option>
                            @forelse($statuses as $status)
                                <option @if($loan->status_id === $status->id) selected @endif value="{{$status->id}}" required>{{($status->name)}}</option>
                            @empty
                                <option value="">Не определены</option>
                            @endforelse
                        </select></td>
                </tr>
                <tr>
                    <td><label for="bank">Банк, предоставляющий кредит</label></td>
                    <td><select class="w3-select w3-teal" name="bank_id">
                        <option value="">Выберете из списка</option>
                        @forelse($banks as $bank)
                            <option @if($loan->bank_id === $bank->id) selected @endif value="{{$bank->id}}">{{$bank->name}}</option>
                        @empty
                            <option value="">Не определены</option>
                        @endforelse
                    </select></td>
                </tr>
                <tr>
                    <td><label for="created_at">Дата создания заявки</label></td>
                    <td><input type="datetime-local" name="created_at" disabled value="{{$loan->created_at}}"></td>
                </tr>
                <tr>
                    <td><label for="updated_at">Дата последнего изменения</label></td>
                    <td><input type="datetime-local" name="updated_at" disabled value="{{$loan->updated_at}}"></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
        <script>
            adaptTextarea('textarea');
            //АВТОПОДБОР_высоты_поля_textarea
            function adaptTextarea(id) {
                var field = document.getElementById(id);
                field.setAttribute('style', 'height:' + (field.scrollHeight) + 'px;overflow-y:hidden;');
                field.addEventListener("input", OnInput, false);
                function OnInput() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                }
            };
        </script>
    </div>
@endsection

