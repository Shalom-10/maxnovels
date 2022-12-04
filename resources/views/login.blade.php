<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = 'styles/loader.css'><x-head /> <script src = 'scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel = 'stylesheet' href = 'styles/variables.css'>
    <link rel = 'stylesheet' href = 'styles/login.css'>

    <script src = 'scripts/general.js' defer></script>
    <script src = 'scripts/signup.js' defer></script>
</head>

<body class = 'colors pixels'>
    <div class = 'wrapper flex-row full-w'>

        <div class = 'left full-h p-rel p-2'>

            <h1><span>Welcome</span> Back</h1>

            <form method='POST'>
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

                <div class = 'input flex-col'>
                    <label>Password</label>
                    <input type="password" name='password' placeholder="@veryhardpassword">
                </div>

                @error('password')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col'>
                    <button type = 'submit' name = 'submit'>
                        Log in
                    </button>

                    <span class = 'text-center' style = 'padding-bottom: 0;'>Dont have an account? <a href = "/signup">Sign up</a></span>

                    <span class = 'text-center' style = 'padding: .75rem 0; padding-bottom: 1rem;'><a href = "/forgot-password" style = 'color: var(--blue);'>Forgot Password</a></span>


                    <button class = 'facebook' name = 'facebook' onclick = 'event.preventDefault(); location.href = "/auth/facebook";'>
                        <span>Log in with Facebook</span>
                        <i class = 'bi bi-facebook'></i>
                    </button>

                    <button class = 'google' name = 'google' onclick = 'event.preventDefault(); location.href = "/auth/google";'>
                        <span>Log in with Google</span>
                        <i class = 'bi bi-google'></i>
                    </button>
                </div>


                
            </form>

        </div>


        <div class = 'right full-h p-rel'>
            <div class = 'bg p-abs full-hw top-left z-1'>
                <img src = '/images/login.webp' class = 'obj-fit'>
            </div>

            <div class = 'overlay p-abs full-hw top-left z-2'>

            </div>
        </div>
    </div>
</body>
