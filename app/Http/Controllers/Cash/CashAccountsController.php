<?php

namespace App\Http\Controllers\Web\Cash;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\CashAccount;

class CashAccountsController extends Controller
{
    public function show( CashAccount $cashAccount )
    {
        return Inertia::render('CashAccounts/Show', [
            'id' => $cashAccount->id
        ]);
    }
}
