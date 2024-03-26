@include('header')

<!-- Main content for user login -->
<main class="main-content" id="login-content">
    <div class="container">
        <div class="form-wrapper">
            <h2 class="title-medium-text">REGISTER</h2>
            <hr/>

    <form action="/register" method="POST">
        @csrf

        <input value="" class="input form-input" name="first_name" type="text" placeholder="First Name" required>
        <input value="" class="input form-input" name="last_name" type="text" placeholder="Last Name" required>
        <input value="" class="input form-input" name="email" type="email" placeholder="Email" required>
        <input value="" class="input form-input" name="username" type="text" placeholder="Username" required>
        <input value="" class="input form-input" name="password" type="password" placeholder="Password" required>
        <input value="" class="input form-input" name="password_confirmation" type="password" placeholder="Verify Password"
            required>

        <input type="submit" class="btn submit-button" name="signup" value="Register">
        <p class="caption-text" style="color: #ccc; margin-bottom: 10px; padding: 5px;">
            By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use.
        </p>
    </form>
        </div>
    </div>
</main>

