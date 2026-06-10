<?php

$weather = null;
$error = "";

if(isset($_POST['city']))
{
    $city = trim($_POST['city']);

    $url = "https://wttr.in/".$city."?format=j1";

    $response = @file_get_contents($url);

    if($response)
    {
        $data = json_decode($response,true);

        if(isset($data['current_condition'][0]))
        {
            $weather = [
                "city" => $city,
                "temp" => $data['current_condition'][0]['temp_C'],
                "humidity" => $data['current_condition'][0]['humidity'],
                "wind" => $data['current_condition'][0]['windspeedKmph'],
                "condition" => $data['current_condition'][0]['weatherDesc'][0]['value']
            ];
        }
        else
        {
            $error = "City not found!";
        }
    }
    else
    {
        $error = "Unable to fetch weather data.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>🌦 Weather App</h1>

    <p class="subtitle">
        Get Real-Time Weather Information Anywhere In The World 🌍
    </p>

    <form method="POST">

        <input
            type="text"
            name="city"
            placeholder="Enter City Name..."
            required>

        <button type="submit">
            🔍 Search
        </button>

    </form>

    <?php if($error!="") { ?>

        <div class="error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <?php if($weather) {

        $condition = strtolower($weather['condition']);

        if(strpos($condition,'sun') !== false || strpos($condition,'clear') !== false){
            $icon = "☀️";
        }
        elseif(strpos($condition,'cloud') !== false){
            $icon = "☁️";
        }
        elseif(strpos($condition,'rain') !== false){
            $icon = "🌧️";
        }
        elseif(strpos($condition,'storm') !== false){
            $icon = "⛈️";
        }
        elseif(strpos($condition,'snow') !== false){
            $icon = "❄️";
        }
        else{
            $icon = "🌤️";
        }

    ?>

        <div class="card">

            <div class="weather-icon">
                <?php echo $icon; ?>
            </div>

            <h2 class="city-name">
                📍 <?php echo htmlspecialchars($weather['city']); ?>
            </h2>

            <div class="temp-box">
                <?php echo $weather['temp']; ?>°C
            </div>

            <div class="weather-details">

                <div class="detail-box">
                    <h4>💧 Humidity</h4>
                    <p><?php echo $weather['humidity']; ?>%</p>
                </div>

                <div class="detail-box">
                    <h4>🌬 Wind</h4>
                    <p><?php echo $weather['wind']; ?> km/h</p>
                </div>

                <div class="detail-box">
                    <h4>☁ Condition</h4>
                    <p><?php echo $weather['condition']; ?></p>
                </div>

            </div>

        </div>

    <?php } ?>

    <div class="footer">
        ⚡ Powered By Weather API | Made With PHP ❤️
    </div>

</div>

</body>
</html>