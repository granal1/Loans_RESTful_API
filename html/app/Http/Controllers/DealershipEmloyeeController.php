<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Dealership;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class DealershipEmloyeeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $dealership_id)
    {

        $employees = DB::table('employees')
                    ->select('id', 'name')
                    ->where('dealership_id', $dealership_id)
                    ->get();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                                // TODO Вывод в html формате не реализован для DealershipEmloyeeController
                break;
            case 'application/json':
                return response()->json($employees, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для DealershipEmloyeeController
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
        // TODO create() не реализован для DealershipEmloyeeController
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO store() не реализован для DealershipEmloyeeController
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // TODO edit() не реализован для DealershipEmloyeeController
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TODO update() не реализован для DealershipEmloyeeController
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // TODO destroy() не реализован для DealershipEmloyeeController
    }

}