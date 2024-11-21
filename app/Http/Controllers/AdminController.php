<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CustomLog;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{

    protected $custom_log;

    public function __construct(CustomLog $custom_log)
    {
        $this->custom_log = $custom_log;
    }
    public function index()
    {
        // Busca todos os administradores no banco de dados
        $admins = Admin::paginate(10); // Paginação de 10 administradores por página

        // Retorna a view com os dados dos administradores
        return view('auth.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('auth.admin.createAdmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->custom_log->create([
            'descricao' => 'Admin criado: ' . $admin->name,
            'operacao' => 'create',
            'admin_id' => auth()->guard('admin')->id(),
        ]);


        event(new Registered($admin));

        Auth::login($admin);

        return redirect('/create-admin');

    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        $results = Admin::where(function($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->paginate(10)->appends(['search' => $search]); // Adicionando o parâmetro de busca à paginação

        return view('auth.admin.searchAdmin', compact('results'));

    }

    public function edit($id)
    {

        $admin = Admin::all()->find($id);
        return view('auth.admin.editAdmin', compact('admin'));
    }

    public function update(Request $request, $id)
    {

        // Busca o administrador pelo ID
        $admin = Admin::findOrFail($id);
        $oldData = $admin->toArray();
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id, // Ignora o e-mail do próprio admin
            'password' => 'nullable|string|min:6', // Senha opcional
        ]);

        // Atualização dos dados
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');

        // Se a senha for fornecida, atualiza a senha
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        $newData = $admin->toArray();
        $this->logChanges($oldData, $newData, 'update', $admin->id);

        return redirect()->route('create-admin.index')->with('success', 'Admin atualizado com sucesso!');
    }


    public function destroy($id)
    {
        if (request()->has('_token')){
            $admins = Admin::findOrFail($id);
            $adminName = $admins->name;
            $admins->delete();

            $this->custom_log->create([
                'descricao' => 'Admin excluído: ' . $adminName,
                'operacao' => 'Deletar',
                'admin_id' => auth()->guard('admin')->id(),
            ]);
            return redirect()->route('create-admin.index')->with('success', 'Admin apagado com sucesso!');
        }else{
            return redirect()->route('create-admin.index');
        }
    }

    public function showLoginForm()
    {
        return view('auth.admin.adminLogin'); // Retorna a view de login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    private function logChanges($oldData, $newData, $operacao, $adminId = null)
    {
        $logs = [];

        // Remover campos indesejados dos dados
        unset($oldData['updated_at'], $newData['updated_at']);

        foreach ($newData as $key => $value) {
            if (array_key_exists($key, $oldData) && $oldData[$key] != $value) {
                // Monta a string no formato: "campo: De: X, Para: Y"
                $logs[] = "$key: De: {$oldData[$key]}, Para: $value";
            }
        }

        if (!empty($logs)) {
            // Concatena os logs em uma única string
            $descricao = implode("; ", $logs);

            // Grava o log no banco de dados
            $this->custom_log->create([
                'descricao'   => $descricao,
                'operacao'    => $operacao,
                'admin_id'    => auth()->guard('admin')->id(),
            ]);
        }
    }

}
