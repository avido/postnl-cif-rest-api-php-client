<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: ShippingStatusApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Shipping Status API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

// exceptions
//use Avido\PostNLCifClient\Exceptions\CifClientException;

// requests
use Avido\PostNLCifClient\Request\SendTrack\ShippingStatus\StatusRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\StatusResponse;

class ShippingStatusApi extends BaseClient
{
    
    /***********************************
     * Shipping Status Webservice API
     *
     *      - getCurrentStatus
     *      - getFullStatus
     *      - getSignature
     *
     * @see https://developer.postnl.nl/browse-apis/send-and-track/shippingstatus-webservice/documentation/
     ***********************************/
    
    /**
     * Get Current status by Shipping Barcode
     *
     * @access public
     * @param string $barcode
     * @return StatusResponse
     */
    public function getCurrentStatus($barcode = null)
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/barcode/{$barcode}");
        return new StatusResponse($resp);
    }
    
    /**
     * Get Current status by Shipping Reference
     *
     * @access public
     * @param string $reference
     * @return StatusResponse
     */
    public function getCurrentStatusByReference($reference = null)
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/reference/{$reference}", [
            'customerCode' => $this->getCustomerCode(),
            'customerNumber' => $this->getCustomerNumber()
        ]);
        return new StatusResponse($resp);
    }
    
    /**
     * Get Complete Status by Shipping Barcode
     *
     * @access public
     * @param string $barcode
     * @return StatusResponse
     */
    public function getCompleteStatus($barcode = null)
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/barcode/{$barcode}", [
            'detail' =>1
        ]);
        return new StatusResponse($resp);
    }
    
    /**
     * Get Complete Status by Shipping Reference
     *
     * @access public
     * @param string $reference
     * @return StatusResponse
     */
    public function getCompleteStatusByReference($reference = null)
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/reference/{$reference}", [
            'customerCode' => $this->getCustomerCode(),
            'customerNumber' => $this->getCustomerNumber(),
            'detail' => 1
        ]);
        return new StatusResponse($resp);
    }
    
    public function getSignature($barcode = null)
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/signature/{$barcode}");
        return new StatusResponse($resp);
    }
}
