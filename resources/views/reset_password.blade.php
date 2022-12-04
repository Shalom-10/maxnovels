<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '/styles/loader.css'><x-head /> <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/login.css'>
    <link rel = 'stylesheet' href = '/styles/oauth.css'>

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/signup.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader />

    <div class = 'wrapper flex-col flex-center'>
        <div class = 'top text-center'>
            <h1>Reset Password</h1>
            <p>Please provide your email address and submit the form, you would recieve an email with the password reset link.</p>
        </div>
        <form method = 'POST' class = 'input_box'>
            @csrf 
            <div class = 'input flex-col'>
                <label>Email Address</label>
                <input type="text" name='email' placeholder="emailmonger@gmail.com" value = '{{old('email')}}'>
            </div>

            @error('email')
                <div class = 'error_message'>
                    <p>
                        {{$message}}
                    </p>
                </div>
            @enderror

            <div class = 'input flex-col'>
                <label>Password</label>
                <input type="password" name='password' placeholder="@veryHardP@ssword">
            </div>

            @error('password')
                <div class = 'error_message'>
                    <p>
                        {{$message}}
                    </p>
                </div>
            @enderror

            <div class = 'input flex-col'>
                <label>Repeat Password</label>
                <input type="password" name='password_confirmation' placeholder="@confirm your password" >
            </div>

            @error('re_password')
                <div class = 'error_message'>
                    <p>
                        {{$message}}
                    </p>
                </div>
            @enderror

            <input type = 'hidden' name='token' value = '{{$token}}'>

            <button type = 'submit' name = 'submit' class = 'full-w'>
                Reset Password
            </button>
        </form>
    </div>
</body>

<style>
    h1 {
        font-size: 320%;
        padding: 0;
        line-height: 1
    }
    p {
        font-family: "Poppins", sans-serif; 
        padding: .5rem 0; 
        width: 520px; 
        font-size: 90%;
        padding-bottom: 0;
    }
    @media only screen and (max-width: 550px) {
        p {
            width: 100%;
            padding: 1rem;
            font-size: 70%;
        }

        h1 {
            font-size: 210%;
        }
    }
