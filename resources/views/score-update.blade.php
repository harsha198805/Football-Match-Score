
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Football Score</title>
    
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            width: 200px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Update Football Match Score</h1>
    @if(session('success'))
        <div class="error_mg" style="color: green; margin-top: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/score/update">
        @csrf <!-- This is necessary to avoid CSRF attacks in Laravel -->

        <div class="form-group">
            <label for="team_a_score">Team A Score:</label>
            <input type="number" id="team_a_score" name="team_a_score" value="0" min="0" required>
        </div>

        <div class="form-group">
            <label for="team_b_score">Team B Score:</label>
            <input type="number" id="team_b_score" name="team_b_score" value="0" min="0" required>
        </div>

        <div class="form-group">
            <label for="status">Match Status:</label>
            <select id="status" name="status" required>
                <option value="not_started">Not Started</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit">Update Score</button>
    </form>

    <!-- Optionally, you can add a link to view live football scores -->
    <br><br>
    <a href="/football">View Live Football Score</a>
    <script>
        setTimeout(function() {
            $(".error_mg").hide();
        }, 3000);
    </script>
</body>
</html>
