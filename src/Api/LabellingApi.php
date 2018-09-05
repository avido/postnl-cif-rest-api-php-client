<?php
namespace Avido\PostNLCifClient\Api;

/**
  @File: LabellingApi.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Date:  Sep 4, 2018
  @Package: postnl-cif-rest-api-php-client
  @copyright   Budgetlens B.V.
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
    
    /**
     * Get Label
     *
     * @access public
     * @param \Avido\PostNLCifClient\Request\SendTrack\Labelling\LabelRequest $request
     * @return \Avido\PostNLCifClient\Response\SendTrack\Labelling\LabelResponse
     */
    public function getLabel(LabelRequest $request)
    {
        try {
            $resp = $this->get($request->getEndpoint(), $request->getArguments());
            return new BarcodeResponse($resp);
        } catch (CifClientException $e) {
            throw new CifBarcodeException($e->getMessage());
        }
    }
}
