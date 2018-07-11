<?php
namespace Avido\PostNLCifClient\Exceptions;
/**
    @File:  CifDeliveryDateException.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido

    Cif Client Exception (Response API)
*/
use \Exception;

class CifDeliveryDateException extends Exception 
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null) 
    {
        if (!empty($message)) {
            $data = json_decode($message, true);
            if (isset($data) && is_array($data)) {
                // message was json formatted.
                if (isset($data['Array']) && isset($data['Array']['Item'])) {
                    // var placeholder
                    $ErrorMsg = $ErrorNumber = null;
                    extract($data['Array']['Item']);
                    parent::__construct($ErrorMsg, $ErrorNumber, $previous);
                }
            } else {
                parent::__construct($message, $code, $previous);
            }
        }
    }
}