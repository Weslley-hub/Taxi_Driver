<?php

namespace App\Http\Controllers;

use App\Models\Suplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuplementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suplements = Suplement::all();
        return view('sup.dataSuplementos', compact('suplements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function formShow()
    {
        return view('sup.formSuplementos');
    }
    public function create()
    {
        return view('sup.formSuplementos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:1,0'
        ];

        $messages = [
            'name.required' => 'O nome do suplemento é obrigatório.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'status.required' => 'O estado é obrigatório.',
            'status.in' => 'O estado deve ser 1 (Disponível) ou 0 (Indisponível).'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Suplement::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return redirect()->route('suplementos.index')->with('success', 'Suplemento criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suplement = Suplement::find($id);

        if (!$suplement) {
            abort(404);
        }

        return view('sup.formSuplementos', ['suplement' => $suplement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:1,0'
        ];

        $messages = [
            'name.required' => 'O nome do suplemento é obrigatório.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'status.required' => 'O estado é obrigatório.',
            'status.in' => 'O estado deve ser 1 (Disponível) ou 0 (Indisponível).'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suplement = Suplement::findOrFail($id);
        $suplement->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status
        ]);

        return redirect()->route('suplementos.index')->with('success', 'Suplemento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function updateStatus(Request $request, $id)
    {
        $suplement = Suplement::find($id);

        if (!$suplement) {
            return redirect()->route('suplementos.index')->with('error', 'Suplemento não encontrado.');
        }

        // Alterna o status entre 1 (disponível) e 0 (indisponível)
        $suplement->status = $suplement->status == Suplement::STATUS_AVAILABLE ? Suplement::STATUS_UNAVAILABLE : Suplement::STATUS_AVAILABLE;
        $suplement->save();

        return redirect()->route('suplementos.index')->with('success', 'Status do suplemento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $suplement = Suplement::find($id);

        if (!$suplement) {
            abort(404);
        }

        $suplement->delete();

        return redirect()->route('suplement.index')->with('success', 'Suplemento excluído com sucesso!');
    }
}
