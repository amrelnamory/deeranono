<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Contract;

class WelcomeController extends Controller
{
    // Index
    public function index()
    {      
        return view('dashboard.welcome');
     }
    // End of Index
}
