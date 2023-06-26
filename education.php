<!DOCTYPE html>
<html>

<head>
    <title>Insert Page</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #283E4A;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .main-button {
            text-align: center;
            margin-top: 20px;
        }

        .main-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #283E4A;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Education Form</h1>
        <form action="education_database.php" method="POST">
            <div class="form-group">
                <label for="institution">Institution:</label>
                <input type="text" id="institution" name="institution[]" required>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification[]" required>
            </div>
            <div class="form-group">
                <label for="field">Field of Study:</label>
                <input type="text" id="field" name="field[]" required>
            </div>
            <div class="form-group">
                <label for="graduation">Graduation:</label>
                <input type="text" id="graduation" name="graduation[]" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <div class="main-button">
        <a href="user_form.php">Main Page</a>
    </div>

</body>

</html>