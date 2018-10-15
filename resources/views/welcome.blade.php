<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fooseball</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="modal-body">
            <form method="post" class="form-inline" id="matchform" onsubmit="return jq()">
                <p>Win = <strong>5 points</strong> Lose =<strong> -2 points</strong></p>
                    <input type="text" name="team1" id="team1" placeholder="Team 1 Name" > &nbsp;
                    <input type="text" name="team2" id="team2" placeholder="Team 2 Name" > &nbsp;
                    <input type="number" name="team1g" min="0" placeholder="Team 1 Goals" id="goal1" > &nbsp;
                    <input type="number" name="team2g" min="0" placeholder="Team 2 Goals" id="goal2" > &nbsp;
                    <input type="submit" name="submit" class="btn btn-success" data-dismiss="modal" value="Lets Play">
                    {{ csrf_field() }}
            </form>
        </div>
        <div class="container">
            <h3>Leaderboard -</h3>
        </div>
    @if($matches->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr class="table-danger">
                <th scope="col">#</th>
                <th scope="col">Team Name</th>
                <th scope="col">Games Played</th>
                <th scope="col">Wins</th>
                <th scope="col">Loss</th>
                <th scope="col">Ties</th>
                <th scope="col">Score</th>
                <th scope="col">Goals</th>
                <th scope="col">Goals For</th>
                <th scope="col">Goals Against</th>
            </tr>
            </thead>
            <tbody>
            @foreach($teams as $team)
                <tr>
                    <th scope="row">{{ $t++ }}</th>
                    <td>{{ $team->teamname }}</td>
                    <td>{{ $team->games }}</td>
                    <td>{{ $team->wins }}</td>
                    <td>{{ $team->loss }}</td>
                    <td>{{ $team->draws }}</td>
                    <td>{{ $team->points }}</td>
                    <td>{{ $team->goals }}</td>
                    <td>{{ $team->goalsf }}</td>
                    <td>{{ $team->goalsa }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    
    </div>
    <div class="container">
        <div class="container">
            <h3>Matches Played</h3>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr class="table-danger">
                <th scope="col">#</th>
                <th scope="col">Team 1 Name</th>
                <th scope="col">Team 2 Name</th>
                <th scope="col">Winner</th>
                <th scope="col">Team 1 Goals</th>
                <th scope="col">Team 2 Goals</th>
            </tr>
            </thead>
            <tbody>
            @foreach($matches as $match)
                <tr>
                    <th scope="row">{{ $m++ }}</th>
                    <td>{{ $match->team1 }}</td>
                    <td>{{ $match->team2 }}</td>
                    <td>{{ $match->winner }}</td>
                    <td>{{ $match->team1g }}</td>
                    <td>{{ $match->team2g }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <button class="btn btn-danger" onclick="window.location='{{ route("clear") }}'" type="button">Clear Leaderboard</button>
    </div>
@else
    <h3 class="col-md-offset-1">No Matches Played</h3>
@endif
<script>
    function jq() {
        var t1= $('#team1').val().trim();;
        var t2= $('#team2').val().trim();;
        if(t1 == t2){
            window.alert("Same Team Names!");
            return false;
        }
    };
</script>
</body>

</html>
