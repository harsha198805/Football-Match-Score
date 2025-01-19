<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Football Score</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .update-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
            text-align: left;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .status {
            font-size: 14px;
            margin-bottom: 20px;
            color: #333;
            text-align: left;
        }

        .error-message {
            color: #d9534f;
        }

        .success-message {
            color: #28a745;
        }

        @media (max-width: 600px) {
            .update-container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            input[type="number"], select, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="update-container">
        <h1>Update Football Score</h1>

        <!-- Display any success or error messages -->
        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        @if($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <!-- Score Update Form -->
        <form action="{{ route('score.update') }}" method="POST">
            @csrf

            <div class="input-group">
                <label for="team_a_score">Team A Score</label>
                <input type="number" id="team_a_score" name="team_a_score"  value="0" min="0" required>
            </div>

            <div class="input-group">
                <label for="team_b_score">Team B Score</label>
                <input type="number" id="team_b_score" name="team_b_score"  value="0" min="0" required>
            </div>

            <div class="input-group">
                <label for="status">Match Status</label>
                <select id="status" name="status" required>
                    <option value="not_started" {{ $score['status'] == 'not_started' ? 'selected' : '' }}>Not Started</option>
                    <option value="in_progress" {{ $score['status'] == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $score['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit">Update Score</button>
        </form>
    </div>

</body>
</html>
