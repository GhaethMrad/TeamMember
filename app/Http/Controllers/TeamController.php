<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Exception;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Team::class);
        $teams = Team::all();
        return view('frontend.team.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Team::class);
        return view('frontend.team.create', ['users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamStoreRequest $request)
    {
        try {
            $this->authorize('create', Team::class);
            $team = Team::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($request->has('user_ids')) {
                User::whereIn('id', $request->user_ids)->update(['team_id' => $team->id]);
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
        $this->authorize('view', $team);
        return view('frontend.team.show', ['team' => $team]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $this->authorize('update', $team);
        return view('frontend.team.edit', ["team" => $team, "users" => User::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        try {
            $this->authorize('update', $team);
            $team->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            User::where('team_id', $team->id)->update(['team_id' => null]);

            if ($request->has('user_ids')) {
                User::whereIn('id', $request->user_ids)->update(['team_id' => $team->id]);
            }
            return redirect()->route('team.index')->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->route('team.edit', $team->id)->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);
        $team->delete();
        return redirect()->route('team.index')->with('status', 'done');
    }

    /**
     * The user leaves the team.
     */
    public function leave_user($user_id) {
        $user = User::find($user_id);
        $user->team_id = null;
        $user->save();
        return redirect()->route('team.index')->with('status', 'done');
    }

    /**
     * The user join the team.
     */
    public function join_user(Team $team, User $user) {
        $user->team_id = $team->id;
        $user->save();
        return redirect()->route('team.index')->with('status', 'done');
    }
}
