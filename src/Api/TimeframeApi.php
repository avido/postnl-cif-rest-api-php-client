<?php
namespace Avido\PostNLCifClient\Api;
/**
  @File: Timeframe.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Jul 10, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Budgetlens B.V.
  @Modified:
  @Description:
        Timeframe API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\Exceptions\CifClientException;

use Avido\PostNLCifClient\BaseClient;

// entities 
use Avido\PostNLCifClient\Entities\Location;

// requests
use Avido\PostNLCifClient\Request\DeliveryOptions\Timeframe\TimeframeRequest;

// responses
use Avido\PostNLCifClient\Response\DeliveryOptions\Timeframe\TimeframesResponse;

class TimeframeApi extends BaseClient 
{
    /***********************************
     * Timeframe Webservice API
     * 
     *      - Get available timeframes
         * 
     * @see https://developer.postnl.nl/browse-apis/delivery-options/location-webservice/documentation/
     ***********************************/
    
    /**
     * Get Available timeframes
     *
     * Get availble timeframes based on provided options and start/end date
     * 
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Timeframe\TimeframeRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Timeframe\TimeframesResponse
     */
    public function getTimeframes(TimeframeRequest $request)
    {
        $resp = $this->get($request->getEndpoint(), $request->getArguments());
        return new TimeframesResponse($resp);
    }
}
