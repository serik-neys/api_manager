<x-layout>
    <div class="center__block">
        <form class="login__form" action="{{route('api_token.store', request()->workspace)}}" method="POST">
            @csrf
            <h1 class="bold__title">Create Token</h1>
            <div class="form__block">
                <input name="name" class="input" placeholder="Token Name" type="text">
                @error('name')
                <label class="validation_error" for="">{{$message}}</label> 
                @enderror
            </div>
            <button class="btn">Generate</button>
        </form>
    </div>
    </x-layout>