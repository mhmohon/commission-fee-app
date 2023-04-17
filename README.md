<!-- PROJECT INFO -->
<div align="center">
  <h3 align="center">Commission Fee App</h3>
  <p align="center">
    A solution to generate commission fee from csv file
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#architecture-and-design-pattern">Architecture and Design Pattern</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

This is a CLI system that that handles operations provided in CSV format and calculates a commission fee based on some rules.

### Built With

This project is build with these technologies.

[![Laravel][Laravel.com]][Laravel-url]

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

Before you can run this Laravel project, you'll need to install the following software:

- PHP v8.1 or later
- Composer v2.5.4 or later
- Laravel v10.0 or later

### Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x)

1. Clone the repo

		git clone git@github.com:mhmohon/commission-fee-app.git
	
2. Switch to the repo folder

		cd commission-fee-app
	
3. Install all the dependencies using composer

		composer install
	
4. Copy the example env file and make the required configuration changes in the .env file

		cp .env.example .env
	
5. Generate a new application key

		php artisan key:generate
	
**TL;DR command list**

    git clone git@github.com:mhmohon/commission-fee-app.git
    cd commission-fee-app
    composer install
    cp .env.example .env
    php artisan key:generate

<!-- Architecture and Design Pattern -->
## Architecture and Design Pattern
#### Service Layer Pattern
Implemented Service Layer design pattern with a service interface layer to increase testability, abstraction, and modularity, resulting in a more maintainable and scalable application.

#### Factory Layer Pattern
I have used factory layer pattern to enhance code flexibility, maintainability, and configurability. This approach allows for creating objects through an interface, providing improved abstraction, decoupling, and customization options without modifying the underlying code.


<!-- USAGE EXAMPLES -->
## Usage
You can run **Unit** test by using this command

		php artisan app:fee-calculate --path=input.csv
	
**Result**

![run-command][run-command]

Or

        php artisan app:fee-calculate
	
**Result**

![run-command-2][run-command-2]

You can run **Unit** test by using this command

		./vendor/bin/phpunit
	
**Result**

![phpunit][phpunit]

You can run **PHPStan** test by using this command

		./vendor/bin/phpstan analyse
	
**Result**

![phpstan][phpstan]




<!-- CONTACT -->
## Contact

Mosharrf Hossain - [@Linkedin](https://www.linkedin.com/in/mhmohon/) - mhmosharrf@gmail.com

Project Link: [https://github.com/mhmohon/commission-fee-app](https://github.com/mhmohon/commission-fee-app)



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[linkedin-url]: https://linkedin.com/in/mhmohon
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[tailwindcss.com]: https://img.shields.io/badge/tailwindcss-0769AD?style=for-the-badge&logo=tailwindcss&logoColor=white
[tailwindcss-url]: https://tailwindcss.com 
[run-command]: https://i.ibb.co/gtnV28N/Screenshot-2023-04-17-at-7-47-44-PM.png
[run-command-2]: https://i.ibb.co/BLSF3VN/Screenshot-2023-04-17-at-7-48-22-PM.png
[phpunit]: https://i.ibb.co/86RHM3Q/Screenshot-2023-04-17-at-7-46-34-PM.png
[phpstan]: https://i.ibb.co/RYcd4zm/Screenshot-2023-04-17-at-8-02-20-PM.png
