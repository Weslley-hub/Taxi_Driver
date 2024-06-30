<?php

namespace App\Http\Controllers;

use App\Models\Supplies;
use Illuminate\Http\Request;

class SuppliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar todos os registros da tabela "supplies"
        $supplies = Supply::all();

        // Retornar a view com os dados dos suprimentos
        return view('supplies.index', ['supplies' => $supplies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'liters' => 'required',
            'price' => 'required',
            'km' => 'required',
            'idShift' => 'required'
        ]);

        // Criar um novo objeto Supply com os dados validados
        $supply = new Supply([
            'liters' => $validatedData['liters'],
            'price' => $validatedData['price'],
            'km' => $validatedData['km'],
            'idShift' => $validatedData['idShift']
        ]);

        // Salvar o objeto Supply no banco de dados
        $supply->save();

        // Redirecionar para a página de listagem de suprimentos
        return redirect()->route('supplies.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'liters' => 'required|numeric',
            'price' => 'required|numeric',
            'km' => 'required|numeric',
            'idShift' => 'required|exists:shifts,id'
        ]);

        // Criar um novo objeto Supply com os dados validados
        $supply = new Supply([
            'liters' => $validatedData['liters'],
            'price' => $validatedData['price'],
            'km' => $validatedData['km'],
            'idShift' => $validatedData['idShift']
        ]);

        // Salvar o objeto Supply no banco de dados
        $supply->save();

        // Redirecionar para a página de listagem de suprimentos
        return redirect()->route('supplies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplies $supplies)
    {
         // Buscar o registro correspondente na tabela "supplies"
         $supply = Supply::findOrFail($id);

         // Retornar a view com os dados do registro
         return view('supplies.show', ['supply' => $supply]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplies $supplies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplies $supplies)
    {
        // Buscar o registro correspondente na tabela "supplies"
        $supply = Supply::findOrFail($id);

        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'liters' => 'required|numeric',
            'price' => 'required|numeric',
            'km' => 'required|numeric'
        ]);

        // Atualizar os campos do registro com os dados validados
        $supply->liters = $validatedData['liters'];
        $supply->price = $validatedData['price'];
        $supply->km = $validatedData['km'];

        // Salvar as alterações no banco de dados
        $supply->save();

        // Redirecionar para a página de exibição do registro atualizado
        return redirect()->route('supplies.show', ['id' => $supply->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplies $supplies)
    {
        //
    }
}
