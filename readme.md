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
<p align="left"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

Starting point of the app is  <b>App\Http\Controller\SearchController</b>.

* <b>SearchApiInterface</b> object - <b>EbaySearchApi</b> - Builds dynamic fetch from endpoint
* <b>ProductDataInterface</b> object - <b>EbayProductData</b> - Transforms json to ProductResource
* <b>ProductResource</b> - json transformer for product
* <b>ProductCollection</b> - json transformer for collection of ProductResource

Considerations / Improvements
=======================
* The application can be easily extended to support other api endpoint and data sets by created new classes that implement the above mentioned interfaces.
* For queries with large data sets in the response it may be better to dump the response to a text file, and have queued jobs handle the parsing.
* The application uses the ebay OutputSelector - GalleryInfo to find the largest product image available.
* The sorting routine itself could be implemented better.
 
API
=======================
* All query parameters are optional - <b>except</b> "keywords"
    * keywords
    * price_min
    * price_max
    * sorting (by_price_asc | by_price_desc)
* The application will "sleep" if it is not used for several hours, so initial request could take up to 30 seconds.
* To access the api endpoint
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=bmw
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_max=35
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=auto&price_min=33&price_max=35
    * https://obscure-woodland-73176.herokuapp.com/search?keywords=mac&sorting=by_price_asc (default sort is BestMatch)    

Php Unit
=======================
* To run the unit tests locally - php vendor/bin/phpunit -c phpunit.xml
* <b>EbaySearchApiTest</b> tests dynamic url query building.
* <b>EbayProductDataTest</b> test api response processing.

External Resources
=======================   
* https://developer.ebay.com/DevZone/finding/CallRef/findItemsByKeywords.html
* https://laravel.com/
* https://laravel.com/docs/5.6/artisan
* https://phpunit.de/
