<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::all();
        return response()->json([
            'status' => (count($teams) > 0) 
            ? 'OK' 
            : 'Not Found' , 
            'teams' => $teams
        ], count($teams) > 0 ? 200 : 404);
    }
    public function show($id) {
        $team = Team::find($id);
        return response()->json([
            'status' => $team ? 'OK' : 'Not Found', 
            'team' => $team
        ], $team ? 200 : 404);
    }
}
