@extends('main')

@section('title', 'Dealership | create')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('dealerships.index') }}';">Вернуться</button>
        </p>
        <form action="{{route('dealerships.store')}}" method="post">
            @csrf
            @method('post')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Добавление дилерского центра</h1></caption>
                <tr>
                    <td><label for="name">Название дилерского центра</label></td>
                    <td><textarea class="w3-input" id="textarea" name="name" rows="1" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="address">Адрес дилерского центра</label></td>
                    <td><textarea class="w3-input" id="textarea" name="address" rows="1" required></textarea></td>
                </tr>
            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
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
