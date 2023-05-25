<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="AnupJungThapa_2332269_weather.css">
</head>

<body>

    <div class="container">
        <div class="content1">
            <h2><span id="currentTime"></span></h2>
            <div class="search">

                <input id="city-name" name="city_name" type="search" placeholder="Enter a location for Weather">
                <button  type="submit" name="submit"  >Search</button>
            </div>
            <h2><span id="daydate"></span></h2>
            
        </div>

        <div class="content">

            <div class="box1">
                
                <h1><span id="city"></span>,<span id="country"></span></h1>
                <div class="temp_value">
                <h2><span id="temp"></span>&deg;C</h2>
                <img src="https://assets.materialup.com/uploads/d4fefb76-885c-4a76-a1a2-501afa8568cb/preview" width="80">
            </div>
                <div class="extra">
                    <div class="pressure">
                        <h3>Pressure:<br><span id="pressure"></span><span>hpa</span></h3>
                    </div>
                
                <div class="windspeed">
                    <h3>WindSpeed:<br><span id="wind"></span><span>meter/sec</span></h3>
                </div>
                <div class="humidity">
                    <h3 id="Humidity">Humidity:<br><span id="humid"></span><span>%</span></h3>
                </div>
            </div>
        </div>
        
        <div class="box2">

            
            <img id="image-icon"  alt="">
            <h2 id="weathercondition"></h2>
        </div>
    </div>
    </div>
    <div class="past" style="display: flex;justify-content: center;">
    <button style="width: 250px,font-weight:bold;"><a href="pastweather.php">Click for Weather of past seven days</a></button>
    </div>
    <script src="local.js"></script>
</body>

</html>