<?php

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    protected $converter;
    
    public function setup()
    {
        $this->converter = new \Namshi\UtilityBundle\Currency\Converter();
    }
    
    public function testADummyConversion()
    {
        $this->converter->setConversionRates(array('A' => array('B' => 1)));
        
        $this->assertEquals(1, $this->converter->convert(1, "A", "B"));
    }
    
    public function testAConversionWithWeirdValues()
    {
        $this->converter->setConversionRates(array('A' => array('B' => 2)));
        
        $this->assertEquals(5, $this->converter->convert(2.5, "A", "B"));
        $this->assertEquals(50, $this->converter->convert("25", "A", "B"));
        $this->assertEquals(51, $this->converter->convert("25.5", "A", "B"));
    }
    
    /**
     * @expectedException Namshi\UtilityBundle\Exception\CurrencyNotFound
     */
    public function testIfAConversionRateIsNotThereAnExceptionIsThrown()
    {
        $this->converter->setConversionRates(array('A' => array('B' => 2)));
        
        $this->assertEquals(5, $this->converter->convert(2.5, "a", "b"));
    }
    
    /**
     * @expectedException Namshi\UtilityBundle\Exception\CurrencyNotFound
     */
    public function testIfTheFromConversionRateIsNotThereAnExceptionIsThrown()
    {
        $this->converter->setConversionRates(array('A' => array('B' => 2)));
        
        $this->assertEquals(5, $this->converter->convert(2.5, "a", "B"));
    }
    
    /**
     * @expectedException Namshi\UtilityBundle\Exception\CurrencyNotFound
     */
    public function testIfTheToConversionRateIsNotThereAnExceptionIsThrown()
    {
        $this->converter->setConversionRates(array('A' => array('B' => 2)));
        
        $this->assertEquals(5, $this->converter->convert(2.5, "A", "b"));
    }
}