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
            <h1>Forgot Password</h1>
            <p>Please provide your email address and submit the form, you would recieve an email with the password reset link.</p>
        </div>
        <form method = 'POST' class = 'input_box'>
            @csrf 
            <div class = 'input flex-col'>
                <label>Email Address</label>
                <input type="text" name='email' placeholder="emallmonger@gmail.com">
            </div>

            @error('email')
                <div class = 'error_message'>
                    <p>
                        {{$message}}
                    </p>
                </div>
            @enderror

            <button type = 'submit' name = 'submit' class = 'full-w'>
                Send Email
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
