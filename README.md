<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h3 align="center">PHP & MySQL API by Gabriele Stringano</h3>

  <p align="center">
  RESTful JSON API for a travel agency
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      About The Project
      <ul>
        <li>Built With</li>
      </ul>
    </li>
    <li>Endpoints</li>
    <li>Contact</li>
    <li>Acknowledgments</li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## 💡About The Project

As a Start2impact student, I developed this application to put my newly acquired knowledge of PHP and MySQL into practice.

<p align="right">(<a href="#top">back to top</a>)</p>

<ol>

### Built With


* PHP
* MySQL
* COMPOSER

<p align="right">(<a href="#top">back to top</a>)</p>

</ol>

<!-- How it Work + ScreenShot -->

## ⚙️Endpoints

### Country

GET `/php-api/country/read`
<br />
POST `/php-api/country/create`

```json
{
    "Name": "string"
}
```

POST `/php-api/country/update`
```json
{
    "Name": "string",
    "NewName": "string"
}
```

DELETE `/php-api/country/delete`
```json
{
    "Name": "string"
}
```

### Travel

GET `/php-api/travel/read`
<br />
POST `/php-api/travel/create`

```json
{
    "AvailablePlaces": "int"
}
```

POST `/php-api/travel/update`
```json
{
    "Id": "int",
    "AvailablePlaces": "int"
}
```

DELETE `/php-api/travel/delete`
```json
{
    "Id": "int"
}
```

POST `/php-api/travel/byCountry`
```json
{
    "CountryName": "string"
}
```

### Itinerary

GET `/php-api/itinerary/read`
<br />
POST `/php-api/itinerary/create`

```json
{
    "Country_id": "int",
    "Travel_id": "int",
}
```

POST `/php-api/itinerary/update`
```json
{
    "Id": "int",
    "Country_id": "int",
    "Travel_id" : "int"
}
```

DELETE `/php-api/itinerary/delete`
```json
{
    "Id": "int"
}
```

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- CONTACT -->
## 📲Contact

Linkedin -> https://www.linkedin.com/in/gabriele-stringano/

Gabriele Stringano Email: - gabrielestringano@gmail.com

My Projects: - https://github.com/Gabriele-Stringano/
<p align="right">(<a href="#top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## 📚Acknowledgments

List of resources I used:

* [GitHub](https://github.com)
* [Start2Impact](https://www.start2impact.it/)
* [Visual-Studio](https://code.visualstudio.com/)
* [Best-README-Template](https://github.com/ferneynava/Best-README-Template)

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

