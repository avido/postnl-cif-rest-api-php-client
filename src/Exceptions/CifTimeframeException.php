<?php
namespace Avido\PostNLCifClient\Exceptions;

/**
    @File:  CifTimeframeException.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido

    Cif Client Exception (Timeframe API)
*/
use \Exception;

class CifTimeframeException extends Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        if (!empty($message)) {
            $data = json_decode($message, true);
            if (isset($data) && is_array($data)) {
                // var placeholder
                $ErrorMsg = $ErrorNumber = null;
                
                // multiple errors ?
                if (isset($data[0])) {
                    $tmp = [];
                    foreach ($data as $error) {
                        $tmp[] = "{$error['ErrorMsg']} [{$error['ErrorNumber']}]";
                    }
                    parent::__construct(implode(",", $tmp), 1, $previous);
                } else {
                    extract($data);
                    parent::__construct($ErrorMsg, $ErrorNumber, $previous);
                }
            } else {
                parent::__construct($message, $code, $previous);
            }
        }
    }
}
