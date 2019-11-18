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
use Avido\PostNLCifClient\Response\SendTrack\ShippingStatus\UpdatedShipmentsResponse;
use Avido\PostNLCifClient\Util\Date;

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
    public function getCurrentStatus(string $barcode): StatusResponse
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
    public function getCurrentStatusByReference(string $reference): StatusResponse
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
    public function getCompleteStatus(string $barcode): StatusResponse
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
    public function getCompleteStatusByReference(string $reference): StatusResponse
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/reference/{$reference}", [
            'customerCode' => $this->getCustomerCode(),
            'customerNumber' => $this->getCustomerNumber(),
            'detail' => 1
        ]);
        return new StatusResponse($resp);
    }
    /**
     * Get Signature for specific barcode
     *
     * @access public
     * @param string $barcode
     * @return StatusResponse
     */
    public function getSignature(string $barcode): StatusResponse
    {
        $request = new StatusRequest();
        $resp = $this->get("{$request->getEndpoint()}/signature/{$barcode}");
        return new StatusResponse($resp);
    }
    /**
     * Get updated statusses in period
     * @param array $periods
     * @return UpdatedShipmentsResponse
     */
    public function getUpdatedStatusses(array $periods = []): UpdatedShipmentsResponse
    {
        $request = new StatusRequest(null, null, $periods);
        $periods = $request->getPeriods();
        $arguments = [];

        if (count($periods) > 0) {
            $argPeriods = [];
            foreach ($periods as $period) {
                $argPeriods[] = $period->format("Y-m-d\TH:i:s");
            }
            $arguments['period'] = implode("&", $argPeriods);
        }
        $resp = $this->get("{$request->getEndpoint()}/{$this->getCustomerNumber()}/updatedshipments",
            $arguments
        );
        return new UpdatedShipmentsResponse($resp);
    }
}
