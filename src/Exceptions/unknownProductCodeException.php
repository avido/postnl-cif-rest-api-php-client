<?php
namespace Avido\PostNLCifClient\Exceptions;

/**
    @File:  unknownProductCodeException.php
    @version 0.1.0
    @Encoding:  UTF-8
    @Package: PostNL Cif Rest API PHP Client
    @copyright   Avido

    Unknown Product code exception
*/
use \Exception;

class unknownProductCodeException extends Exception
{
    public function __construct($code)
    {
        parent::__construct("'{$code}' is not a valid product delivery code.");
    }
}
