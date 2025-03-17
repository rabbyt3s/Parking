<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileAttente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FileAttenteController extends Controller
{
    public function index(): View
    {
        $fileAttente = FileAttente::with('user')
            ->orderBy('position')
            ->get();
        return view('admin.file-attente.index', compact('fileAttente'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|integer|min:1',
        ]);

        FileAttente::create($request->all());

        return redirect()->route('admin.file-attente.index')
            ->with('success', 'L\'utilisateur a été ajouté à la file d\'attente avec succès.');
    }

    public function destroy(FileAttente $fileAttente): RedirectResponse
    {
        $fileAttente->delete();

        return redirect()->route('admin.file-attente.index')
            ->with('success', 'L\'utilisateur a été retiré de la file d\'attente avec succès.');
    }
}
