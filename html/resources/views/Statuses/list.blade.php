@extends('main')

@section('title', 'Statuses | List')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('statuses.create') }}';">Добавить</button>
        </p>
        <table class="w3-table-all w3-hoverable w3-card-4">
            <caption><h1>Список статусов заявок</h1></caption>
            <thead>
            <tr class="w3-light-grey">
                <th>ID</th>
                <th>Название</th>
                <th>Создано</th>
                <th>Изменено</th>
            </tr>
            </thead>
            <tbody>
            @forelse($statuses as $status)
                <tr onclick="window.location='{{ route('statuses.show' , $status->id) }}';" style="cursor: pointer;">
                <td>{{$status->id}}</td>
                <td>{{$status->name}}</td>
                <td>{{$status->created_at}}</td>
                <td>{{$status->updated_at}}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <br>
        {{$statuses->onEachSide(2)->links()}}
    </div>
@endsection

