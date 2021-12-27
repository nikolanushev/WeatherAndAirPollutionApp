<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cityStyle.css">
    <title>Weather App</title>
</head>

<body>
    <p style="text-align: center;" class="weathermap">
        <a class="pollution" href="/">Back to Weather Map</a>
    </p>
    <div class="container">
        <div class="current-info">

            <div class="date-container">
                <div class="time" id="time">
                    12:30 <span id="am-pm">PM</span>
                </div>
                <div class="date" id="date">
                    Monday, 25 May
                </div>

                <div class="others" id="current-weather-items">


                </div>
            </div>

            <div class="place-container">
                <div class="time-zone" id="time-zone"></div>
                <div id="country" class="country"></div>
            </div>
        </div>


    </div>

    <div class="future-forecast">
        <div class="today" id="current-temp">
            <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
            <div class="other">
                <div class="day">Monday</div>
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>
        </div>

        <div class="weather-forecast" id="weather-forecast">
            <div class="weather-forecast-item">
                <div class="day">Tue</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>
            <div class="weather-forecast-item">
                <div class="day">Wed</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>
            <div class="weather-forecast-item">
                <div class="day">Thur</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>
            <div class="weather-forecast-item">
                <div class="day">Fri</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>
            <div class="weather-forecast-item">
                <div class="day">Sat</div>
                <img src="http://openweathermap.org/img/wn/10d@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Night - 25.6&#176; C</div>
                <div class="temp">Day - 35.6&#176; C</div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
    const timeEl = document.getElementById('time');
    const dateEl = document.getElementById('date');
    const currentWeatherItemsEl = document.getElementById('current-weather-items');
    const timezone = document.getElementById('time-zone');
    const countryEl = document.getElementById('country');
    const weatherForecastEl = document.getElementById('weather-forecast');
    const currentTempEl = document.getElementById('current-temp');


    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const API_KEY = 'c05deb87eec71a176c0f1a51024a6933';

    setInterval(() => {
        const time = new Date();
        const month = time.getMonth();
        const date = time.getDate();
        const day = time.getDay();
        const hour = time.getHours();
        const hoursIn12HrFormat = hour >= 13 ? hour % 12 : hour
        const minutes = time.getMinutes();
        const ampm = hour >= 12 ? 'PM' : 'AM'

        timeEl.innerHTML = (hoursIn12HrFormat < 10 ? '0' + hoursIn12HrFormat : hoursIn12HrFormat) + ':' + (
            minutes < 10 ? '0' + minutes : minutes) + ' ' + `<span id="am-pm">${ampm}</span>`

        dateEl.innerHTML = days[day] + ', ' + date + ' ' + months[month]

    }, 1000);
    getWeatherData1()

    function getWeatherData1() {
        var city1 = {
            !!json_encode($city) !!
        };
        fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city1}&appid=${API_KEY}`).then(res => res.json())
            .then(data => {
                timezone.innerHTML = data.name + ', ' + data.sys.country;
                getWeatherData(data);
            })
    }

    function getWeatherData(data) {
        fetch(
                `https://api.openweathermap.org/data/2.5/onecall?lat=${data.coord.lat}&lon=${data.coord.lon}&exclude=hourly,minutely&units=metric&appid=${API_KEY}`)
            .then(res => res.json()).then(data => {
                console.log(data)
                showWeatherData(data);
            })
    }



    function showWeatherData(data) {
        let {
            humidity,
            pressure,
            sunrise,
            sunset,
            wind_speed
        } = data.current;
        countryEl.innerHTML = data.lat + 'N ' + data.lon + 'E'

        currentWeatherItemsEl.innerHTML =
            `<div class="weather-item">
        <div>Humidity</div>
        <div>${humidity}%</div>
    </div>
    <div class="weather-item">
        <div>Pressure</div>
        <div>${pressure}</div>
    </div>
    <div class="weather-item">
        <div>Wind Speed</div>
        <div>${wind_speed}</div>
    </div>
    <div class="weather-item">
        <div>Sunrise</div>
        <div>${window.moment(sunrise * 1000).format('HH:mm a')}</div>
    </div>
    <div class="weather-item">
        <div>Sunset</div>
        <div>${window.moment(sunset*1000).format('HH:mm a')}</div>
    </div>
    
    
    `;

        let otherDayForcast = ''
        data.daily.forEach((day, idx) => {
            if (idx == 0) {
                currentTempEl.innerHTML = `
            <img src="http://openweathermap.org/img/wn//${day.weather[0].icon}@4x.png" alt="weather icon" class="w-icon">
            <div class="other">
                <div class="day">${window.moment(day.dt*1000).format('dddd')}</div>
                <div class="temp">Min  ${day.temp.min}&#176;C</div>
                <div class="temp">Max  ${day.temp.max}&#176;C</div>
            </div>
            
            `
            } else {
                otherDayForcast += `
            <div class="weather-forecast-item">
                <div class="day">${window.moment(day.dt*1000).format('ddd')}</div>
                <img src="http://openweathermap.org/img/wn/${day.weather[0].icon}@2x.png" alt="weather icon" class="w-icon">
                <div class="temp">Min  ${day.temp.min}&#176;C</div>
                <div class="temp">Max  ${day.temp.max}&#176;C</div>
            </div>
            
            `
            }
        })


        weatherForecastEl.innerHTML = otherDayForcast;
    }
    </script>
</body>

</html>