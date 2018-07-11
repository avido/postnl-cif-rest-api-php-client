<?php
namespace Avido\PostNLCifClient\Entities;
/**
  @File: Location.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 9, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Location 
  @Dependencies:
 */
use Avido\PostNLCifClient\BaseModel;

use Avido\PostNLCifClient\Entities\Address;

class Location extends BaseModel
{
//    private $address = null;
//    private $deliveryOptions = null;
//    private $distance = null;
//    private $latitude = null;
//    private $longitude = null;
//    private $locationCode = null;
//    private $name = null;
//    private $openingHours = null;
//    private $parnterName =null;
//    private $phonenNumber = null;
//    private $retailerNetworkId = null;
//    private $saleschannel = null;
//    private $terminalType = null;

    public function __construct($data = []) 
    {
        // address 
        $address = new Address($data['Address']);
        $this->setAddress($address);
        unset($data['Address']);
        if (isset($data['DeliveryOptions']) && isset($data['DeliveryOptions']['string']) && is_array($data['DeliveryOptions']['string'])) {
            $this->setDeliveryOptions($data['DeliveryOptions']['string']);
            unset($data['DeliveryOptions']);
        }
        $openingHours = [];
        if (isset($data['OpeningHours']) && is_array($data['OpeningHours'])) {
            // reformat opening hours
            $openingHours = [];
            foreach ($data['OpeningHours'] as $day => $time) {
                if (isset($time['string'])) {
                    list($from, $till) = explode("-", $time['string']);
                    $openingHours[strtolower($day)] = [$from => $till];
                }
            }
            $this->setOpeningHours($openingHours);
            unset($data['OpeningHours']);
        }
        parent::__construct($data);
    }
    
}
