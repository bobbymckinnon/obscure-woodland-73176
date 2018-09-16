<?php

declare(strict_types=1);

namespace Tests\Unit\App\Tools\Ebay;

use App\Tools\SearchApi\Ebay\EbayProductData;
use App\Tools\SearchApi\Ebay\EbaySearchApi;
use Prophecy\Prophet;

class EbaySearchApiTest extends \PHPUnit\Framework\TestCase
{
    const RESPONSE = '{"findItemsByKeywordsResponse":[{"ack":["Success"],"version":["1.13.0"],"timestamp":["2018-09-16T07:22:16.182Z"],"searchResult":[{"@count":"1","item":[{"itemId":["110371953291"],"title":["Mac Miller Tickets - Orlando"],"globalId":["EBAY-US"],"subtitle":["CFE Arena | Suite 12"],"primaryCategory":[{"categoryId":["173634"],"categoryName":["Concert Tickets"]}],"viewItemURL":["http:\/\/cgi.sandbox.ebay.com\/Mac-Miller-Tickets-Orlando-\/110371953291"],"autoPay":["false"],"location":["USA"],"country":["US"],"sellerInfo":[{"sellerUserName":["testuser_stubhub_us_126_com"],"feedbackScore":["500"],"positiveFeedbackPercent":["0.0"],"feedbackRatingStar":["Purple"],"topRatedSeller":["false"]}],"shippingInfo":[{"shippingType":["Free"],"shipToLocations":["Worldwide"],"expeditedShipping":["false"],"oneDayShippingAvailable":["false"]}],"sellingStatus":[{"currentPrice":[{"@currencyId":"USD","__value__":"2184.1"}],"convertedCurrentPrice":[{"@currencyId":"USD","__value__":"2184.1"}],"sellingState":["Active"],"timeLeft":["P5DT3H40M45S"]}],"listingInfo":[{"bestOfferEnabled":["false"],"buyItNowAvailable":["false"],"startTime":["2018-08-22T11:03:01.000Z"],"endTime":["2018-09-21T11:03:01.000Z"],"listingType":["Classified"],"gift":["false"]}],"returnsAccepted":["false"],"isMultiVariationListing":["false"],"topRatedListing":["false"]}]}],"paginationOutput":[{"pageNumber":["1"],"entriesPerPage":["100"],"totalPages":["1"],"totalEntries":["1"]}],"itemSearchURL":["http:\/\/shop.sandbox.ebay.com\/i.html?_nkw=mac&fscurrency=USD&_ddo=1&_ipg=100&_mPrRngCbx=1&_os=S%7CPS%7CGI%7CD&_pgn=1&_sop=16&_udlo=1%2C000"]}]}';

    /** @var Prophet */
    private $prophet;

    public function setUp()
    {
        $this->prophet = new Prophet();
    }

    public function test_buildQuery()
    {
        $params = [
            'keywords' => 'mac',
        ];

        $str = (new EbaySearchApi((new EbayProductData())))->buildQuery($params);

        $this->assertEquals('&keywords=mac&sortOrder=BestMatch', $str);

        $params = [
            'keywords' => 'mac',
            'price_min' => 10,
            'price_max' => 20,
        ];

        $str = (new EbaySearchApi((new EbayProductData())))->buildQuery($params);

        $this->assertEquals(
            '&keywords=mac&sortOrder=BestMatch&itemFilter.name%280%29=MinPrice&itemFilter.value%280%29=10&itemFilter.name%5B1%5D=MaxPrice&itemFilter.value%5B1%5D=20',
            $str
        );

        $params = [
            'keywords' => 'mac',
            'price_min' => 10,
            'sorting' => 'by_price_desc',
        ];

        $str = (new EbaySearchApi((new EbayProductData())))->buildQuery($params);

        $this->assertEquals(
            '&keywords=mac&sortOrder=CurrentPriceHighest&itemFilter.name%280%29=MinPrice&itemFilter.value%280%29=10',
            $str
        );
    }
}
