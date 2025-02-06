<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        /* Style for success message */
        #alert-success {
            display: none;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Add New User</h2>
        </div>

        @if (session('success'))
            <div id="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; font-weight: bold; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Add User</button>
        </form>
        <a href="{{ route('users.index') }}" class="back-link">Back to User List</a>
    </div>

    <script>
        // Display the success message for a few seconds and then hide it
        @if(session('success'))
            setTimeout(function() {
                $('#alert-success').fadeOut();
            }, 5000);  // hide after 5 seconds
        @endif
    </script>
</body>
</html>



