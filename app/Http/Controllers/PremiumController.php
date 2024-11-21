<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PremiumController extends Controller
{
    public function index()
    {
        $usuarios = User::paginate(10); // Paginar 10 usuários por página
        return view('premium.index', compact('usuarios'));
    }

    public function create()
    {
        return view('premium.createPremium');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class), // Validação de email único
            ],
            'situacao' => 'required|string|max:50',
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'O email informado já está em uso. Por favor, escolha outro.',
        ]);

        // Criação do usuário com fillable
        $usuario = User::create([
            'name' => $request->input('nome'),
            'email' => $request->input('email'),
            'situacao' => $request->input('situacao'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Redireciona com mensagem de sucesso
        return redirect()->route('usuario-premium.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        $results = User::where(function($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('situacao', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%");
        })
            ->paginate(10)->appends(['search' => $search]); // Adicionando o parâmetro de busca à paginação

        return view('premium.searchPremium', compact('results'));
    }

    public function edit($id)
    {
        $usuarios = User::all()->find($id);
        return view('premium.editPremium', compact('usuarios'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id, // Validação de email único
            'situacao' => 'required|string|max:50',
            'password' => 'nullable|string|min:6', // Senha opcional
        ]);

        // Busca o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Atualiza os campos
        $usuario->name = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->situacao = $request->input('situacao');

        // Se a senha for fornecida, atualiza a senha
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->input('password'));
        }

        // Salva as alterações no banco de dados
        $usuario->save();

        // Redireciona após a atualização
        return redirect()->route('usuario-premium.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (request()->has('_token')){
            $usuarios = User::findOrFail($id);
            $usuarios->delete();
            return redirect()->route('usuario-premium.index');
        } else {
            return redirect()->route('usuario-premium.index');
        }
    }
}
