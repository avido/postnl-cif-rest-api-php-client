<?php
namespace Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate;
/**
  @File: ShippingdateResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Shipping date response
  @Dependencies:
 */
use Avido\PostNLCifClient\Util\Date;

use Avido\PostNLCifClient\Response\BaseResponse;

class ShippingdateResponse extends BaseResponse
{
    public function __construct($data = []) 
    {
        $options = [];
        
        $this->setShippingDate(new Date($data['SentDate']));
    }
}
