<x-layout>
    <div class="center__block">
        <form class="login__form" action="{{route('workspace.store')}}" method="POST">
            @csrf
            <h1 class="bold__title">Workspace Create</h1>
            <div class="form__block">
                <input name="title" placeholder="Title" class="input" type="text">
                @error('title')
                <label class="validation_error" for="">{{$message}}</label> 
                @enderror
            </div>
            <div class="form__block">
                <input name="description" class="input" placeholder="Nullable" type="text">
                @error('description')
                <label class="validation_error" for="">{{$message}}</label> 
                @enderror
            </div>
            <button class="btn">Отправить</button>
        </form>
    </div>
    </x-layout>