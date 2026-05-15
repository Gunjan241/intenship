<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
</head>
<body>

    <h2>BMI Calculator</h2>

    <label>Weight (kg):</label>
    <input type="number" id="weight"><br><br>

    <label>Height (meter):</label>
    <input type="number" id="height" step="0.01"><br><br>

    <button onclick="calculateBMI()">Calculate BMI</button>

    <h3 id="result"></h3>

    <script>
        function calculateBMI() {

            let weight = document.getElementById("weight").value;
            let height = document.getElementById("height").value;

            let bmi = weight / (height * height);

            document.getElementById("result").innerHTML =
                "Your BMI is: " + bmi.toFixed(2);

        }
    </script>

</body>
</html>
