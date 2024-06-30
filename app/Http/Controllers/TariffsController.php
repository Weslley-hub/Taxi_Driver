<?php

namespace App\Http\Controllers;

use App\Models\Tariffs;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\Return_;
// Remove the unused import statement
// use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class TariffsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Obter todas as tarifas do banco de dados
        $tariffs = Tariffs::all();

        // Retornar a view de listagem de tarifas com as tarifas obtidas
        return view('tarifa.formListaTarifas', compact('tariffs'));
    }




    public function displayform()
    {

        // Retornar a view de listagem de tarifas com as tarifas obtidas
        return view('tarifa.formTarifas');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Retornar a view de criação de tarifas
        return view('tarifa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $rules = [
            'weekDays' => 'required|array', // certifique-se de que weekDays é um array
            'hi' => 'required|date_format:H:i',
            'hf' => 'required|date_format:H:i|after:hi', // Hora final deve ser após a hora inicial
            'estado' => 'required',
            'precoHora' => 'required',
            'precoKm' => 'required',
            'nomeTarifas' => 'required',

        ];

        // Definir as mensagens de erro personalizadas
        $messages = [
            'hf.after' => 'A hora de fim deve ser posterior à hora de início.',
        ];

        // Validar os dados do formulário
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Definir as mensagens de erro personalizadas


        // Se a validação passar, continue com a lógica para criar o registro

        // Converter o array de dias da semana em uma string separada por espaços
        $weekDays = implode($request->weekDays);


        // Criar uma nova tarifa com os dados recebidos do formulário
        $tariff = new Tariffs([
            'diasSemana' => $weekDays,
            'timeStart' => $request->hi,
            'timeFinish' => $request->hf,
            'status' => $request->estado,
            'valorPriceHour' => $request->precoHora,
            'valorPriceKm' => $request->precoKm,
            'name' => $request->nomeTarifas,
        ]);

        // Salvar a nova tarifa no banco de dados
        $tariff->save();

        // Redirecionar o usuário para a página de listagem de tarifas
        return redirect()->route('formListaTarifas')->with('success', 'Tarifa criada com sucesso!');
    }
    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        // Obter a tarifa com o ID especificado do banco de dados
        $tariff = Tariffs::find($id);

        // Verificar se a tarifa foi encontrada
        if (!$tariff) {
            // Se a tarifa não foi encontrada, retornar um erro 404
            abort(404);
        }

        // Retornar a view de exibição da tarifa com a tarifa obtida
        return view('tariffs.show', ['tariff' => $tariff]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar a tarifa com o ID especificado no banco de dados
        $tariff = Tariffs::find($id);

        // Verificar se a tarifa foi encontrada
        if (!$tariff) {
            // Se a tarifa não foi encontrada, retornar um erro 404
            abort(404);
        }

        // Retornar a view de edição de tarifas com os dados da tarifa
        return view('tarifa.create', compact('tariff'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encontrar a tarifa existente pelo ID
        $tariff = Tariffs::findOrFail($id);

        // Definir as regras de validação
        $rules = [
            'weekDays' => 'required|array', // certifique-se de que weekDays é um array
            'hi' => 'required|date_format:H:i',
            'hf' => 'required|date_format:H:i|after:hi', // Hora final deve ser após a hora inicial
            'estado' => 'required',
            'precoHora' => 'required',
            'precoKm' => 'required',
            'nomeTarifas' => 'required',
        ];

        // Definir as mensagens de erro personalizadas
        /* $messages = [
            'hf.after' => 'A hora de fim deve ser posterior à hora de início.',
        ]; */

        // Validar os dados do formulário
        /* $validator = Validator::make($request->all(), $rules, $messages);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } */

        // Atualizar os campos da tarifa existente com os dados recebidos do formulário
        $tariff->diasSemana = implode(' ', $request->weekDays);
        $tariff->timeStart = $request->hi;
        $tariff->timeFinish = $request->hf;
        $tariff->status = $request->estado;
        $tariff->valorPriceHour = $request->precoHora;
        $tariff->valorPriceKm = $request->precoKm;
        $tariff->name = $request->nomeTarifas;

        // Salvar as alterações no banco de dados
        $tariff->save();

        // Redirecionar o usuário para a página de exibição da tarifa atualizada
        return redirect()->route('formListaTarifas')->with('success', 'Tarifa atualizada com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus(Request $request, $id)
    {
        $tariff = Tariffs::find($id);

        if (!$tariff) {
            return redirect()->route('formListaTarifas')->with('error', 'Tarifa não encontrada.');
        }

        // Alterna o status entre 'ativo' e 'inativo'
        $tariff->status = $tariff->status == 'ativo' ? 'inativo' : 'ativo';
        $tariff->save();

        return redirect()->route('formListaTarifas')->with('success', 'Status da tarifa atualizado com sucesso!');
    }
}
