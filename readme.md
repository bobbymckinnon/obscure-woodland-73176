Installation
========================
* From GitHub
    * Clone repository - git@github.com:bobbymckinnon/obscure-woodland-73176.git
    * composer install
    * php artisan serve
    
* Running locally
    * cd into project directory
    * composer install
    * php artisan serve
    
Information
=======================  
This app is using an out of the box laravel 5.7 as a base. (sorry about the over head)
Starting point of the app is  App\Http\Controller\SearchController
This takes a SearchApiInterface object, in this case specifically the EbaySearchApi.

API
=======================
* All query parameters are optional - except "keywords"
* To access the api endpoint
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=bmw
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_max=35
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33&price_max=35

* Running unit test
    * php vendor/bin/phpunit -c phpunit.xml
    
<p align="left"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
