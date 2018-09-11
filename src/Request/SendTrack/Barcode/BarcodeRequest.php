<?php
namespace Avido\PostNLCifClient\Request\SendTrack\Barcode;

/**
    @File: BarcodeRequest.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/documentation-soap/
    @copyright   Avido

    Barcode Request Object
*/

use Avido\PostNLCifClient\Request\BaseRequest;

class BarcodeRequest extends BaseRequest
{
    private $endpoint = 'shipment';
    private $path = 'barcode';
    private $version = '1_1';

    public function __construct()
    {
        parent::__construct($this->endpoint, $this->path, $this->version);
        // or
//        $this->setEndpoint('shipment')
//        ->setPath('path')
//            ->setVersion('2_1');
        $this->arguments = [
            'customer_code' => null,
            'customer_number' => null,
            'type' => null,
            'serie' => null
        ];
    }
    
    /**
     * Set Customer Code
     *
     * Customer code as known at PostNL Pakketten
     *
     * @access public
     * @param string $customer_code
     * @return $this
     */
    public function setCustomerCode($customer_code)
    {
        $this->arguments['customer_code'] = $customer_code;
        return $this;
    }
    
    /**
     * Set Customer Number
     *
     * Customer number as known at PostNL Pakketten
     *
     * @access public
     * @param string $customer_number
     * @return $this
     */
    public function setCustomerNumber($customer_number)
    {
        $this->arguments['customer_number'] = $customer_number;
        return $this;
    }
    
    /**
     * Set Type of barcode
     *
     * Accepted values: 2S, 3S, CC, CP, CD, CF
     * see documention page for more detailed information
     *
     * @access public
     * @see https://developer.postnl.nl/browse-apis/send-and-track/barcode-webservice/documentation-soap/
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->arguments['type'] = $type;
        return $this;
    }
    
    /**
     * Set Barcode Serie
     *
     * Barcode serie in the format '###000000-###000000’, for example 100000-20000. The range must
     * consist of a minimal difference of 100.000. Minimum length of the serie is 6 characters; maximum
     * length is 9 characters. It is allowed to add extra leading zeros at the beginning of the serie.
     * See Guidelines for more information.
     *
     * @access public
     * @param string $serie
     * @return $this
     */
    public function setSerie($serie)
    {
        $this->arguments['serie'] = $serie;
        return $this;
    }
}
