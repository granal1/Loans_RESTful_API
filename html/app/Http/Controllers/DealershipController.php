<?php

namespace App\Http\Controllers;

use App\Models\Dealership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DealershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dealerships = DB::table('dealerships')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->paginate(5);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Dealerships.list', [
                        'dealerships' => $dealerships,
                    ]);
                break;
            case 'application/json':
                return response()->json($dealerships, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Dealership
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
        return view('Dealerships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Dealership::create($request->all());
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('dealerships.create');;
                    break;
                case 'application/json':
                    return response()->json('Добавлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Dealership
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
        $dealership = Dealership::find($id);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Dealerships.show', [
                        'dealership' => $dealership,
                    ]);
                break;
            case 'application/json':
                return response()->json($dealership, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Dealership
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
        $dealership = Dealership::find($id);
        return view('Dealerships.edit', [
            'dealership' => $dealership,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dealership $dealership)
    {
        try {
            DB::beginTransaction();

            $dealership->update([
                'name' => $request['name'],
                'address' => $request['address'],
            ]);
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('dealerships.index');;
                    break;
                case 'application/json':
                    return response()->json('Обновлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Dealership
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
    public function destroy(Request $request, Dealership $dealership)
    {
        $dealership->delete();
        return redirect()->route('dealerships.index');

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return redirect()->route('dealerships.index');;
                break;
            case 'application/json':
                return response()->json('Удалено', 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Dealership
                break;
            default:
                return null;    
                break;
        }
    }
}
