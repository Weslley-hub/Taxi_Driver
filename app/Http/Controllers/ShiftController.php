<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\Taxi;
use App\Models\Supply;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar todos os registros da tabela shifts
        $shifts = Shift::all();

        // Exibir a view com a lista de turnos
        return view('turno.dataTurnos', compact('shifts'));
    }

    public function showForm()
    {
        $taxis = DB::table('taxis')
            ->select('taxis.*')
            ->leftJoin('shifts', function ($join) {
                $join->on('taxis.id', '=', 'shifts.taxi_id')
                    ->whereNull('shifts.dateFinish');
            })
            ->where('taxis.status', 1)
            ->whereNull('shifts.taxi_id')
            ->get();

        return view('turno.startTurno', compact('taxis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Buscar táxis ativos e disponíveis que não estão associados a nenhum turno aberto
        $taxis = DB::table('taxis')
            ->select('taxis.*')
            ->leftJoin('shifts', function ($join) {
                $join->on('taxis.id', '=', 'shifts.taxi_id')
                    ->whereNull('shifts.dateFinish');
            })
            ->where('taxis.status', 1)
            ->whereNull('shifts.taxi_id')
            ->get();

        return view('turno.startTurno', compact('taxis'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validar os dados do formulário
        $validatedData = $request->validate([
            'taxi' => 'required|numeric',
            'kmStart' => 'required|numeric',
            'kmFinish' => 'nullable|numeric',
            'dataStart' => 'required',
            'dataFinish' => 'nullable',
        ]);

        // Check if kmStart is greater than kmFinish
        /*  if ($validatedData['kmStart'] >= $validatedData['kmFinish']) {
            return redirect()->back()->withErrors(['kmStart' => 'O campo Km Inicial deve ser menor que o campo km finais.'])->withInput();
        } */

        // Verificar se o táxi selecionado já está sendo utilizado em outro turno
        $existingShift = Shift::where('taxi_id', $validatedData['taxi'])
            ->whereNotNull('dateFinish')
            ->first();

        if ($existingShift) {
            return redirect()->back()->withErrors(['taxi' => 'O táxi selecionado já está sendo utilizado em outro turno.'])->withInput();
        }

        // Criar um novo turno
        $shift = Shift::create([
            'driver_id' => auth()->user()->id, // Certifique-se de que o campo 'driver_id' esteja correto
            'taxi_id' => $validatedData['taxi'], // Certifique-se de que o campo 'taxi_id' esteja correto
            'dateStart' => $validatedData['dataStart'],
            'dateFinish' => $validatedData['dataFinish'],
            'kmStart' => $validatedData['kmStart'],
            'kmFinish' => $validatedData['kmFinish'],
        ]);

        $user = User::findOrFail(auth()->user()->id);

        $user->shiftStatus = '1';

        $user->save();

        // Redirecionar de volta para a página de listagem de turnos
        return redirect()->route('shifts.index')->with('success', 'Turno iniciado com sucesso!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        // Exibir a view com os detalhes do turno
        return view('turno.showTurno', compact('shift'));
    }


    /**
     * Edit the specified resource.
     */
    public function edit(Shift $shift)
    {
        $taxis = Taxi::where('status', 1)->get();
        return view('turno.startTurno', compact('shift', 'taxis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'taxi' => 'required',
            'kmStart' => 'required|numeric',
            'kmFinish' => 'nullable|numeric',
            'dataStart' => 'required',
            'dataFinish' => 'nullable',
        ];

        $messages = [
            'taxi.required' => 'O campo taxi é obrigatório.',
            'kmStart.required' => 'O campo kmStart é obrigatório.',
            'kmStart.numeric' => 'O campo kmStart deve ser um número.',
            'kmFinish.numeric' => 'O campo kmFinish deve ser um número.',
            'dataStart.required' => 'O campo dataStart é obrigatório.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $shift = Shift::findOrFail($id);
        $shift->update([
            'taxi_id' => $request->taxi,
            'driver_id' => auth()->user()->id,
            'dataStart' => $request->dataStart,
            'dataFinish' => $request->dataFinish,
            'kmStart' => $request->kmStart,
            'kmFinish' => $request->kmFinish,
        ]);

        // Redirecionar de volta para a lista de turnos após a atualização
        return redirect()->route('turnos.index')->with('success', 'Turno atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('shifts.index')->with('success', 'Turno excluído com sucesso!');
    }
}
