<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Time;

class TimeController extends Controller
{
    private $time;

    public function __construct()
    {
        $this->middleware('auth');
        $this->time = new Time;
    }

    public function index()
    {
        return view('admin.times');
    }
}