<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Routing\Controller as BaseController;

class TeamController extends BaseController
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        $teams = Team::all();
        return view('frontend.team.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('frontend.team.create', ['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(TeamStoreRequest $request)
    {
        try {
            $team = Team::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($request->has('user_ids')) {
                 User::whereIn('id', $request->user_ids) ->update(['team_id' => $team->id]); 
            }

            return redirect()->route('team.index')->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->route('team.create')->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
    */
    public function show(Team $team)
    {
        return view('frontend.team.show', ['team' => $team]);
    }

    /**
     * Show the form for editing the specified resource.
    */
    public function edit(Team $team)
    {
        return view('frontend.team.edit', ["team" => $team, "users" => User::all()]);
    }

    /**
     * Update the specified resource in storage.
    */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        try {
            $team->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            User::where('team_id', $team->id)->update(['team_id' => null]);

            if ($request->has('user_ids')) {
                 User::whereIn('id', $request->user_ids) ->update(['team_id' => $team->id]); 
            }
            return redirect()->route('team.index')->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->route('team.edit')->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Team $team)
    {
        $team->deleteOrFail();
        return redirect()->route('team.index')->with('status', 'done');
    }
}
