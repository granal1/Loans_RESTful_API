<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Loan;
use App\Models\Employee;
use App\Models\Dealership;

class ApiController extends Controller
{
    public function getAllLoans()
    {
        return view('Loans.list', [
            'loans' => Loan::all(),
        ]);
    }

    public function getLoanById(int $id)
    {
        $loan = Loan::find($id);

        return view('Loans.show', [
            'loan' => $loan,
        ]);
    }

}
