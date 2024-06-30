<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

use App\TravelSuplement;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('viagem.dataViagens');
    }
    public function showForm()
    {
        return view('viagem.startViagem');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'idTravel' => 'required',
            'idSuplements' => 'required',
        ]);

        // Criar um novo objeto TravelSuplement com os dados validados
        $travelSuplement = new TravelSuplement([
            'idTravel' => $validatedData['idTravel'],
            'idSuplements' => $validatedData['idSuplements'],
        ]);

        // Salvar o objeto TravelSuplement no banco de dados
        $travelSuplement->save();

        // Redirecionar para a página de listagem de viagens com suplementos
        return redirect()->route('travel-suplements.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travel $travel)
    {
        // Validar os dados recebidos do formulário
        $validatedData = $request->validate([
            'idTravel' => 'required',
            'idSuplements' => 'required',
        ]);

        // Buscar o registro de TravelSuplement com o ID fornecido
        $travelSuplement = TravelSuplement::find($request->input('id')); // Use TravelSuplement model's id attribute

        // Verificar se o registro foi encontrado
        if ($travelSuplement) {
            // Atualizar os dados do objeto TravelSuplement com os dados validados
            $travelSuplement->idTravel = $validatedData['idTravel'];
            $travelSuplement->idSuplements = $validatedData['idSuplements'];

            // Salvar as alterações no banco de dados
            $travelSuplement->save();

            // Redirecionar para a página de detalhes do TravelSuplement atualizado
            return redirect()->route('travel-suplements.show', ['id' => $travelSuplement->id]); // Define this route in routes/web.php
        } else {
            // Caso contrário, retornar um erro 404
            return abort(404);
        }
    }




    public function displayform()
    {
        // Lógica para exibir o formulário de criação de tarifas
        return view('tariffs.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        //
    }
}
