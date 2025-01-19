<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Football Score</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #score-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .team {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .team-name {
            font-size: 18px;
            color: #444;
        }

        .team-score {
            font-size: 32px;
            color: #444;
            font-weight: bold;
        }

        #status {
            font-size: 18px;
            color: #28a745;
            margin-top: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            .team-score {
                font-size: 28px;
            }

            .team-name {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div id="score-container">
        <h1>Live Football Score</h1>

        <!-- Display Initial Score from Database -->
        <div class="team">
            <div class="team-name">Team A</div>
            <div class="team-score" id="team-a-score">{{$score['teamA']??0}}</div>
        </div>
        <div class="team">
            <div class="team-name">Team B</div>
            <div class="team-score" id="team-b-score">{{$score['teamB']??0}}</div>
        </div>

        <!-- Display Match Status -->
        <div id="status">Match Status: <span id="match-status">{{$score['status']??0}}</span></div>
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

        // Bind to the 'score-updated' event
        channel.bind('score-updated', function(data) {
            // Update the score dynamically on the page
            document.querySelector('#team-a-score').innerHTML = data.teamA;
            document.querySelector('#team-b-score').innerHTML = data.teamB;

            // Update the match status
            document.querySelector('#match-status').innerHTML = data.status.charAt(0).toUpperCase() + data.status.slice(1);
        });

        // Handle connection errors
        pusher.connection.bind('error', function(err) {
            console.error('Error:', err);
            document.querySelector('#status').innerHTML = 'Error: Connection Failed';
        });
    </script>
</body>
</html>
