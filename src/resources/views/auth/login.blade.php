@include('header')

<!-- Main content for user login -->
    <main class="main-content" id="login-content">
        <div class="container">
            <div class="form-wrapper">
                <h2 class="title-medium-text">USER LOGIN</h2>
                <form action="/login" method="POST">
                    @csrf
                    <label class="caption-text dark">
                        <input placeholder="Username" class="input form-input" type="text" name="username" required>
                    </label>
                    <br>
                    <label class="caption-text dark">
                        <input placeholder="Password" type="password" class="input form-input" name="password" required>

                    </label>
                    <br>
                    <input class="btn submit-button" name="submit" type="submit" value="Login">
                </form>
                    <div class="link_wrapper flex">
                        <a class="caption-text dark" href="/register"> Register</a>
                        <a class="caption-text dark" href="#"> Forgot Password</a>
                    </div>
            </div>
        </div>
    </main>

</body>
</html>
