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
//use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\InvalidBarcodeTypeException;
// requests
use Avido\PostNLCifClient\Request\SendTrack\Barcode\BarcodeRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse;

class BarcodeApi extends BaseClient
{
    // barcode types
    const BARCODE_TYPE_DOMESTIC_EPS = "3S";
    const BARCODE_TYPE_GLOBAL_PACK = "CD";

    /**
     * Possible barcodes series per barcode type.
     */
    const NL_BARCODE_SERIE_SHORT = "0000000-9999999";
    const NL_BARCODE_SERIE = '000000000-999999999';
    const EU_BARCODE_SERIE = '0000000-9999999';
    const GLOBAL_BARCODE_SERIE    = '0000-9999';

    /**
     *Map Country Code to Barcode Type.
     * If country code is present in this array the barcode type should be Global Pack
     * @var array
     */
    private $countryBarcodeType = [
        // Domestic
        'NL' => self::BARCODE_TYPE_DOMESTIC_EPS,
        // EPS
        'AT' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'BE' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'BG' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'CZ' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'CY' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'DK' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'EE' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'FI' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'FR' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'DE' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'GB' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'GR' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'HU' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'IE' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'IT' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'LV' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'LT' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'LU' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'PL' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'PT' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'RO' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'SK' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'SI' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'ES' => self::BARCODE_TYPE_DOMESTIC_EPS,
        'SE' => self::BARCODE_TYPE_DOMESTIC_EPS
    ];
    /**
     *Available barcode types
     * @var array
     */
    private $availableBarcodeTypes = ['2S', self::BARCODE_TYPE_DOMESTIC_EPS, 'CC', 'CP', 'CD', 'CF'];

    /***********************************
     * Barcode Webservice API
     *
     *      - GetBarcode
     *
     * @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/documentation-soap/
     ***********************************/

    /**
     * Generate Barcode by delivery destination
     *
     * @access public
     * @param string $destination
     * @param string $range
     * @return string
     */
    public function getBarcodeByDestination(
        string $destination = 'NL',
        ?string $serie = null,
        ?string $range = null
    ): BarcodeResponse {
        $barcodeType = isset($this->countryBarcodeType[$destination]) ?
            $this->countryBarcodeType[$destination] :
            self::BARCODE_TYPE_GLOBAL_PACK;
        $serieDestination = ($destination == 'NL') ?
            'NL' :
            (($barcodeType === self::BARCODE_TYPE_GLOBAL_PACK) ? 'GLOBAL' : 'EU');
        $serie = !is_null($serie) ? $serie : $this->detectSerie($serieDestination);
        return $this->generateBarcode($barcodeType, $serie, $range, ($destination === 'NL'));
    }

    /**
     * Get Barcode
     *
     * @access public
     * @param string $type
     * @param string $serie
     * @param string $range
     * @param boolean $domestic = domestic (dutch) shipment
     * @return \Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse
     */
    public function getBarcode(
        string $type,
        ?string $serie = null,
        ?string $range = null,
        bool $domestic = true
    ): BarcodeResponse {
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
        return $this->generateBarcode($type, $serie, $range, $domestic);
    }

    /**
     * Request Barcode @PostNL
     *
     * @access public
     * @param string $type
     * @param string $serie
     * @param string $range
     * @param boolean $domestic = domestic (dutch) shipment
     * @return \Avido\PostNLCifClient\Response\SendTrack\Barcode\BarcodeResponse
     */
    public function generateBarcode(
        string $type,
        ?string $serie = null,
        ?string $range = null,
        bool $domestic = true
    ): BarcodeResponse {
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
        if (is_null($range)) {
            $range = $this->getCustomerCode();
        }
        $request = new BarcodeRequest();
        $request->setCustomerCode($range)
            ->setCustomerNumber($this->getCustomerNumber())
            ->setType($type)
            ->setSerie($serie);
        // run request
        $resp = $this->get($request->getEndpoint(), $request->getArguments());
        return new BarcodeResponse($resp);
    }

    /**
     * Detect barcode serie range
     *
     * @access private
     * @param strng $barcodeType
     * @return string
     * @throws CifBarcodeException
     */
    private function detectSerie(string $barcodeType = 'NL'): string
    {
        switch ($barcodeType) {
            case 'NL':
                return self::NL_BARCODE_SERIE;
                break;
            case 'NL-SHORT':
                return self::NL_BARCODE_SERIE_SHORT;
                break;
            case 'EU':
                return self::EU_BARCODE_SERIE;
                break;
            case 'GLOBAL':
                return self::GLOBAL_BARCODE_SERIE;
                break;
            default:
                throw new InvalidBarcodeTypeException(
                    "Invalid barcodetype requested: '{$barcodeType}'"
                );
        }
    }
}
