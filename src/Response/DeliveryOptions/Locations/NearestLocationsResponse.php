<?php
namespace Avido\PostNLCifClient\Response\DeliveryOptions\Locations;

/**
  @File: NearestLocationsResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 9, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Nearest Locations response
  @Dependencies:
 */
use Avido\PostNLCifClient\Entities\Location;

class NearestLocationsResponse
{
    private $locations = [];
    
    public function __construct($data = [])
    {
        if (isset($data['GetLocationsResult']) && isset($data['GetLocationsResult']['ResponseLocation'])) {
            foreach ($data['GetLocationsResult']['ResponseLocation'] as $item) {
                $location = new Location($item);
                $this->add($location);
            }
        }
    }

    /**
     * Add location object to collection
     *
     * @access public
     * @param Location $location
     * @return $this
     */
    public function add(Location $location)
    {
        $this->locations[] = $location;
        return $this;
    }
    
    /**
     * Get locations collection
     *
     * @access public
     * @return array
     */
    public function getLocations()
    {
        return $this->locations;
    }
}
