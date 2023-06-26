<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333333;
    }

    .form {
        margin-top: 20px;
        text-align: center;
    }

    .form label {
        display: block;
        margin-bottom: 5px;
    }

    .form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #cccccc;
        border-radius: 3px;
        margin-bottom: 10px;
    }

    .form input[type="submit"] {
        background-color: #333333;
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>


<body>
    <div class="container">
        <h1>Dashboard</h1>

        <div class="form">
            <form action="dashboard_database.php" method="post">
                <label for="salary">Expected Monthly Salary:</label>
                <input type="text" id="salary" name="salary" placeholder="Enter your expected salary">

                <label for="location">Preferred Work Location:</label>
                <input type="text" id="location" name="location" placeholder="Enter your preferred location">

                <input type="submit" value="Save">
            </form>
        </div>
    </div>
</body>

</html>