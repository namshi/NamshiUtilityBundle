<?php

namespace Namshi\UtilityBundle\Currency;

use Namshi\UtilityBundle\Exception\CurrencyNotFound;

/**
 * This class is responsible to handle currency conversions. 
 */
class Converter
{
    /**
     * @var array
     */
    protected $conversionRates = array();

    /**
     * @var int
     */
    protected $roundingPrecision;

    /**
     * Constructor
     *
     * @param array $conversionRates
     * @param int $roundingPrecision
     */
    public function __construct(array $conversionRates = array(), $roundingPrecision = 2)
    {
        $this->setConversionRates($conversionRates);
        $this->setRoundingPrecision($roundingPrecision);
    }

    /**
     * Converts the given $amount from a currency ($from) to another one ($to).
     * Returns values like 205.00 or 207.25
     *
     * @param $amount
     * @param $from
     * @param $to
     * @return string
     */
    public function convert($amount, $from, $to)
    {
        return number_format(round($amount * $this->getConversionRate($from, $to), $this->roundingPrecision), 2, '.', '');
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
     * Sets the rounding precision
     *
     * @param int $roundingPrecision
     */
    public function setRoundingPrecision($roundingPrecision)
    {
        $this->roundingPrecision = $roundingPrecision;
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