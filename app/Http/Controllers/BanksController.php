<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $banks = DB::table('banks')
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->paginate(5);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Banks.list', [
                        'banks' => $banks,
                    ]);
                break;
            case 'application/json':
                return response()->json($banks, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Bank
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
        return view('Banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Bank::create($request->all());
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return redirect()->route('banks.create');;
                    break;
                case 'application/json':
                    return response()->json('Добавлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Bank
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
        $bank = Bank::find($id);

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Banks.show', [
                        'bank' => $bank,
                    ]);
                break;
            case 'application/json':
                return response()->json($bank, 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Bank
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
        $bank = Bank::find($id);
        return view('Banks.edit', [
            'bank' => $bank,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        try {
            DB::beginTransaction();

            $bank->update([
                'name' => $request['name'],
            ]);
            
            DB::commit();

            switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
                case 'text/html':
                        return view('Banks.index', [
                            'bank' => $bank,
                        ]);
                    break;
                case 'application/json':
                    return response()->json('Обновлено', 200);
                    break;
                case 'text/xml':
                                    // TODO Вывод в xml формате не реализован для Bank
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
    public function destroy(Request $request, Bank $bank)
    {
        $bank->delete();

        switch ($request->prefers(['text/html', 'text/xml', 'application/json'])) { 
            case 'text/html':
                    return view('Banks.index', [
                        'bank' => $bank,
                    ]);
                break;
            case 'application/json':
                return response()->json('Удалено', 200);
                break;
            case 'text/xml':
                                // TODO Вывод в xml формате не реализован для Bank
                break;
            default:
                return null;    
                break;
        }
    }
}
