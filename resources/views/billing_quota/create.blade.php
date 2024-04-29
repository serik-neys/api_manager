<x-layout>
    <div class="center__block">
        <form class="login__form" action="{{route('billing_quota.store', request()->workspace)}}" method="POST">
            @csrf
            <h1 class="bold__title">Create Quota</h1>
            <div class="form__block">
                <input name="limit" class="input" placeholder="Limit for dollars" type="number">
                @error('limit')
                <label class="validation_error" for="">{{$message}}</label> 
                @enderror


            </div>
            <button class="btn">Create</button>
        </form>
    </div>
    </x-layout>