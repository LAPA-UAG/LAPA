<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;
use App\User;
use Validator;
use App\Http\Requests\DisciplinaRequest;

class DisciplinaController extends Controller
{

    // Model de disciplina adicionado ao controller para evitar uso estatico
    protected $disciplina;
    protected $user;

    public function __construct(Disciplina $disciplina, User $user)
    {
        $this->middleware('auth');
        $this->disciplina = $disciplina;
        $this->user = $user;
    }

    public function index() 
    {
        $registros = $this->disciplina->all();
        return view('auth.disciplinas.index', compact('registros'));
    }

    public function adicionar() 
    {
        $users = $this->user->all();
        return view('auth.disciplinas.adicionar', compact('users'));

    }

    public function salvar(DisciplinaRequest $request) 
    {
        $request->validated();

        $dados = $request->all();

        $this->disciplina->create($dados);

        return redirect()->route('auth.disciplinas');
    }

    public function editar($identifier) 
    {
        $registro = $this->disciplina->find($identifier);
        $users = $this->user->all();
        return view('auth.disciplinas.editar', compact('registro', 'users'));        

    }

    public function atualizar(DisciplinaRequest $request, $identifier)
    {
        $request->validated();

        $dados = $request->all();
        $this->disciplina->find($identifier)->update($dados);

        return redirect()->route('auth.disciplinas');
    }

    public function deletar($identifier)
    {
        $this->disciplina->find($identifier)->delete();
        return redirect()->route('auth.disciplinas');
    }
}
