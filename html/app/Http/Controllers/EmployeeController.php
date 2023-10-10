<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = DB::table('employees')
            ->whereNull('employees.deleted_at')
            ->orderBy('employees.name')
            ->join('dealerships', 'employees.dealership_id', '=', 'dealerships.id')
            ->select( 
                'employees.id',
                'employees.dealership_id',
                'dealerships.name as dealership_name',
                'employees.name',
                'employees.created_at',
                'employees.updated_at'
            )
            ->paginate(5);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Employees.list', [
                        'employees' => $employees,
                    ]);
                break;
            case 'application/json':
                return response()->json($employees, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Employee
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
        return view('Employees.create', [
            'dealerships' => Dealership::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Employee::create($request->all());
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('employees.create');;
                    break;
                case 'application/json':
                    return response()->json('Добавлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Employee
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
        $employee = Employee::find($id);

        $employee = DB::table('employees')
            ->where('employees.id', $id)
            ->whereNull('employees.deleted_at')
            ->join('dealerships', 'employees.dealership_id', '=', 'dealerships.id')
            ->select(
                'employees.*',
                'dealerships.name as dealership_name',
            )
            ->get();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Employees.show', [
                        'employee' => $employee[0],
                    ]);
                break;
            case 'application/json':
                return response()->json($employee[0], 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Employee
                break;
            default:
                return null;    
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $employee = Employee::find($id);

        return view('Employees.edit', [
            'employee' => $employee,
            'dealerships' => Dealership::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $employee->update([
                'dealership_id' => $request['dealership_id'],
                'name' => $request['name'],
                'key' => $request['key'],
            ]);
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('employees.create');;
                    break;
                case 'application/json':
                    return response()->json('Обновлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Employee
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
    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return redirect()->route('employees.index');;
                break;
            case 'application/json':
                return response()->json('Удалено', 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Employee
                break;
            default:
                return null;    
                break;
        }
    }


}
