<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['name'] = 'Kandi Permana';
        $data['gender'] = 'male';

        return view('test', $data);
    }
}
