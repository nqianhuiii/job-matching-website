<!DOCTYPE html>

<head>
    <title>Insert Page</title>
</head>

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

<body>
    <div class="container">
        <h1>Experience Form</h1>
        <form action="experience_database.php" method="POST">
            <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" id="jobTitle" name="jobTitle[]">
            </div>
            <div class="form-group">
                <label for="company">Company:</label>
                <input type="text" id="company" name="company[]">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description[]">
            </div>
            <div class="form-group">
                <label for="startYear">Start Year:</label>
                <input type="text" id="startYear" name="startyear[]">
            </div>
            <div class="form-group">
                <label for="endYear">End Year:</label>
                <input type="text" id="endYear" name="endyear[]">
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