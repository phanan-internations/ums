# User Management System

A simple user management system written in [Laravel](https://laravel.com) and [Vue.js](https://vuejs.org/).

## Requirements

As the system is written in Laravel and Vue.js, the requirements to these frameworks must be met, namely:

* PHP >5.6 with Composer
* MySQL/MariaDB
* Node.js stable with yarn/npm

## Installation

From the root of the installation folder:

1. Execute `composer install` to install all PHP package dependencies
1. Copy `.env.exampple` to `.env` if necessary
1. Edit `.env` and populate the `DB_` entries with corresponding details
1. Run these commands 
    ```bash
    php artisan migrate
    php artisan db:seed
    yarn
    yarn prod
    php artisan serve
    ```
1. Now visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser and log in with username `admin` and password `password`.

## Known Issues

Due to time constraints, there are certain limitations to the system, most notably:
 
* The interface is very basic
* There's no feedback after a user is added to a group
* AJAX requests are done without a loading indicator
* There's no enforcing for group or user's uniqueness

## Tests

To test the system, run `phpunit` from the root installation folder.

## Other Artifacts

Along with the code, other artifacts are also included:
 
#### Domain Model

<img src="https://github.com/phanan-internations/ums/raw/master/artifacts/domain-model.png" width="100%" alt="Data Model">

#### Data Model

<img src="https://github.com/phanan-internations/ums/raw/master/artifacts/data-model.png" width="100%" alt="Data Model">

The data model's source workbench file can also be found under `artifacts/`.
