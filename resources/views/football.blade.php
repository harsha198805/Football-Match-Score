<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Football Score</title>
    <style>
        #score {
            font-size: 2em;
            margin: 20px;
        }
        #status {
            font-size: 1.5em;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Football Match Score</h1>
    <div id="score">
        <span>Team A: {{$score['teamA']??0}}</span> - <span>Team B:  {{$score['teamB']??0}}</span>
    </div>

    <div id="status">
        Match Status: <span> {{$score['status']??0}}</span>
    </div>

    <!-- Include Pusher JavaScript library -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
        // Initialize Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher('local', {
            wsHost: window.location.hostname,
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
        });

        // Subscribe to the football score channel
        var channel = pusher.subscribe('football-score');
        channel.bind('score-updated', function(data) {
            document.querySelector('#score').innerHTML = `Team A: ${data.teamA} - Team B: ${data.teamB}`;
            document.querySelector('#status').innerHTML = `Match Status: ${data.status}`;
        });
    </script>
</body>
</html>
