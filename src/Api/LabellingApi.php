<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: LabellingApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Labelling API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

// exceptions
use Avido\PostNLCifClient\Exceptions\CifClientException;
use Avido\PostNLCifClient\Exceptions\CifLabellingException;

// entities
use Avido\PostNLCifClient\Entities\Address;
use Avido\PostNLCifClient\Entities\Customer;
use Avido\PostNLCifClient\Entities\Shipment;
use Avido\PostNLCifClient\Entities\LabelMessage;
// requests
use Avido\PostNLCifClient\Request\SendTrack\Labelling\LabelRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse;

class LabellingApi extends BaseClient
{
    
    /***********************************
     * Labelling Webservice API
     *
     *      - GenerateLabel
     *
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     ***********************************/
    
    public function getLabel(LabelRequest $request, $confirm = false)
    {
        try {
            $resp = $this->post($request->getEndpoint() . "?confirm=false", $request->getBody());
            return new LabelResponse(
                isset($resp['ResponseShipments']) ? $resp['ResponseShipments'] : [],
                isset($resp['MergedLabels']) ? $resp['MergedLabels'] : []
            );
        } catch (CifClientException $e) {
            var_dump($e->getMessage());
            exit;
            throw new CifBarcodeException($e->getMessage());
        } catch (\Exception $e) {
            die("SADX " . $e->getMessage());
        }
    }
    /**
     * Get Label
     *
     * @access public
     * @param \Avido\PostNLCifClient\Entities\Shipment $shipment
     * @param string $printer
     * @param boolean $confirm
     * @return \Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse
     */
    public function getLabelBAK(Shipment $shipment, $printer = 'GraphicFile|PDF', $confirm = false)
    {
        try {
            $customer = Customer::create()
                ->setCustomerCode($this->getCustomerCode())
                ->setCustomerNumber($this->getCustomerNumber())
                ->setCollectionLocation($this->getCollectionLocation())
                ->setAddress(Address::create()->setAddressType('02')
                    ->setCity('Hoofddorp')
                    ->setCompanyname('PostNL')
                    ->setCountrycode('NL')
                    ->setHousenumber(42)
                    ->setHousenumberExt('A')
                    ->setStreet('Siriusdreef')
                    ->setZipcode('2132WT')
                )
                ->setContactPerson('Janssen')
                ->setEmail('test@test.nl')
                ->setName('Janssen');
            
            $message = LabelMessage::create()
                ->setMessageId(1)
                ->setPrinterType($printer);
            $request = new LabelRequest();
            $request->setCustomer($customer)
                ->setMessage($message)
                ->addShipment($shipment);
            $resp = $this->post($request->getEndpoint() . "?confirm=false", $request->getBody());
            return new LabelResponse(
                isset($resp['ResponseShipments']) ? $resp['ResponseShipments'] : [],
                isset($resp['MergedLabels']) ? $resp['MergedLabels'] : []
            );
        } catch (CifClientException $e) {
            var_dump($e->getMessage());
            exit;
            throw new CifBarcodeException($e->getMessage());
        } catch (\Exception $e) {
            die("SADX " . $e->getMessage());
        }
    }
}
