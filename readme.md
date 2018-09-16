Installation
========================
* From GitHub
    * Clone repository - git@github.com:bobbymckinnon/obscure-woodland-73176.git
    * composer install
    * php artisan serve
    * php vendor/bin/phpunit -c phpunit.xml
    
* Running locally
    * cd into project directory
    * composer install
    * php artisan serve
    * php vendor/bin/phpunit -c phpunit.xml
    
Information
=======================  
This app is using an out of the box laravel 5.7 as a base. (sorry about the over head)
Starting point of the app is  App\Http\Controller\SearchController.

* SearchApiInterface object - EbaySearchApi - Builds dynamic fetch from endpoint
* ProductDataInterface object - EbayProductData - Transforms json to ProductResource
* ProductResource - json transformer for product
* ProductCollection - json transformer for collection of ProductResource

API
=======================
* All query parameters are optional - except "keywords"
* The application will "sleep" if it is not used for several hours, so initial request could take up to 30 seconds.
* To access the api endpoint
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=bmw
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_max=35
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33&price_max=35
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=mac&sorting=by_price_asc (default sort is BestMatch)    

Php Unit
=======================
* php vendor/bin/phpunit -c phpunit.xml
    
<p align="left"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
