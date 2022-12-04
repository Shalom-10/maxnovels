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
        <div class = 'top'>
            <h1>Email Verification</h1>
            <p>
                Please check your email for the verification link
            </p>

            <div class = 'flex-row flex-center text-center'>
                <form method = "POST" action='/email/verification-notification'>
                    @csrf
                    <a href = '#' onclick="this.parentNode.submit();">Resend Verification link</a>
                </form>
                <a href = '#'>Log In</a>
            </div>
        </div>
    </div>
</body>

<style>
h1 {
    font-size: 370%;
    padding: 0;
    text-align: center;
    line-height: 1;
}

@media only screen and (max-width: 350px) {
    h1 {
        font-size: 300%;
    }
}

p , a{
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

p {
    padding: 1.5rem;
}

a {
    color: var(--electric);
    margin: 0 .5rem
}
</style>
