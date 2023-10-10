@extends('main')

@section('title', 'Dealership | edit')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('dealerships.index') }}';">Вернуться</button>
        </p>
        
        <form action="{{route('dealerships.update', $dealership)}}" method="post">
            @csrf
            @method('patch')

            <table class="w3-table">
                <caption class="w3-container w3-blue"><h1>Изменение сведений о дилерском центре ID = {{$dealership->id}}</h1></caption>

                <tr>
                    <td><label for="id">ID</label></td>
                    <td><input type="text" class="w3-input" name="id" disabled value="{{$dealership->id}}"></td>
                </tr>
                <tr>
                    <td><label for="name">Название дилерского центра</label></td>
                    <td><textarea class="w3-input" id="name" name="name" rows="1" required>{{$dealership->name}}</textarea></td>
                </tr>
                <tr>
                    <td><label for="address">Адрес дилерского центра</label></td>
                    <td><textarea class="w3-input" id="address" name="address" rows="1" required>{{$dealership->address}}</textarea></td>
                </tr>

            </table>

            <p>
                <button class="w3-btn w3-teal" type="submit">Сохранить</button>
            </p>
        </form>
    </div>
    <script>
        adaptTextarea('name');
        adaptTextarea('address');
        //АВТОПОДБОР_высоты_поля_textarea
        function adaptTextarea(id) {
            var field = document.getElementById(id);
            field.setAttribute('style', 'height:' + (field.scrollHeight) + 'px; overflow-y:hidden;');
            field.addEventListener("input", OnInput, false);
            function OnInput() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            }
        };
    </script>
@endsection

