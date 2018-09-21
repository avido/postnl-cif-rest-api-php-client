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
//use Avido\PostNLCifClient\Exceptions\CifClientException;

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
        // Postnl expects a string.....
        $confirm = ($confirm === true) ? 'true' : 'false';
        $resp = $this->post($request->getEndpoint() . "?confirm={$confirm}", $request->getBody());
        return new LabelResponse(
            isset($resp['ResponseShipments']) ? $resp['ResponseShipments'] : [],
            isset($resp['MergedLabels']) ? $resp['MergedLabels'] : []
        );
    }
}
