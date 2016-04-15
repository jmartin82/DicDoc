<?php
namespace Test;

use DicDoc\ParameterInformation;
use PHPUnit_Framework_TestCase;
use Test\Example\TestClass;
use Test\Example\TestClassImplementsOne;
use Test\Example\TestClassImplementsOneAndTwo;


/**
 * Created by PhpStorm.
 * User: jordimartin
 * Date: 12/04/16
 * Time: 16:12
 */
class ParameterInformationTest extends PHPUnit_Framework_TestCase
{

    public function testGetInformationFromPrimitive()
    {
        $i = 1;
        $parameterInformation = new ParameterInformation($i);

        $this->assertEquals("integer", $parameterInformation->getType());
        $this->assertFalse($parameterInformation->isObject());
    }

    public function testGetInformationFromClass()
    {

        $parameterInformation = new ParameterInformation(new TestClass());

        $this->assertEquals("object", $parameterInformation->getType());
        $this->assertEquals("Test\\Example\\TestClass", $parameterInformation->getClassName());
        $this->assertEquals("TestClass", $parameterInformation->getShortClassName());
        $this->assertEquals([], $parameterInformation->getImplements());
        $this->assertTrue($parameterInformation->isObject());
    }

    public function testGetInformationFromClassThatImplementsOne()
    {

        $parameterInformation = new ParameterInformation(new TestClassImplementsOne());

        $this->assertEquals("object", $parameterInformation->getType());
        $this->assertEquals("Test\\Example\\TestClassImplementsOne", $parameterInformation->getClassName());
        $this->assertEquals("TestClassImplementsOne", $parameterInformation->getShortClassName());
        $this->assertContains('Test\Example\InterfaceOne', $parameterInformation->getImplements());
        $this->assertTrue($parameterInformation->isObject());
    }


    public function testGetInformationFromClassThatImplementsTwo()
    {

        $parameterInformation = new ParameterInformation(new TestClassImplementsOneAndTwo());

        $this->assertEquals("object", $parameterInformation->getType());
        $this->assertEquals("Test\\Example\\TestClassImplementsOneAndTwo", $parameterInformation->getClassName());
        $this->assertEquals("TestClassImplementsOneAndTwo", $parameterInformation->getShortClassName());
        $this->assertContains('Test\Example\InterfaceOne', $parameterInformation->getImplements());
        $this->assertContains('Test\Example\InterfaceTwo', $parameterInformation->getImplements());
        $this->assertTrue($parameterInformation->isObject());
    }


}
