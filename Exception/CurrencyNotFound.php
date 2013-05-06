<?php

namespace Namshi\UtilityBundle\Exception;

use Exception;

/**
 * Exception throw is a currency is not found by the currency converter. 
 */
class CurrencyNotFound extends Exception
{
    const ERROR_MESSAGE = 'The currency "%s" is not available';
    
    public function __construct($currency)
    {
        $this->message = sprintf(self::ERROR_MESSAGE, $currency);
    }
}