<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In & Sign Up</title>

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" class="sign-in-form" action="{{route('login')}}">
                    @csrf
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="bx bxs-user"></i>
                        <input type="text" placeholder="Email" name="email">
                    </div>
                    @error('email')
                        <div class="feedback-error">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="input-field">
                        <i class="bx bxs-lock-alt"></i>
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    @error('password')
                        <div class="feedback-error">
                            {{$message}}
                        </div>
                    @enderror
                    <input type="submit" value="Login" class="btn solid">
                </form>
                {{-- <form action="" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="bx bxs-user"></i>
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="input-field">
                        <i class="bx bxs-envelope"></i>
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="input-field">
                        <i class="bx bxs-lock-alt"></i>
                        <input type="password" placeholder="Password">
                    </div>
                    <input type="submit" value="Sign Up" class="btn solid">
                </form> --}}
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    {{-- <h3>New here ? </h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti quam quis rerum!</p> --}}
                    {{-- <button class="btn transparent" id="sign-up-btn">Sign up</button> --}}
                    <h3>Welcome to Parking Apps</h3>
                </div>
                <img src="{{ asset('img\login-img.svg') }}" class="image" alt="">
            </div>

            {{-- <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ? </h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti quam quis rerum!</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="{{ asset('img\login-img.svg') }}" class="image" alt="">
            </div> --}}
        </div>
    </div>

    <script src="{{ asset('assets\login.js') }}"></script>
</body>

</html>
