<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord d'administration.
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
