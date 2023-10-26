<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statuses = DB::table('statuses')
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->paginate(5);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Statuses.list', [
                        'statuses' => $statuses,
                    ]);
                break;
            case 'application/json':
                return response()->json($statuses, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Statuses
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
        return view('Statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Status::create($request->all());
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('statuses.create');
                    break;
                case 'application/json':
                    return response()->json('Добавлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Statuses
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
        $status = Status::find($id);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Statuses.show', [
                        'status' => $status,
                    ]);
                break;
            case 'application/json':
                return response()->json($status, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Statuses
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
        $status = Status::find($id);
        return view('Statuses.edit', [
            'status' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        try {
            DB::beginTransaction();

            $status->update([
                'name' => $request['name'],
            ]);
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('statuses.index');
                    break;
                case 'application/json':
                    return response()->json('Обновлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Statuses
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
    public function destroy(Request $request, Status $status)
    {
        $status->delete();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return redirect()->route('statuses.index');
                break;
            case 'application/json':
                return response()->json('Удалено', 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Statuses
                break;
            default:
                return null;    
                break;
        }
    }
}
