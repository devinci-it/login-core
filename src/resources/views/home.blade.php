{{-- Auto-generated from devinci-it/login-core --}}
{{-- File: resources/views/welcome.blade.php --}}

@include('header')
<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 70%;
        margin: 20px auto;
    }
    .container {
        display: flex;
        justify-content: flex-start;
        align-items: stretch;
        width: 80%;
        margin: 0 auto;
        gap:5px;
        align-content: stretch;
    }

</style>

<main>

    <div class="container">
        {{-- Info note --}}
        <div class="caption-text">
            <hr>

            This file is auto-generated from devinci-it/login-core.
            <hr>
            File Path: resources/views/welcome.blade.php
        </div>




        {{-- Add additional content --}}
        <h1 class="title-large-text">Welcome <b>{{ $username }}</b>
            <br/>
            Welcome to our site.</h1>
        <div class="subtitle-text">
            You have successfully logged in as <strong>{{ $username }}</strong>.
        </div>

        {{-- Blade directive to ensure user is logged in, else redirect to /logout --}}
        @auth
            <a href="/logout" class="btn input">Logout</a>
        @else
            @php
                // Redirect to /logout if user is not logged in
                header("Location: /logout");
                exit;
            @endphp
        @endauth

    </div>


</main>
<hr/>

</body>
</html>
