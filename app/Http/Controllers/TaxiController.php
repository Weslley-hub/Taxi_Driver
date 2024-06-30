<?php

namespace App\Http\Controllers;

use App\Models\Taxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxiController extends Controller
{
    public function index()
    {
        $taxis = Taxi::all();
        return view('taxi.dataTaxis', compact('taxis'));
    }

    public function showForm()
    {
        return view('taxi.formTaxis');
    }

    public function create()
    {
        return view('taxis.create');
    }

    public function store(Request $request)
    {
        // Definir as regras de validação
        $rules = [
            'plate' => 'required|regex:/^[A-Za-z0-9]{1,}-[A-Za-z0-9]{1,}-[A-Za-z0-9]{1,}$/i',
            'km_inicial' => 'required|numeric',
            'km_atual' => 'required|numeric|gte:km_inicial', // Verifica se km_atual é maior ou igual a km_inicial
            'estado' => 'required|in:0,1',
        ];

        // Definir as mensagens de erro
        $messages = [
            'plate.required' => 'A placa do táxi é obrigatória.',
            'plate.regex' => 'A placa do táxi deve estar no formato XX-XX-XX.',
            'km_inicial.required' => 'O quilômetro inicial é obrigatório.',
            'km_inicial.numeric' => 'O quilômetro inicial deve ser um número.',
            'km_atual.required' => 'O quilômetro atual é obrigatório.',
            'km_atual.numeric' => 'O quilômetro atual deve ser um número.',
            'km_atual.gte' => 'O quilômetro atual deve ser maior ou igual ao quilômetro inicial.',
            'estado.required' => 'O estado é obrigatório.',
            'estado.in' => 'O estado deve ser Ativo ou Inativo.',
        ];

        // Validar os dados do formulário
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Criar um novo objeto Taxi com os dados recebidos do formulário
        $taxi = new Taxi([
            'plate' => strtoupper($request->plate),
            'kmStart' => $request->km_inicial,
            'kmActual' => $request->km_atual,
            'status' => $request->estado,
        ]);
        // Salvar o objeto Taxi no banco de dados
        $taxi->save();

        // Redirecionar para a página de listagem de táxis
        return redirect()->route('taxi.index')->with('success', 'Táxi criado com sucesso!');
    }


    public function update(Request $request, $id)
    {
        // Definir as regras de validação
        $rules = [
            'plate' => 'required|regex:/^[A-Za-z0-9]{1,}-[A-Za-z0-9]{1,}-[A-Za-z0-9]{1,}$/i',
            'km_inicial' => 'required|numeric',
            'km_atual' => 'required|numeric',
            'estado' => 'required|in:0,1',
        ];

        // Definir as mensagens de erro
        $messages = [
            'plate.required' => 'A placa do táxi é obrigatória.',
            'plate.regex' => 'A placa do táxi deve estar no formato XX-XX-XX.',
            'km_inicial.required' => 'O quilômetro inicial é obrigatório.',
            'km_inicial.numeric' => 'O quilômetro inicial deve ser um número.',
            'km_atual.required' => 'O quilômetro atual é obrigatório.',
            'km_atual.numeric' => 'O quilômetro atual deve ser um número.',
            'estado.required' => 'O estado é obrigatório.',
            'estado.in' => 'O estado deve ser Ativo ou Inativo.',
        ];

        // Validar os dados do formulário
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Encontrar o táxi pelo ID
        $taxi = Taxi::findOrFail($id);

        // Atualizar os campos do táxi com os dados do formulário
        $taxi->update([
            'plate' => strtoupper($request->plate),
            'kmStart' => $request->km_inicial,
            'kmActual' => $request->km_atual,
            'status' => $request->estado,
        ]);

        // Redirecionar para a página de listagem de táxis com uma mensagem de sucesso
        return redirect()->route('taxis.index')->with('success', 'Táxi atualizado com sucesso!');
    }

    public function edit($id)
    {
        // Buscar o táxi pelo ID
        $taxi = Taxi::find($id);

        // Verificar se o táxi foi encontrado
        if (!$taxi) {
            // Se não encontrado, abortar com erro 404
            abort(404);
        }

        // Retornar a view de edição com os dados do táxi
        //return view('taxi.editTaxis', compact('taxi'));
    }
    public function updateStatus(Request $request, Taxi $taxi)
    {
        // Obter o status atual do táxi
        $status = $taxi->status;

        // Inverter o status
        $taxi->status = $status == 1 ? 0 : 1;

        // Salvar o táxi
        $taxi->save();

        // Redirecionar de volta para a página de listagem de táxis
        return redirect()->route('taxis.index')->with('success', 'Estado do táxi atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $taxi = Taxi::find($id);

        if (!$taxi) {
            abort(404);
        }

        $taxi->delete();

        return redirect()->route('taxis.index')->with('success', 'Táxi excluído com sucesso!');
    }
}
