<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Link to the CSS file from the package -->
    <link href="{{ asset('vendor/devinci/laravel-essentials/css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Main content for user login -->
    <main class="main-content" id="login-content">
        <div class="container">
            <div class="container login-container">
                <h2 class="body-medium-text">USER LOGIN</h2>
                <form action="/login" method="POST">
                    @csrf
                    <label class="caption-text">
                        Username: <input class="form-input" type="text" name="username" required>
                    </label>
                    <br>
                    <label class="caption-text">
                        Password:
                        <input type="password" class="form-input" name="password" required>
                    </label>
                    <br>
                    <input class="btn submit-button" name="submit" type="submit" value="Login">
                </form>
            </div>
        </div>
    </main>
</body>
</html>
