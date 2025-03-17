<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentationController extends Controller
{
    /**
     * Affiche la documentation de l'application.
     */
    public function index(): View
    {
        return view('documentation.index');
    }
} 