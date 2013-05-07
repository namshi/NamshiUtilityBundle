<?php

namespace Namshi\UtilityBundle\Currency;

use Namshi\UtilityBundle\Exception\CurrencyNotFound;

/**
 * This class is responsible to handle currency conversions. 
 */
class Converter
{
    protected $conversionRates = array();
    
    /**
     * Constructor.
     * 
     * @param array $conversionRates 
     */
    public function __construct(array $conversionRates = array())
    {
        $this->setConversionRates($conversionRates);
    }
    
    /**
     * Converts the given $amount from a currency ($from) to another one ($to).
     * 
     * @param mixed $amount
     * @param string $from
     * @param string $to 
     * @throws Namshi\UtilityBundle\Exception\CurrencyNotFound
     */
    public function convert($amount, $from, $to)
    {        
        return $amount * $this->getConversionRate($from, $to);
    }
    
    /**
     * Sets the conversion rates to be used by the converter.
     * 
     * @param array $conversionRates 
     */
    public function setConversionRates(array $conversionRates = array())
    {
        $this->conversionRates = $conversionRates;
    }
    
    /**
     * Gets the conversion rate from 2 currencies.
     * If currencies are the same, 1 will be returned by default.
     * 
     * @param string $from
     * @param string $to
     * @return int
     * @throws CurrencyNotFound 
     */
    protected function getConversionRate($from, $to)
    {
        if ($from === $to) {
            return 1;
        }
        
        if (!isset($this->conversionRates[$from])) {
            throw new CurrencyNotFound($from);
        }
        
        if (!isset($this->conversionRates[$from][$to])) {
            throw new CurrencyNotFound($to);
        }
        
        return $this->conversionRates[$from][$to];
    }
}