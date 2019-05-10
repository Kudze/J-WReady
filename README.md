# J&WReady

## Requirements

* Composer
* Yarn
* NPM
* MySQL
* (Tested only on Ubuntu 18.04)

## Configuration

* Create .env.local file in project directory
```
APP_ENV=dev
DATABASE_URL="mysql://username:password@127.0.0.1:3306/JnWReady"
```
* Replace dev with prod, if you want to host this on apache2 or nginx.
* Replace username and password with our credentials to MySQL server.

## Installation

* Clone the repo.
* Run `composer update --dev`, this will install all server-side required dependencies.
(--dev tag is only required if you want to host this on built-in PHP server).
* Configure the configuration. (Refer to Config section)
* Run `bin/console d:d:c`, this will create an empty MySQL database.
* Run `bin/console d:m:m`, this will create all required tables in MySQL database.
* Run `bin/console a:d:m:t`, this will mock product tags table with some data. (This step is required to mock product data) (Creates 4 fake-product-tags)
* Run `bin/console a:d:m:p`, this will mock product data. (Creates 20 fake-products).
* Run `yarn update`, this will install all client-side required dependencies.
* Run `yarn encore dev`, this will build client-side of the app.

## Running
* For testing purposes you can run built-in PHP server. (--dev and dev enviroment in configuration is necceseary)
```
bin/console s:r
```

* Or you can host this on Apache2 or nginx server. Refer to symfony tutorials on this step.