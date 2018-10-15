<?php

namespace App\Http\Controllers;

use App\Match;
use App\Team;
use Illuminate\Http\Request;

class MatchController extends Controller{

    public function addteam(Request $request){
//        $this -> validate($request, [
//            'roll' => 'required|unique:users',
//            'password' => 'required|min:4'
//        ]);
        $add = 5;
        $sub = -2;
        $team1 = trim($request->input('team1'));
        $team2 = trim($request->input('team2'));
        $team1g = $request->input('team1g');
        $team2g = $request->input('team2g');
        if($team1g == $team2g)
            $winner = 0;
        else if($team1g > $team2g)
            $winner = 1;
        else if($team1g < $team2g)
            $winner = 2;

        $team = Team::where('teamname', '=', $team1)->first();
        if ($team === null) {
            // team doesn't exist
            $team = new Team();
            $team->teamname = $team1;
            $team->games = 1;
            $team->wins = $winner == 1 ? 1 : 0;
            $team->loss = $winner == 2 ? 1 : 0;;
            $team->draws = $winner == 0 ? 1 : 0;;
            $team->points = $winner == 1 ? $add : $sub;
            $team->goalsf = $team1g;
            $team->goalsa = $team2g;
            $team->save();
        }
        else{
            $team->games += 1;
            $team->wins += $winner == 1 ? 1 : 0;
            $team->loss += $winner == 2 ? 1 : 0;;
            $team->draws += $winner == 0 ? 1 : 0;;
            $team->points += $winner == 1 ? $add : $sub;
            $team->goalsf += $team1g;
            $team->goalsa += $team2g;
            $team->update();
        }

        $team = Team::where('teamname', '=', $team2)->first();
        if ($team === null) {
            // team doesn't exist
            $team = new Team();
            $team->teamname = $team2;
            $team->games = 1;
            $team->wins = $winner == 2 ? 1 : 0;
            $team->loss = $winner == 1 ? 1 : 0;;
            $team->draws = $winner == 0 ? 1 : 0;;
            $team->points = $winner == 2 ? $add : $sub;
            $team->goalsf = $team2g;
            $team->goalsa = $team1g;
            $team->save();
        }
        else{
            $team->games += 1;
            $team->wins += $winner == 2 ? 1 : 0;
            $team->loss += $winner == 1 ? 1 : 0;;
            $team->draws += $winner == 0 ? 1 : 0;;
            $team->points += $winner == 2 ? $add : $sub;
            $team->goalsf += $team2g;
            $team->goalsa += $team1g;
            $team->update();
        }
        $match = new Match();
        $match->team1= $team1;
        $match->team2 = $team2;
        $match->winner = $winner;
        $match->team1g = $team1g;
        $match->team2g = $team2g;
        $match->save();
//        $tags = Tag::all();
        return redirect()->route('match.gaddteam');

    }

    public function gaddteam(){
        $teams = Team::all();
        $match = Match::all();

        return view('welcome', ['teams' => $teams, 'matches' => $match, 't' => 1, 'm' => 1, 'z' => 0]);
    }

    public function clear(){
        $teams = Team::truncate();
        $match = Match::truncate();
        return redirect()->route('match.gaddteam');
    }
}
