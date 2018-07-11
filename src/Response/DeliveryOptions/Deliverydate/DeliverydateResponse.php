<?php
namespace Avido\PostNLCifClient\Response\DeliveryOptions\Deliverydate;

/**
  @File: DeliverydateResponse.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Delivery date response
  @Dependencies:
 */
use Avido\PostNLCifClient\Util\Date;

use Avido\PostNLCifClient\Response\BaseResponse;

class DeliverydateResponse extends BaseResponse
{
    public function __construct($data = [])
    {
        $options = [];
        
        $this->setDeliveryDate(new Date($data['DeliveryDate']));
        if (isset($data['Options']) && is_array($data['Options'])) {
            foreach ($data['Options'] as $str => $value) {
                $options[] = $value;
            }
        }
        $this->setOptions($options);
    }
}
