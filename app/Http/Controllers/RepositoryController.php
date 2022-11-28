<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use App\Http\Requests\RepositoryRequest;

class RepositoryController extends Controller
{
    public function index()
    {
        return view('repositories.index', [
            'repositories' => auth()->user()->repositories //Repositorios de los uduarios con relacion de tablas en los modelos
        ]);
    }

    public function create()
    {
        return view('repositories.create');
    }

    public function store(RepositoryRequest $request)
    {
        //Crear un repositorio para este usuario
        $request->user()->repositories()->create($request->all());

        return redirect()->route('repositories.index');
    }

    public function show(Repository $repository)
    {
        // if ($request->user()->id != $repository->user_id) {
        //     abort(403);
        // }

        $this->authorize('pass', $repository);

        return view('repositories.show', compact('repository'));
    }

    public function edit(Repository $repository)
    {
        // if ($request->user()->id != $repository->user_id) 
        // {
        //     abort(403);
        // }

        $this->authorize('pass', $repository);

        return view('repositories.edit', compact('repository'));
    }

    public function update(RepositoryRequest $request, Repository $repository)
    {
        // if ($request->user()->id != $repository->user_id) {
        //     abort(403);
        // }

        $this->authorize('pass', $repository);

        $repository->update($request->all());

        return redirect()->route('repositories.edit', $repository);
    }

    public function destroy( Repository $repository)
    {
        // if ($request->user()->id != $repository->user_id) {
        //     abort(403);
        // }

        $this->authorize('pass', $repository);

        $repository->delete();

        return redirect()->route('repositories.index');
    }
}
