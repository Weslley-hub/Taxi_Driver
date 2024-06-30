<?php

namespace App\Http\Controllers;

use App\Models\TripType;
use Illuminate\Http\Request;

class TripTypeController extends Controller
{
    public function index()
    {
        $tripTypes = TripType::all();
        return view('triptypes.listar', compact('tripTypes'));
    }

    public function create()
    {
        return view('triptypes.adicionar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $tripType = TripType::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => true,
        ]);

        return redirect()->route('trip-types.index')->with('success', 'Tipo de viagem adicionado com sucesso.');
    }

    public function edit(TripType $tripType)
    {
        return view('triptypes.editar', compact('tripType'));
    }

    public function update(Request $request, TripType $tripType)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $tripType->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        $statusText = $request->status ? 'ativado' : 'desativado';

        return redirect()->route('trip-types.index')->with('success', "Tipo de viagem '{$tripType->name}' foi $statusText com sucesso.");
    }

    public function updateStatus(TripType $tripType)
    {
        $tripType->status = !$tripType->status;
        $tripType->save();

        $statusText = $tripType->status ? 'ativado' : 'desativado';
        return redirect()->route('trip-types.index')->with('success', "Tipo de viagem '{$tripType->name}' foi $statusText com sucesso.");
    }

    public function destroy(TripType $tripType)
    {
        return redirect()->route('trip-types.index')->with('success', "Tipo de viagem '{$tripType->name}' foi desativado com sucesso.");
    }
}
