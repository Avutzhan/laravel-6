<?php

namespace App\Http\Controllers;

use App\Example;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index()
    {
        ddd(resolve('App\Example'), resolve('App\Example'));
    }
}
