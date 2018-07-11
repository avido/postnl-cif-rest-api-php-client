<?php
namespace Avido\PostNLCifClient\Response;
/**
    @File: BaseResponse.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: postnl-cif-rest-api-php-client
    @copyright   Avido
*/

use Avido\PostNLCifClient\BaseModel;

class BaseResponse extends BaseModel
{
    
    public function __construct($data=[])
    {
        parent::__construct($data);
    }
    
}
