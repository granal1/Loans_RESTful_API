@extends('main')

@section('title', 'Banks | List')

@section('content')
    <div class="w3-container">
        <p>
            <button class="w3-btn w3-teal" onclick="window.location='{{ route('banks.create') }}';">Добавить</button>
        </p>
        <table class="w3-table-all w3-hoverable w3-card-4">
            <caption><h1>Список банков</h1></caption>
            <thead>
            <tr class="w3-light-grey">
                <th>ID</th>
                <th>Название</th>
                <th>Создано</th>
                <th>Изменено</th>
            </tr>
            </thead>
            <tbody>
            @forelse($banks as $bank)
                <tr onclick="window.location='{{ route('banks.show' , $bank->id) }}';" style="cursor: pointer;">
                <td>{{$bank->id}}</td>
                <td>{{$bank->name}}</td>
                <td>{{$bank->created_at}}</td>
                <td>{{$bank->updated_at}}</td>
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>
        <br>  
        {{$banks->onEachSide(2)->links()}}
    </div>
@endsection

