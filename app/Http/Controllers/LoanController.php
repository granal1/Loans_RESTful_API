<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Dealership;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $loans = DB::table('loans')
            ->whereNull('loans.deleted_at')
            ->orderBy('id', 'desc')
            ->leftJoin('dealerships', 'loans.dealership_id', '=', 'dealerships.id')
            ->leftJoin('employees', 'loans.employee_id', '=', 'employees.id')
            ->leftJoin('banks', 'loans.bank_id', '=', 'banks.id')
            ->leftJoin('statuses', 'loans.status_id', '=', 'statuses.id')
            ->select('loans.*', 
                'dealerships.name as dealership_name', 
                'employees.name as employee_name',
                'statuses.name as status_name',
                'banks.name as bank_name'
                )
            ->paginate(5);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Loans.list', [
                        'loans' => $loans,
                    ]);
                break;
            case 'application/json':
                return response()->json($loans, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Loans
                break;
            default:
                return null;    
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Loans.create', [
            'dealerships' => Dealership::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Loan::create($request->all());
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('loans.create');;
                    break;
                case 'application/json':
                    return response()->json('Добавлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Loans
                    break;
                default:
                    return null;    
                    break;
            }

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $loan = DB::table('loans')
            ->where('loans.id', $id)
            ->whereNull('loans.deleted_at')
            ->leftJoin('dealerships', 'loans.dealership_id', '=', 'dealerships.id')
            ->leftJoin('employees', 'loans.employee_id', '=', 'employees.id')
            ->leftJoin('banks', 'loans.bank_id', '=', 'banks.id')
            ->leftJoin('statuses', 'loans.status_id', '=', 'statuses.id')
            ->select('loans.*', 
                'dealerships.name as dealership_name', 
                'employees.name as employee_name',
                'statuses.name as status_name',
                'banks.name as bank_name'
                )
            ->get();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Loans.show', [
                        'loan' => $loan[0],
                    ]);
                break;
            case 'application/json':
                return response()->json($loan[0], 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Loans
                break;
            default:
                return null;    
                break;
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::find($id);

        return view('Loans.edit', [
            'loan' => $loan,
            'statuses' => Status::all(),
            'banks' => Bank::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        try {
            DB::beginTransaction();

            $loan->update([
                'dealership_id' => $request['dealership_id'],
                'employee_id' => $request['employee_id'],
                'amount' => $request['amount'],
                'months' => $request['months'],
                'interest' => $request['interest'],
                'reason' => $request['reason'],
                'status_id' => $request['status_id'],
                'bank_id' => $request['bank_id'],
            ]);
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('loans.index');;
                    break;
                case 'application/json':
                    return response()->json('Обновлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Loans
                    break;
                default:
                    return null;    
                    break;
            }

        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Loan $loan)
    {
        $loan->delete();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return redirect()->route('loans.index');;
                break;
            case 'application/json':
                return response()->json('Удалено', 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Loans
                break;
            default:
                return null;    
                break;
        }
    }
}
