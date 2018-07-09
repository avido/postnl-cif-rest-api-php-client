<?php
namespace Avido\PostNLCifClient;
/**
  @File: CifApiTest.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 9, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Several unit tests for the PostNL Cif Rest Api Php Client
 */

use PHPUnit\Framework\TestCase;
use Avido\PostNLCifClient\CifApi;
use Avido\PostNLCifClient\Request\DeliveryOptions\Location\NearestLocationsRequest;

class CifApiTest extends TestCase 
{

    /**
     * @var Avido\PostNLCifClient\CifApi
     */
    private $client;
    
    public function setUp()
    {
        // retrieve username from phpunit.xml config
        $apiKey = getenv('APIKEY');
        
        $this->client = new CifApi($apiKey, true);
    }

    public function testGetNearestLocations()
    {
        $request = new NearestLocationsRequest();
        $request->setCountryCode('NL')
            ->setPostalcode('2132WT')
            ->setCity('Hoofddorp')
            ->setStreet('Siriusdreef')
            ->setHouseNumber(42)
            ->setDeliveryDate('01-01-2999')
            ->setOpeningTime('09:00:00')
            ->addDeliveryOptions('PG');
        $response = $this->client->getNearestLocations($request);
        die("STOP");
        $this->assertEquals(500, $response->getCode());
    }
}
