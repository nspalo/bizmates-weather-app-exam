# Bizmates Ph Weather App Coding Exam
![Weather APP BUILD](https://github.com/nspalo/bizmates-weather-app-exam/actions/workflows/weather-app-ci-build.yml/badge.svg)

A simple weather forecasting application built with Laravel that can display weather update from Japan as a coding exam for Bizmates Ph

----

# About the Weather App
- Is a simple web application built with laravel that can search a for a given location's coordinates and get the weather update and forecast.
- Uses Geoapify geocoding Api to get the geolocation and Open Weather Map Api to get weather data
- This project observes:
  - PSR Coding Standards
  - Object-Oriented Principles / DRY / KISS
  - SOLID Principles / Clean Code 
  - Automated coding standard checking using PhpStan & Easy Coding Standard
  - Automated testing using PhpUnit

![Weather App](https://github.com/nspalo/bizmates-weather-app-exam/blob/feature/BWA-9-weather-app-readme/docker/documents/weather-app-sample-image.jpg)

## Web Stack
- Docker
- NginX stable-alpine
- PHP 8.1 fpm-alpine
- Composer 2.6.1
- Node 20.6-alpine
- Laravel 9
- Bootstrap 5

### Pre-requisite
- Docker
- Geoapify Account
  - Generate API Key 
- Open Weather Map Account
  - Generate API Key
- Configure the API Keys in the `.env` file
  - `See: <ProjectDir>/src/.env`
  - For more info, check `<ProjectDir>/src/config/services.php`

## Set Up Procedure
### Step 1: Service containers - Building, Starting, and Stopping
```
// Building the services/containers
> ./scripts/build.sh

// Starting the services/containers
// - optionally add the -d (detach) flag to run in the background
> ./scripts/up.sh -d

// Or do a one-liner command for the build and start process
> ./scripts/up.sh -d --build

// Stoping the services/containers
// - To stop a specific service add the continer name
> ./scripts/stop.sh <_ContainerName_>

// Tear down routine
// - optionally add the -v to remove the images 
> ./scripts/down.sh -v
```

### Step 2: Packages and Dependencies
```
// Running composer install
> ./scripts/composer.sh install
> ./scripts/composer.sh dump-autoload

// Running NPM
> ./scripts/run.sh npm install
> ./scripts/run.sh npm run build

// Copying Laravel .env file
> ./scripts/composer.sh run post-root-package-install

// Generating Key
> ./scripts/artisan.sh key:generate

```

### Step 3: Accessing the site
Hit the browser at `localhost:8080`

### API Endpoint
`localhost:8080/api/weather-update?location=Some-Location`

where `?location=` is query string for the location to check for weather update/forecast


----

## Code Quality and Testing
```
// Running PhpStan
> ./scripts/composer.sh run phpstan

// Running Easy Coding Standards for the entire project
./scripts/composer.sh run ecs-all

// Running Easy Coding Standards for App or Test ONLY
./scripts/composer.sh run ecs-app
./scripts/composer.sh run ecs-test

// Running Auto-Fix for ecs
./scripts/composer.sh run ecs-fix-app
./scripts/composer.sh run ecs-fix-test

// Running Automated Test with PhpUnit
./scripts/composer.sh run phpunit

```

----

## BizmatesPh Coding Exam Requirements
### Background
- This page aims to provide travel information of Japan for foreign tourists visiting Japan for the first time.

### Tech Stack
- PHP (version 8+ preferred)
- Framework Laravel (any version)
- HTML5, CSS3, Javascript ES5/ES6 or any JS Library preferred (VueJS is a plus)
- Responsive Design (Desktop and Mobile)
- API Endpoints
- Automated Testing

### Submission method
- Provide a github repository once finished
- Development should be within 4 - 5days

### API Service
- Open Weather Map's Daily API
- Foursquare Search Venue API

### Code Quality
- PSR Coding Standards 1,2,4 & 12
- Object-Oriented Principles
  Clean Code & SOLID Principles
- Google JavaScript Style Guide
- Google HTML/CSS Style Guide
