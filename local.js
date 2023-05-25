const API_KEY = `b87ddfcb90d0e5ea9132e4ab54a65ffb`;

if (navigator.onLine) {
  fetch("city.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("Data of assgined city is fetch from api");
      console.log(data);
      const database = JSON.stringify(data);
      localStorage.setItem("current", database);
      city.innerHTML = data.name;
      country.innerHTML = data.sys.country;
      weathercondition.innerHTML = data.weather[0].main;
      temp.innerHTML = data.main.temp;
      humid.innerHTML = data.main.humidity;
      const url = ` http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
      const imgIcon = document.getElementById("image-icon")
      imgIcon.setAttribute('src', url)
      wind.innerHTML = data.wind.speed;
      pressure.innerHTML = data.main.pressure;
    })
    .catch((error) => {
      console.log(error);
    });
}
else {
  const current = localStorage.getItem("current");
  if (current) {
    console.log("Data of assigned city is fetch from local storage");
    const test = JSON.parse(current);
    if (test) {
      city.innerHTML = test.name;
      country.innerHTML = test.sys.country;
      weathercondition.innerHTML = test.weather[0].main;
      temp.innerHTML = test.main.temp;
      humid.innerHTML = test.main.humidity;
      const url = ` http://openweathermap.org/img/wn/${test.weather[0].icon}@2x.png`;
      const imgIcon = document.getElementById("image-icon")
      imgIcon.setAttribute('src', url)
      wind.innerHTML = test.wind.speed;
      pressure.innerHTML = test.main.pressure;
    }
  }
}


const button = document.querySelector('button');
button.addEventListener('click', () => {
  const cityname = document.getElementById('city-name').value;
  if (navigator.onLine) {
    const citiesData = JSON.parse(localStorage.getItem('citiesData')) || [];
    var isCityPresent = false;
    let matchedCityData = [];
    for (let i = 0; i < citiesData.length; i++) {
      if (citiesData[i].city === cityname) {
        isCityPresent = true;
        matchedCityData=citiesData[i].data;
        break;
      }
    }

    if (isCityPresent) {
      console.log(`Data of searched city fetch from local storage`);
      // console.log(matchedCityData);
      city.innerHTML = matchedCityData.name;
          country.innerHTML = matchedCityData.sys.country;
          weathercondition.innerHTML = matchedCityData.weather[0].main;
          temp.innerHTML = matchedCityData.main.temp;
          humid.innerHTML = matchedCityData.main.humidity;
          const url = ` http://openweathermap.org/img/wn/${matchedCityData.weather[0].icon}@2x.png`;
          const imgIcon = document.getElementById("image-icon")
          imgIcon.setAttribute('src', url)
          wind.innerHTML = matchedCityData.wind.speed;
          pressure.innerHTML = matchedCityData.main.pressure;
    } else {
      // fetch(`https://api.openweathermap.org/data/2.5/weather?q=${cityname}&appid=${API_KEY}&units=metric`)
      fetch(`search.php?city_name=${cityname}&submit=`)
        .then(response => response.json())
        .then(data => {
          console.log("Data of searched city fetch from api");
          console.log(data);
          city.innerHTML = data.name;
          country.innerHTML = data.sys.country;
          weathercondition.innerHTML = data.weather[0].main;
          temp.innerHTML = data.main.temp;
          humid.innerHTML = data.main.humidity;
          const url = ` http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
          const imgIcon = document.getElementById("image-icon")
          imgIcon.setAttribute('src', url)
          wind.innerHTML = data.wind.speed;
          pressure.innerHTML = data.main.pressure;
          // Add the new city data to the array
          citiesData.push({ city: cityname, data: data });
          // Store the updated array in local storage
          localStorage.setItem('citiesData', JSON.stringify(citiesData));
        })
        .catch((error) => console.log(error));
    }


  }
  else {
    const citiesData = JSON.parse(localStorage.getItem('citiesData')) || [];
    var isCityPresent = false;
    let matchedCityData = [];
    for (let i = 0; i < citiesData.length; i++) {
      if (citiesData[i].city === cityname) {
        isCityPresent = true;
        matchedCityData=citiesData[i].data;
        break;
      }
    }
    if (isCityPresent) {
      console.log(`Data fetch from local storage when wifi is off`);
      city.innerHTML = matchedCityData.name;
          country.innerHTML = matchedCityData.sys.country;
          weathercondition.innerHTML = matchedCityData.weather[0].main;
          temp.innerHTML = matchedCityData.main.temp;
          humid.innerHTML = matchedCityData.main.humidity;
          const url = ` http://openweathermap.org/img/wn/${matchedCityData.weather[0].icon}@2x.png`;
          const imgIcon = document.getElementById("image-icon")
          imgIcon.setAttribute('src', url)
          wind.innerHTML = matchedCityData.wind.speed;
          pressure.innerHTML = matchedCityData.main.pressure;
    }
    else {
      console.log('City not found in local storage');
    }
  }
});



function digitaltime() {
  const date = new Date();
  let hours = date.getHours();
  let minutes = date.getMinutes();
  let AMPM = ' '
  if (hours > 12) {
    AMPM = 'PM';
  }
  else {
    AMPM = 'AM';
  }
  if (minutes < 10) {
    minutes = "0" + minutes;
  }
  hours = hours % 12 || 12;
  const time = `${hours}:${minutes}:${AMPM}`;
  currentTime.innerHTML = time
}
setInterval(digitaltime, 1000);

function dayDate() {
  const today = new Date();
  const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  const currentDay = days[today.getDay()];
  const currentMonth = months[today.getMonth()];
  const currentDate = today.getDate();
  const currentYear = today.getFullYear();
  daydate.innerHTML = currentMonth + " " + currentDate + ", " + currentYear + " " + currentDay;

}
dayDate()
