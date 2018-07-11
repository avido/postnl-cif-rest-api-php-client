<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: TimeframeWindow.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Timeframe window
  @Dependencies:
 */
use Avido\PostNLCifClient\BaseModel;

class TimeframeWindow extends BaseModel
{
    public function __construct($data = [])
    {
        if (isset($data['Options'])) {
            foreach ($data['Options'] as $str => $value) {
                $options[] = $value;
            }
            $this->setOptions($options);
            unset($data['Options']);
        }
        parent::__construct($data);
    }
}
