<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $workspaces = Workspace::query()->get()->where('user_id', '=', $id);

        return view('workspace.index', ['workspaces' => $workspaces]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workspace.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['string']
        ]);

        Workspace::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/workspace');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        $api_tokens = $workspace->api_tokens;
        $bills = Bill::whereBelongsTo($api_tokens, 'api_token')->get();
        $billing_quota = $workspace->billing_quota;
        $total = sum_by_column($bills, 'total');
        

        return view('workspace.show', [
            'workspace' => $workspace,
            'api_tokens' => $api_tokens,
            'bills' => $bills,
            'billing_quota' => $billing_quota,
            'total' => $total
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
