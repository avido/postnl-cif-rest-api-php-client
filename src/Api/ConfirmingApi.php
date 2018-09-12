<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: ConfirmingApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @see https://developer.postnl.nl/browse-apis/send-and-track/confirming-webservice/
  @Description:
        Confirming API
  @Dependencies:
        BaseClient
 */
use Avido\PostNLCifClient\BaseClient;

// exceptions
//use Avido\PostNLCifClient\Exceptions\CifClientException;

// requests
use Avido\PostNLCifClient\Request\SendTrack\Confirming\ConfirmRequest;

// responses
use Avido\PostNLCifClient\Response\SendTrack\Confirming\ConfirmResponse;

class ConfirmingApi extends BaseClient
{
    
    /***********************************
     * Labelling Webservice API
     *
     *      - GenerateLabel
     *
     * @see https://developer.postnl.nl/browse-apis/send-and-track/labelling-webservice/documentation/
     ***********************************/
    
    public function confirm(ConfirmRequest $request, $confirm = false)
    {
        if (!$request->okay()) {
            throw new \Exception("Incomplete request");
        }
        $resp = $this->post($request->getEndpoint(), $request->getBody());
        $pop = array_pop($resp);
        return new ConfirmResponse(isset($pop['ConfirmingResponseShipment']) ?
            $pop['ConfirmingResponseShipment'] :
            []);
    }
}
