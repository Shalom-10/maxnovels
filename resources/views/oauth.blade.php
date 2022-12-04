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
            <h1>Additional Details</h1>
        </div>
        <form method = 'POST' class = 'input_box'>
            @csrf 
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

            <button type = 'submit' name = 'submit' class = 'full-w'>
                Done
            </button>
        </form>
    </div>
</body>
