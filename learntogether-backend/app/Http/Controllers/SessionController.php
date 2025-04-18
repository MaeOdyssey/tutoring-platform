<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); // pulled from Sanctum token
    
        $now = now(); // current datetime
        $sessions = Session::where('user_id', $user->id)
            ->whereDate('date', '>=', $now->toDateString())
            ->orderBy('date', 'asc')
            ->get();
    
        return response()->json($sessions);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
        ]);
        

        $session = Session::create([
            'user_id' => $request->user()->id,
            'date' => $validated['date'],
            'time' => $validated['time'],
            'status' => 'scheduled',
        ]);

        return response()->json($session, 201);
    }
}
