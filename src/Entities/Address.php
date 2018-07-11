<?php
namespace Avido\PostNLCifClient\Entities;

/**
  @File: Address.php
  @version 0.1.0
  @Encoding:  UTF-8
  @Package: postnl-cif-rest-api-php-client
  @copyright   Avido
  @Modified:
  @Description:
        Location Address
  @Dependencies:
        BaseModel
 */

use Avido\PostNLCifClient\BaseModel;

class Address extends BaseModel
{
    public function __construct($data = [])
    {
        parent::__construct($data);
    }
}
