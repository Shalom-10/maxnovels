<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = 'styles/loader.css'><x-head /> <script src = 'scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel = 'stylesheet' href = 'styles/variables.css'>
    <link rel = 'stylesheet' href = 'styles/flash_card.css'>
    <link rel = 'stylesheet' href = 'styles/login.css'>

    <script src = 'scripts/general.js' defer></script>
    <script src = 'scripts/signup.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader />
    <div class = 'wrapper flex-row full-w'>


        <div class = 'left full-h p-rel p-2'>

            <h1><span>Welcome</span> to Maxnovels</h1>

            <p>
                enjoy our collection of books, get inspired, inspire a generation
            </p>

            <form method = 'POST'>
                @csrf
                <div class = 'input flex-col'>
                    <label>First Name</label>
                    <input type="text" name='first_name' placeholder="Jhon" value = '{{old('first_name')}}'>
                </div>

                @error('first_name')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror


                <div class = 'input flex-col'>
                    <label>Last Name</label>
                    <input type="text" name='last_name' placeholder="Stone" value = '{{old('last_name')}}'>
                </div>

                @error('last_name')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

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
                    <input type="password" name='re_password' placeholder="@confirm your password" >
                </div>

                @error('re_password')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror
                
                <div class = 'input flex-col'>
                    <label>Gender</label>
                    <select name = 'gender' value = '{{old('gender')}}'>
                        <option value = 'male'>Male</option>
                        <option value = 'female'>Female</option>
                    </select>
                </div>

                @error('gender')
                    <div class = 'error_message'>
                        <p>
                            {{$message}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col'>
                    <label>Date of Birth</label>
                    <div class = 'date-box'>

                        <div class = 'year'>
                        </div>
    
                        <div class = 'month'>

                            <select id='month' name='month' value = '{{old('month')}}'>
                                <option>Month</option>
                                <option value='01'>January</option>
                                <option value='02'>February</option>
                                <option value='03'>March</option>
                                <option value='04'>April</option>
                                <option value='05'>May</option>
                                <option value='06'>June</option>
                                <option value='07'>July</option>
                                <option value='08'>August</option>
                                <option value='09'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>

                        </div>
    
                        <div class = 'day'>
                        </div>
                    </div>
                </div>

                @error('year')
                    <div class = 'error_message'>
                        <p>
                            
                            please select your year of birth
                            {{-- {{$message}} --}}
                        </p>
                    </div>
                @enderror

                @error('month')
                    <div class = 'error_message'>
                        <p>
                            please select your month of birth
                            {{-- {{$message}} --}}
                        </p>
                    </div>
                @enderror

                @error('day')
                    <div class = 'error_message'>
                        <p>
                            please select your day of birth
                            {{-- {{$message}} --}}
                        </p>
                    </div>
                @enderror

                <div class = 'input flex-col'>
                    <button type = 'submit' name = 'submit'>
                        Sign up
                    </button>

                    <span class = 'text-center'>Already have an account <a href = "/login">Log in</a></span>

                    <button class = 'facebook' name = 'facebook' onclick = 'event.preventDefault(); location.href = "/auth/facebook";'>
                        <span>Sign up with Facebook</span>
                        <i class = 'bi bi-facebook'></i>
                    </button>

                    <button class = 'google' name = 'google' onclick = 'event.preventDefault(); location.href = "/auth/google";'>
                        <span>Sign up with Google</span>
                        <i class = 'bi bi-google'></i>
                    </button>
                </div>


                
            </form>

        </div>


        <div class = 'right full-h p-rel'>
            <div class = 'bg p-abs full-hw top-left z-1'>
                <img src = '/images/signup.jpg' class = 'obj-fit'>
            </div>

            <div class = 'overlay p-abs full-hw top-left z-2'>

            </div>
        </div>
    </div>

    <x-flash_card />
</body>
