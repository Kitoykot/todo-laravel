@extends('layouts.main')

@section('content')
    <div class="tasks">
        <h5 align="center" class="mt-5">Обновить задание "{{ $task->title }}"</h5>

        <form method="POST" action="/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $task->id }}">
            @csrf
            <div class="form-group">
                <label for="title">Задание <small class="text-muted"> нельзя осталять пустым</small></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ $task->title }}" placeholder="Купить молоко">

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="tags">Введите теги через запятую <small class="text-muted"> нельзя оставлять
                        пустым</small></label>
                <textarea class="form-control @error('tags') is-invalid @enderror" id="tags" rows="5" name="tags"
                    placeholder="молоко, покупка, магазин">{{ $task->tags }}</textarea>

                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">
                    {{ is_null($task->image) ? 'Вы можете добавить' : 'Обновить' }} изображение
                </label>
                
                <?php 
                    if(!is_null($task->image))
                    {
                ?>
                        <br>
                        <a href="{{$task->image}}" target="_blank"><img src="{{$task->image}}" width="150" height="150"></a>
                        <br><br>
                <?php
                    }
                ?>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-success">Обновить</button>
        </form>
    </div>
@endsection
