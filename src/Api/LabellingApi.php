<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: BarcodeApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Budgetlens B.V.
  @Modified:
  @Description:
        Barcode API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

// exceptions
use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\CifBarcodeException;

// requests
use Avido\PostNLCifClient\Request\SendTrack\Barcode\BarcodeRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse;

class BarcodeApi extends BaseClient
{
    /***********************************
     * Barcode Webservice API
     *
     *      - GetBarcode
     *
     * @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/documentation-soap/
     ***********************************/
    
    /**
     * Get Barcode
     *
     * @access public
     * @param \Avido\PostNLCifClient\Request\SendTrack\Barcode\BarcodeRequest $request
     * @return \Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse
     */
    public function getBarcode(BarcodeRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new BarcodeResponse($resp);
        } catch (CifClientException $e) {
            throw new CifBarcodeException($e->getMessage());
        }
    }
}
