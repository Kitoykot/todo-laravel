@extends('layouts.main')

@section('content')
    <h3 class="mt-5">{{ $task->title }}</h3>
    <hr>
    <?php
        if(!is_null($task->image))
        {
        ?>
    <a target="_blank" href="{{ $task->image }}"><img src="{{ $task->image }}" width="150" height="150"></a>
    <?php
        } else {
        ?>
    <img src="{{ asset('assets/images/noimage.png') }}" width="150" height="150">
    <?php
        }
    ?>
    <p style="float: right; padding-top: 10px;" class="text-muted">от: {{ App\Models\User::find($task->user_id)->name }}</p>

    <?php
        if($task->user_id == Auth::user()->id)
        {
        ?>
    <p class="settings_link mt-3">Настройки изображения</p>
    <div class="settings_image">
        <p class="hide_settings_link mt-3">Скрыть</p>

        <form method="POST" action="/update-image" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $task->id }}">
            <div class="form-group mt-2">
                <label for="image">{{ is_null($task->image) ? 'Загрузить' : 'Обновить' }} изображение</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-success">{{ is_null($task->image) ? 'Загрузить' : 'Обновить' }}</button>
        </form>

        <?php
            if(!is_null($task->image))
            {
            ?>
                <form method="POST" action="/delete-image" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <button class="btn btn-link">Удалить изображение</button>
                </form>
        <?php
            }
        ?>
    </div>
    <?php
        }
    ?>
    <hr>
    <small class="text-muted">теги: <b>{{ $task->tags }}</b></small>
@endsection
