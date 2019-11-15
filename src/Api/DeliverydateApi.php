<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: Deliverydate.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Delivery date calculation API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

// exception
//use Avido\PostNLCifClient\Exceptions\CifClientException;

// entities
//use Avido\PostNLCifClient\Entities\Location;

// requests
use Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\DeliverydateRequest;
use Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\ShippingdateRequest;

// responses
use Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\DeliverydateResponse;
use Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\ShippingdateResponse;

class DeliverydateApi extends BaseClient
{
    /***********************************
     * Delivery date Webservice API
     *
     *      - GetDeliveryDate
     *      - GetShippingDate
     *
     * @see https://developer.postnl.nl/browse-apis/delivery-options/deliverydate-webservice/documentation/
     ***********************************/

    /**
     * Get Delivery Date
     *
     * Calculate delivery date based on address data
     *
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\DeliverydateRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\DeliverydateResponse
     */
    public function getDeliveryDate(DeliverydateRequest $request): DeliverydateResponse
    {
        $resp = $this->get($request->getEndpoint(), $request->getArguments());
        return new DeliverydateResponse($resp);
    }

    /**
     * Get Shipping Date
     *
     * Calculate date of shipping to deliver on promised date
     *
     * @access public
     * @param \Avido\PostNLCifClient\Request\DeliveryOptions\Deliverydate\ShippingdateRequest $request
     * @return \Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate\ShippingdateResponse
     */
    public function getShippingDate(ShippingdateRequest $request): ShippingdateResponse
    {
        $resp = $this->get($request->getEndpoint(), $request->getArguments());
        return new ShippingdateResponse($resp);
    }
}
