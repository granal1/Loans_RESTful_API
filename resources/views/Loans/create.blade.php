@extends('main')

@section('title', 'Loan | create')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('loans.index') }}';">Вернуться</button>
        </p>
        <form action="{{route('loans.store')}}" method="post">
            @csrf
            @method('post')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Создание новой заявки</h1></caption>

                <tr>
                    <td><label for="dealership_id">Дилерский центр</label></td>
                    <td><select class="w3-select w3-teal" id="dealership_id" name="dealership_id" required>
                            <option value="0">Выберете из списка</option>
                            @forelse($dealerships as $dealership)
                                <option value="{{$dealership->id}}">{{$dealership->name}}</option>
                            @empty
                                <option value="">Не определены</option>
                            @endforelse
                        </select></td>
                </tr>
                <tr>
                    <td><label for="employee_id">Имя сотрудника</label></td>
                    <td><select class="w3-select w3-teal" name="employee_id" id="employee_id" required>
                        <option value="">Список пуст</option>
                    </select></td>
                </tr>
                <tr>
                    <td><label for="amount">Размер кредита, руб</label></td>
                    <td><input class="w3-input" type="text" size="26" name="amount" required></td>
                </tr>
                <tr>
                    <td><label for="months">Срок кредита, мес</label></td>
                    <td><input class="w3-input" type="number" size="26" name="months" required></td>
                </tr>
                <tr>
                    <td><label for="interest">Процент по кредиту, %</label></td>
                    <td><input class="w3-input" type="number" size="26" min="0" max="100" step="0.01" name="interest" required></td>
                </tr>
                <tr>
                    <td><label for="reason">Основание для выдачи кредита</label></td>
                    <td><textarea class="w3-input" id="textarea" name="reason" rows="1" placeholder="Заполните" required></textarea></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function(){
                $('#dealership_id').change(function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    var company = $(e.target).val();
                    $.ajax({
                        url: "../dealerships/" + company + "/employees",
                        type: "GET",
                        dataType: 'json',
                        success: function(employees){
                            $('#dealership_id option[value=0]').remove();
                            $('#employee_id').html('<option value="">Выберете из списка</option>');
                            $.each(employees, function(key, employee) 
                                {
                                    $('#employee_id').append('<option value="' + employee.id + '">' + employee.name + '</option>');
                                }
                            );
                        }
                    });
                });
            });
        }, false);
    </script>
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
@endsection

