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

GET `/php-api/country/read.php`
<br />
POST `/php-api/country/create.php`

```json
{
    "Name": "string"
}
```

POST `/php-api/country/update.php`
```json
{
    "Name": "string",
    "NewName": "string"
}
```

DELETE `/php-api/country/delete.php`
```json
{
    "Name": "string"
}
```

POST `/php-api/country/byTravel.php`
```json
{
    "Id": "int"
}
```

### Travel

GET `/php-api/travel/read.php`
<br />
POST `/php-api/travel/create.php`

```json
{
    "AvailablePlaces": "int"
}
```

POST `/php-api/travel/update.php`
```json
{
    "Id": "int",
    "AvailablePlaces": "int"
}
```

DELETE `/php-api/travel/delete.php`
```json
{
    "Id": "int"
}
```

POST `/php-api/travel/byCountry.php`
```json
{
    "CountryName": "string"
}
```

POST `/php-api/travel/byAvailablePlaces.php` (num of seats or similar)
```json
{
    "AvailablePlaces": "int"
}
```

### Itinerary

GET `/php-api/itinerary/read.php`
<br />
POST `/php-api/itinerary/create.php`

```json
{
    "Country_id": "int",
    "Travel_id": "int",
}
```

POST `/php-api/itinerary/update.php`
```json
{
    "Id": "int",
    "Country_id": "int",
    "Travel_id" : "int"
}
```

DELETE `/php-api/itinerary/delete.php`
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

