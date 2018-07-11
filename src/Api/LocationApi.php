<?php
namespace Avido\PostNLCifClient\Api;
/**
  @File: Location.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 10, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Budgetlens B.V.
  @Modified:
  @Description:
        Location API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\CifLocationException;

// entities 
use Avido\PostNLCifClient\Entities\Location;

// requests
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsGeoRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\NearestLocationsAreaRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Locations\LocationRequest;

// responses
use Avido\PostNLCifClient\Response\DeliveryOptions\Locations\NearestLocationsResponse;

class LocationApi extends BaseClient 
{
    /***********************************
     * Location Webservice API
     * 
     *      - GetNearestLocations
     *      - GetLocationsInArea
     *      - GetLocation
     * 
     * @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
     ***********************************/
    
    /**
     * Get Nearest Locations
     *
     * Get nearest postnl locations based on address data (postal / street)
     * 
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Location\NearestLocationsRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Location\NearestLocationsResponse
     */
    public function getNearestLocations(NearestLocationsRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new NearestLocationsResponse($resp);
        } catch (CifClientException $e) {
            throw new CifLocationException($e->getMessage());
        }
    }
    
    /**
     * Get Nearest Locations Geo
     *
     * Get nearest locations based on geo position (long-/latitude)
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Location\NearestLocationsGeoRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Location\NearestLocationsResponse
     */
    public function getNearestLocationsGeo(NearestLocationsGeoRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new NearestLocationsResponse($resp);
        } catch (CifClientException $e) {
            throw new CifLocationException($e->getMessage());
        }
    }
    
    
    /**
     * Get Nearest Locations Area
     *
     * Get nearest locations in an area specified by geolocations (norh, east, south, west)
     * 
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Location\NearestLocationsGeoRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Location\NearestLocationsResponse
     */
    public function getNearestLocationsArea(NearestLocationsAreaRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new NearestLocationsResponse($resp);
        } catch (CifClientException $e) {
            throw new CifLocationException($e->getMessage());
        }
    }

    /**
     * Get Location Details
     *
     * Returns location information of the supplied location code.
     * 
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Location\LocationRequest $request
     * @return \Avido\PostNLCifClient\Entities\Location
     */
    public function getLocation(LocationRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            if (isset($resp['GetLocationsResult']) && isset($resp['GetLocationsResult']['ResponseLocation'])) {
                return new Location($resp['GetLocationsResult']['ResponseLocation']);
            }
        } catch (CifClientException $e) {
            throw new CifLocationException($e->getMessage());
        }
    }
}
