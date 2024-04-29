
<x-layout>
    <x-header></x-header>
    <a class="link" href="{{ route('workspace.index') }}">Назад</a>
    <h1>{{ $workspace->title }}</h1>
    <a class="btn" href="{{ route('api_token.create', $workspace->id) }}">Create Token</a>
    @if (!$billing_quota)
    <a class="btn" href="{{ route('billing_quota.create', $workspace->id) }}">Create quota</a>
    @endif
   
    <div class="service_list">
        <div class="service_header">
            <div>Token</div>
            <div>Time</div>
            <div>Per sec.</div>
            <div>Total</div>
        </div>
        
        
            @foreach ($api_tokens as $token)
            @if (!isset($token->revoke))
            <div class="service_item">
                <div><span>{{ $token->name }}</span></div>

                @foreach ($bills as $bill)
                @if ($token->id == $bill->api_token_id)
                <div class="service_bill">
                    <div>Service {{$bill->service_id}}</div>
                    <div>{{$bill->usage_duration_in_ms}} s</div>
                    <div>$ {{$bill->cost_per_ms}}</div>
                    <div>$ {{$bill->total}}</div>
                </div>
                @endif
            @endforeach

            </div>
            @endif
            @endforeach

    </div>
  
    <h4>Total $ {{$total}}</h4>
   @isset($billing_quota)
   <h4>Limit: {{$billing_quota->limit}}</h4>
   <form action="{{ route('billing_quota.destroy', $billing_quota->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn">Delete Quota</button>
  </form>
   @endisset

  

    <h2>Token List</h2>
    <div class="token_list">
        @foreach ($api_tokens as $token)

        @if (!isset($token->revoke))
        <div class="token_elem">
            <div>Name: {{ $token->name }}</div>
            <div>Date: {{ $token->created_at }}</div>
            <form action="{{ route("api_token.update", $token) }}" method="POST">
                @csrf
                @method('PUT')
                  <button class="red">Revoke</button>
            </form>
        </div>
        @else
            <div class="token_elem revoke">
                <div>Revoked Token</div>
            <div>Name: {{ $token->name }}</div>
            <div>Date Revoke: {{ $token->revoke }}</div>
        </div>
        @endif
           
        @endforeach
    </div>
</x-layout>
