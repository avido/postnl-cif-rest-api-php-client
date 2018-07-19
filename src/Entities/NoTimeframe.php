<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Timeframe.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Timeframe
  @Dependencies:
 */
use Avido\PostNLCifClient\BaseModel;

use Avido\PostNLCifClient\Util\Date;

class NoTimeframe extends BaseModel
{
    private $options = [];
    
    public function __construct($data = [])
    {
        $this->setDate($data['Date']);
        unset($data['Date']);
        if (isset($data['Options'])) {
            foreach ($data['Options'] as $str => $value) {
                $options[] = $value;
            }
            unset($data['Options']);
        }
        parent::__construct($data);
    }
    
    public function setDate($date)
    {
        if (!$date instanceof Date) {
            $date = new Date($date);
        }
        $this->setData('date', $date);
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function toArray()
    {
        $data = parent::toArray();
        $data['date'] = $this->getDate()->format("Y-m-d");
        return $data;
    }
}
