<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: BarcodeApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
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
use Avido\PostNLCifClient\Exceptions\InvalidBarcodeTypeException;
// requests
use Avido\PostNLCifClient\Request\SendTrack\Barcode\BarcodeRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse;

class BarcodeApi extends BaseClient
{
    /**
     *Available barcode types
     * @var array
     */
    private $availableBarcodeTypes = ['2S', '3S', 'CC', 'CP', 'CD', 'CF'];
    
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
     * @param string $type
     * @param string $serie
     * @param boolean $domestic = domestic (dutch) shipment
     * @return \Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse
     */
    public function getBarcode($type, $serie = null, $domestic = true)
    {
        if (!in_array($type, $this->availableBarcodeTypes)) {
            throw new InvalidBarcodeTypeException($type);
        }
        if (is_null($serie)) {
            switch ($type) {
                case '2S':
                    $serie = '0000000-9999999';
                    break;
                case '3S':
                    // 3S barcodes may be 15 characters long
                    $serie = '000000000-999999999';
                    if (!$domestic) {
                        // EPS is limited to 13 though
                        $serie = '0000000-9999999';
                    }
                    break;
                default:
                    // Globalpack is suffixed with the ISO country code.
                    $serie = '0000-9999';
            }
        }
        try {
            $request = new BarcodeRequest();
            $request->setCustomerCode($this->getCustomerCode())
                ->setCustomerNumber($this->getCustomerNumber())
                ->setType($type)
                ->setSerie($serie);
            // run request
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new BarcodeResponse($resp);
        } catch (CifClientException $e) {
            throw new CifBarcodeException($e->getMessage());
        }
    }
}
