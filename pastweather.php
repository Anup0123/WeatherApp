<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="AnupJungThapa_2332269_weather.css">
</head>
<body>
    <!-- <script src="storage.php"></script> -->
</body>
</html>
<center>                
    <table border="2px" cellspacing="0" cellpadding="100px">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Weather_condition</th>
            <th>Temperature</th>
            <th>Pressure</th>
            <th>Humidity</th>
        </tr>
</center>
<?php
  include 'AnupJungThapa_2332269_connection.php';
  include 'currentweather.php';
$headers = @get_headers('http://www.google.com');
$is_connected = false;
if($headers && strpos($headers[0], '200') !== false) {
    $is_connected = true;
}


    $current_timestamp = time();
    if($is_connected) {
        if(isset($_GET['submit'])){
            if($_GET['city_name']){
                $cityname = $_GET['city_name'];
        
                // Check if the city already exists in the database
                $query = "SELECT * FROM information WHERE name='$cityname' ORDER BY id DESC LIMIT 7";
                $sql = mysqli_query($con, $query);
                $result = mysqli_num_rows($sql);
                echo '<h3>Weather of past 7 days of '.$cityname.':<br></h3>';
                if ($result) {
                    // If the city exists in the database, display data from the database
                    
                    ?>
                    <script>
                            console.log("Past seven days data of searched city is fetch from database")
                            </script>
                    <?php
                    while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                            <td>
                                <?php 
                                    echo $row['name'] 
                                ?>
                            </td>
                            <td>
                                <?php 
                                    echo $row['Date'] 
                                ?>
                            </td>
                            <td>
                                <?php echo $row['Weather_condition']?>
                            </td>
                            <td>
                                <?php echo $row['Temperature']."&degC" ?>
                            </td>
                            <td>
                                <?php echo $row['Pressure']."hpa" ?>
                            </td>
                            <td>
                                <?php echo $row['Humidity']."%" ?>
                            </td>
                        </tr> 
                        <?php
                    }
                } else {
                    // If the city does not exist in the database, fetch data from the API, store it in the database, and then display it
                    for ($i = 7; $i > 0; $i--) {
                        $start_timestamp = $current_timestamp - $i * 24 * 60 * 60;
                        $api_url = 'http://history.openweathermap.org/data/2.5/history/city?q='.$cityname.'&type=daily&start='.$start_timestamp.'&cnt=1&appid=8f213b47ee0f5480adbb81cdb22de4fc&units=metric';
                        $api_response = file_get_contents($api_url);
                        $api_data = json_decode($api_response, true);
                        $Date = date('Y-m-d',$start_timestamp);
                        $Weather_condition =$api_data['list'][0]['weather'][0]['main'];
                        $Temperature = $api_data['list'][0]['main']['temp'];
                        $Pressure=$api_data['list'][0]['main']['pressure'];
                        $Humidity=$api_data['list'][0]['main']['humidity'];
                        $query = "INSERT INTO information (name,Date, Weather_condition, Temperature,Pressure,Humidity) values 
                        ('$cityname','$Date','$Weather_condition','$Temperature','$Pressure','$Humidity')";
                        $sql = mysqli_query($con, $query);
                    }
                    ?>
                    <?php
                    // Display data from the database
                    $query = "SELECT * FROM information WHERE name='$cityname' ORDER BY id DESC LIMIT 7";
                    $sql = mysqli_query($con, $query);
                    $result = mysqli_num_rows($sql);
        
                    if ($result) {
                        ?>
                    <script>
                            console.log("Past seven days data of searched city is fetched, store in database and retrive from database")
                            </script>
                    <?php
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td>
                                    <?php 
                                        echo $row['name'] 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $row['Date'] 
                                    ?>
                                </td>
                                <td>
                                <?php echo $row['Weather_condition']?>
                            </td>
                            <td>
                                <?php echo $row['Temperature']."&degC" ?>
                            </td>
                            <td>
                                <?php echo $row['Pressure']."hpa" ?>
                            </td>
                            <td>
                                <?php echo $row['Humidity']."%" ?>
                            </td>
                    </tr> 
                    <?php
                        }
                    }
                }
                }
            }
            else{
 
                    //  else {
                        for ($i = 7; $i > 0; $i--) {
                            $start_timestamp = $current_timestamp - $i * 24 * 60 * 60;
                            $api_url = 'http://history.openweathermap.org/data/2.5/history/city?q=Lisburn,GB&type=daily&start='.$start_timestamp.'&cnt=1&appid=8f213b47ee0f5480adbb81cdb22de4fc&units=metric';
                            $api_response = file_get_contents($api_url);
                            $api_data = json_decode($api_response, true);
                            $name='Lisburn';
                            $Date = date('Y-m-d',$start_timestamp);
                            $Weather_condition =$api_data['list'][0]['weather'][0]['main'];
                            $Temperature = $api_data['list'][0]['main']['temp'];
                            $Pressure=$api_data['list'][0]['main']['pressure'];
                            $Humidity=$api_data['list'][0]['main']['humidity'];
                            $query = "Insert into information (name,Date, Weather_condition, Temperature,Pressure,Humidity) values ('$name','$Date','$Weather_condition',
                            '$Temperature','$Pressure','$Humidity')";
                            $sql = mysqli_query($con, $query);
                        }
                    
                        ?>
                        <?php
                        $query="Select * from information where name='Lisburn' ORDER BY id DESC LIMIT 7";
                        $sql = mysqli_query($con, $query);
                        $result = mysqli_num_rows($sql);
                        echo '<h3>Weather of past 7 days of Lisburn:<br></h3>';
                        if ($result) {
                            ?>
                    <script>
                            console.log("Past seven days data of assigned city is fetch from api, stored in database")
                            </script>
                    <?php
                            while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                <td>
                                        <?php 
                                        echo $row['name'] 
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        echo $row['Date'] 
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Weather_condition']?>
                                    </td>
                                    <td>
                                        <?php echo $row['Temperature']."&degC" ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Pressure']."hpa" ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Humidity']."%" ?>
                                    </td>
                            </tr> 
                            <?php
                }
            }
        // }
            }
        }
        else{
            if(isset($_GET['submit'])){
                if($_GET['city_name']){
                    $cityname = $_GET['city_name'];
            
                    // Check if the city already exists in the database
                    if($_GET['city_name']==$cityname){
                    $query = "SELECT * FROM information WHERE name='$cityname' ORDER BY id DESC LIMIT 7";
                    $sql = mysqli_query($con, $query);
                    $result = mysqli_num_rows($sql);
                    echo '<h3>Weather of past 7 days of '.$cityname.':<br></h3>';
                    if ($result) {
                        // If the city exists in the database, display data from the database
                        ?>
                    <script>
                            console.log("Past seven days data of searched city is fetch from database when wifi is off")
                            </script>
                    <?php
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td>
                                    <?php 
                                        echo $row['name'] 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        echo $row['Date'] 
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row['Weather_condition']?>
                                </td>
                                <td>
                                    <?php echo $row['Temperature']."&degC" ?>
                                </td>
                                <td>
                                    <?php echo $row['Pressure']."hpa" ?>
                                </td>
                                <td>
                                    <?php echo $row['Humidity']."%" ?>
                                </td>
                            </tr> 
                            <?php
                        }
                    } 
                }else {
                        // If the city does not exist in the database, fetch data from the API, store it in the database, and then display it
                        ?>
                        <tr>
                        <td>No internet connection to find data of new searched city</td>
                </tr>
                <?php
                }
            }
        }
        else{
            $query="Select * from information where name='Lisburn' ORDER BY id DESC LIMIT 7";
            $sql = mysqli_query($con, $query);
            $result = mysqli_num_rows($sql);
            echo '<h3>Weather of past 7 days of Lisburn:<br></h3>';
            if ($result) {
                ?>
                <script>
                        console.log("Past seven days data of assigned city is fetch from database when wifi is off")
                        </script>
                <?php
                while ($row = mysqli_fetch_array($sql)) {
                    
                    ?>
                    
                    <tr>
                    <td>
                            <?php 
                            echo $row['name'] 
                            ?>
                        </td>
                        <td>
                            <?php 
                            echo $row['Date'] 
                            ?>
                        </td>
                        <td>
                            <?php echo $row['Weather_condition']?>
                        </td>
                        <td>
                            <?php echo $row['Temperature']."&degC" ?>
                        </td>
                        <td>
                            <?php echo $row['Pressure']."hpa" ?>
                        </td>
                        <td>
                            <?php echo $row['Humidity']."%" ?>
                        </td>
                </tr> 
                <?php
                    }
                 } 
        }
    }
       ?>

