@extends('main')

@section('title', 'Dealerships | List')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('dealerships.create') }}';">Добавить</button>
        </p>
        <table class="w3-table-all w3-hoverable w3-card-4">
            <caption><h1>Список дилерских центров</h1></caption>
            <thead>
            <tr class="w3-light-grey">
                <th>ID</th>
                <th>Название</th>
                <th>Адрес</th>
                <th>Создано</th>
                <th>Изменено</th>
            </tr>
            </thead>
            <tbody>
            @forelse($dealerships as $dealership)
                <tr onclick="window.location='{{ route('dealerships.show' , $dealership->id) }}';" style="cursor: pointer;">
                <td>{{$dealership->id}}</td>
                <td>{{$dealership->name}}</td>
                <td>{{$dealership->address}}</td>
                <td>{{$dealership->created_at}}</td>
                <td>{{$dealership->updated_at}}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <br>
        {{$dealerships->onEachSide(2)->links()}}
    </div>
@endsection

