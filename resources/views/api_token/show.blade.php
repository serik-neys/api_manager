<x-layout>
<h1>Token Name: {{$api_token->name}}</h1>
<div class="token">Copy token: <span>{{$api_token->token}}</span></div>
<a class="link" href="{{route('workspace.show', $api_token->workspace_id)}}">Back</a>

</x-layout>