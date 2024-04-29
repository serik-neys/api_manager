<?php

use App\Models\ApiToken;
use App\Models\Bill;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts/{token}', function (string $token) {
    $time_start = microtime(true);

    $service_id = 1;
    $api_token = ApiToken::where('token', '=', $token)->first();
   
    if(!$api_token || isset($api_token->revoke)) {
        return ['message' => 'Not valid token'];
    }
    $workspace = Workspace::find($api_token->workspace_id);
    $billing_quota = $workspace->billing_quota;
    $api_tokens = $workspace->api_tokens;
    $bills = Bill::whereBelongsTo($api_tokens, 'api_token')->get();
    $bill = Bill::query()->where('api_token_id', '=', $api_token->id)->where('service_id', '=', $service_id)->first();
   

    if(!$bill) {
        return ['message' => 'Service not have a bill!'];
    }

    $posts = [
        [
            'id' => 1,
            'name' => 'Programming',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus sit recusandae aliquid!'
        ],
        [
            'id' => 2,
            'name' => 'Your Life',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus sit recusandae aliquid!'
        ],
        [
            'id' => 3,
            'name' => 'Second Post',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus sit recusandae aliquid!'
        ],
    ];

    $time_end = microtime(true);

    $usage_duration = $time_end - $time_start;
    $mileseconds = $usage_duration * 10;
    $cost_per_ms = $bill->cost_per_ms;
    $total_bill = $cost_per_ms * $mileseconds;
    

    $total = sum_by_column($bills, 'total') + $total_bill;
    if(isset($billing_quota)) {
        if($total >= $billing_quota->limit) {
            return ['message' => 'API Quota limited!'];
        }
    }

     $bill->update([
        'usage_duration_in_ms' => round($bill->usage_duration_in_ms + $usage_duration, 3),
        'total' => round($bill->total + $total_bill, 2)
    ]);


    return $posts;
});

Route::get('/books/{token}', function (string $token) {
    $time_start = microtime(true);

    $service_id = 2;
    $api_token = ApiToken::where('token', '=', $token)->first();
    if(!$api_token || isset($api_token->revoke)) {
        return ['message' => 'Not valid token'];
    }

    $workspace = Workspace::find($api_token->workspace_id);
    $billing_quota = $workspace->billing_quota;
    $api_tokens = $workspace->api_tokens;
    $bills = Bill::whereBelongsTo($api_tokens, 'api_token')->get();
    $total = sum_by_column($bills, 'total');

   
    if(isset($billing_quota)) {
        if($total >= $billing_quota->limit) {
            return ['message' => 'API Quota limited!'];
        }
    }

    $bill = Bill::query()->where('api_token_id', '=', $api_token->id)->where('service_id', '=', $service_id)->first();

    if(!$bill) {
        return ['message' => 'Service not have a bill!'];
    }

 
$books = [
    [
        'id' => 1,
        'name' => 'JS Progamming',
        'author' => 'Dylan Scott'
    ],
    [
        'id' => 2,
        'name' => 'Dance or life?',
        'author' => 'Mickhael Jackson'
    ],
    [
        'id' => 3,
        'name' => 'Travel Whole World!',
        'author' => 'Steve Corney'
    ],
];

    $time_end = microtime(true);

    $usage_duration = $time_end - $time_start;
    $mileseconds = $usage_duration * 10;
    $cost_per_ms = $bill->cost_per_ms;
    $total_bill = $cost_per_ms * $mileseconds;
    

    $total = sum_by_column($bills, 'total') + $total_bill;
    if(isset($billing_quota)) {
        if($total >= $billing_quota->limit) {
            return ['message' => 'API Quota limited!'];
        }
    }
    
     $bill->update([
        'usage_duration_in_ms' => round($bill->usage_duration_in_ms + $usage_duration, 3),
        'total' => round($bill->total + $total_bill, 2)
    ]);


    return $books;
});



