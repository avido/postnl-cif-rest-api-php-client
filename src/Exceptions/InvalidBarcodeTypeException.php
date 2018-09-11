<?php
namespace Avido\PostNLCifClient\Exceptions;

/**
    @File:  InvalidBarcodeTypeException.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido

    Invalid Barcode Type Exception
*/
use \Exception;

class InvalidBarcodeTypeException extends Exception
{
    public function __construct($type)
    {
        parent::__construct("'{$type}' is not a valid barcode type.");
    }
}
