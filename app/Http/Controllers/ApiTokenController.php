<?php

namespace App\Http\Controllers;

use App\Models\ApiToken;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('api_token.create');
    }

    public function store(Request $request, string $workspace)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);
        $token = Str::random(40);

        $api_token = ApiToken::create([
            'name' => $request->name,
            'token' => $token,
            'workspace_id' => $workspace
        ]);

        return to_route('api_token.show', $api_token);
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiToken $api_token)
    {

        return view('api_token.show', ['api_token' => $api_token]);
    }

    public function update(Request $request, ApiToken $api_token)
    {

        $bills = $api_token->bills;
        foreach ($bills as $bill) {
            Bill::find($bill->id)->delete();
        }
        $api_token->update([
            'revoke' => Carbon::now()->toDateTimeString()
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
