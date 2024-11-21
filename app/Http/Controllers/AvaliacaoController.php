<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{

public function index()
{
    $avaliacoes = Avaliacao::all();
    return view('avaliacao.index', compact('avaliacoes'));
}


    public function create()
    {
        return view('avaliacao.createAvaliacao');
    }


    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:255',
        ]);

        Avaliacao::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('success', 'Obrigado pela sua avaliação!');
    }
}
