<?php

namespace App\Http\Controllers;

use App\Models\BillingQuota;
use Illuminate\Http\Request;

class BillingQuotaController extends Controller
{

    public function create()
    {
        return view('billing_quota.create');
    }

    public function store(Request $request, $workspace)
    {

        $request->validate([
            'limit' => ['required'],
        ]);

        $billing_quota = new BillingQuota;
        $billing_quota->workspace_id = $workspace;
        $billing_quota->limit = $request->limit;
        $billing_quota->save();

        return redirect("/workspace/". $workspace);
    }


    public function destroy(string $id)
    {
        BillingQuota::destroy($id);
        return back();
    }
}
