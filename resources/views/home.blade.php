@extends('layouts.main')

@section('content')
    <div class="tasks">
        @guest
            <h1>Войдите или зарегистрируйтесь, чтобы составлять список дел! с:</h1>
        @endguest
        @auth
            <h1 class="add_link">+Добавить задание</h1>
            <form class="add_form">
                @csrf
                <p class="hide_link">-Скрыть</p>
                <div class="form-group">
                    <label for="title">Задание <small class="text-muted"> обязательно для заполнения</small></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        value="{{ old('title') }}" placeholder="Купить молоко">

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags">Введите теги через запятую <small class="text-muted"> обязательно для заполнения</small></label></label>
                    <textarea class="form-control @error('tags') is-invalid @enderror" id="tags" rows="5" name="tags"
                        value="{{ old('tags') }}" placeholder="молоко, покупка, магазин"></textarea>

                    @error('tags')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-success" id="submit">Добавить</button>
                <p class="mt-2">Все ваши списки дел хранятся <a href="{{route('my-tasks')}}">здесь</a></p>

                <script>
                    $(document).ready(function(){
                        $(".add_form").submit(function(e){
                            e.preventDefault();
                            
                            var _token = $("input[name='_token']").val();
                            var title = $("#title").val();
                            var tags = $("#tags").val();
    
                            $.ajax({
                                url: "{{route('add-task')}}",
                                type: "post",
                                data: {
                                    _token:_token,
                                    title:title,
                                    tags:tags,
                                },
                            });
    
                            $("#title").val("");
                            $("#tags").val("");
                        });
                    });
                </script> 
            </form>
        @endauth
    </div>  
@endsection
