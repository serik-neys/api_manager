<x-layout>
<div class="center__block">
    <form class="login__form" action="{{route('login.store')}}" method="POST">
        @csrf
        <h1 class="bold__title">Авторизация</h1>
        <div class="form__block">
            <input name="name" class="input" placeholder="Имя" type="text">
            @error('name')
            <label class="validation_error" for="">{{$message}}</label> 
            @enderror
        </div>
        <div class="form__block">
            <input name="password" class="input" placeholder="Пароль" type="password">
            @error('password')
            <label class="validation_error" for="">{{$message}}</label> 
            @enderror
        </div>
        <button class="btn">Отправить</button>
        <a class="link mt" href="{{route('register')}}">Создать аккаунт</a>
    </form>
</div>
</x-layout>