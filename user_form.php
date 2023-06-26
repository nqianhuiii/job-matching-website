<!DOCTYPE html>
<html>

<head>
    <title>LinkedIn Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background-color: #283E4A;
        color: #fff;
        padding: 20px 0;
    }

    header h1 {
        font-size: 24px;
        text-align: center;
    }

    .profile-section {
        background-color: #fff;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profile-details h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .profile-details p {
        font-size: 16px;
        color: #777;
        margin-bottom: 10px;
    }

    .social-icons {
        margin-top: 20px;
    }

    .social-icons a {
        color: #555;
        text-decoration: none;
        font-size: 20px;
        margin-right: 10px;
    }

    .form-section {
        background-color: #fff;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #283E4A;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .button-group a {
        text-decoration: none;
    }

    .button-group button {
        padding: 10px 20px;
        background-color: #283E4A;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        margin-right: 10px;
    }

    .button-group button:hover {
        background-color: #47657D;
    }

    footer {
        background-color: #283E4A;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    footer p {
        font-size: 14px;
    }
</style>

<body>
    <header>
        <div class="container">
            <h1>Create your own profile</h1>
        </div>
    </header>

    <div class="profile-section">
        <div class="container">
            <form action="images_database.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="imageInput">Select Image:</label>
                    <input type="file" id="imageInput" name="image">
                </div>
                <div class="form-group">
                    <label for="imageTextInput">Describe yourself:</label>
                    <textarea name="image_text" id="imageTextInput" cols="40" rows="4"
                        placeholder="Enter your bio(less than 4 words)"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="upload">Upload</button>
                </div>
            </form>
        </div>
    </div>


    <div class="form-section">
        <div class="container">
            <h2>Edit Profile:</h2>
            <form action="profile_database.php" method="POST">
                <div class="about_section">
                    <div class="form-group">
                        <label for="fullNameInput">Full Name:</label>
                        <input type="text" id="fullNameInput" name="fullName">
                    </div>
                    <div class="form-group">
                        <label for="nationalityInput">Nationality:</label>
                        <input type="text" id="nationalityInput" name="nationality">
                    </div>
                    <div class="form-group">
                        <label for="residentialStatusInput">Residential Status:</label>
                        <input type="text" id="residentialStatusInput" name="residentialStatus">
                    </div>
                    <div class="form-group">
                        <label for="statusInput">Status:</label>
                        <input type="text" id="statusInput" name="status">
                    </div>
                    <div class="form-group">
                        <label for="specializationInput">Specialization:</label>
                        <input type="text" id="specializationInput" name="specialization">
                    </div>
                </div>

                <div class="social_section">
                    <div class="form-group">
                        <label for="facebookInput">Facebook:</label>
                        <input type="text" id="facebookInput" name="facebook">
                    </div>
                    <div class="form-group">
                        <label for="instagramInput">Instagram:</label>
                        <input type="text" id="instagramInput" name="instagram">
                    </div>
                    <div class="form-group">
                        <label for="linkedinInput">LinkedIn:</label>
                        <input type="text" id="linkedinInput" name="linkedin">
                    </div>
                    <div class="form-group">
                        <label for="githubInput">GitHub:</label>
                        <input type="text" id="githubInput" name="github">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Save</button>
                </div>
            </form>

            <hr>
            </hr>

            <div class="container">
                <div class="button-group">
                    <a href="experience.php"><button>Experience</button></a>
                    <a href="education.php"><button>Education</button></a>
                    <a href="display.php"><button>Display Profile</button></a>
                </div>
            </div>

        </div>
    </div>


    <footer>
        <div class="container">
            <p>&copy; 2023 My Profile. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>