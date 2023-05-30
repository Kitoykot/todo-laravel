@extends('layouts.main')

@section('content')
    <div class="task mt-5">
        <h4 class="mb-5">Мои задания</h4> 
        @foreach ($tasks as $task)
            <ul class="list-group mt-4">
                <a href="/one-task/{{$task->id}}" class="list-group-item list-group-item-action">
                    <b>{{$task->title}}</b>
                    <form method="POST" action="/delete" style="float: right; padding-right: 10px;">
                        @csrf
                        <input type="hidden" name="id" value="{{$task->id}}">
                        <button class="btn btn-link" type="submit" name="delete">Удалить</button>
                    </form>

                    <form style="float: right; padding-right: 10px;" action="/update-task/{{$task->id}}">
                        <button class="btn btn-link">Изменить</button>
                    </form>
                            
                    <form method="POST" action="/public-task" style="float: right; padding-right: 10px;">
                        @csrf
                        <input type="hidden" name="id" value="{{$task->id}}">
                        <button class="btn btn-{{(int)$task->public == 1 ? 'link' : 'info'}}" type="submit" name="public>">
                            {{(int)$task->public == 1 ? 'Снять с публичного доступа' : 'Сделать видимым'}}
                        </button>                                    
                    </form>
                </a>
            </ul>
        @endforeach
    </div>
@endsection