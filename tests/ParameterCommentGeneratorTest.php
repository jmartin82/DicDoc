<?php
namespace Test;

use PHPUnit_Framework_TestCase;

/**
 * Created by PhpStorm.
 * User: jordimartin
 * Date: 12/04/16
 * Time: 16:11
 */
class ParameterCommentGeneratorTest extends PHPUnit_Framework_TestCase {

    public function testCreateCommentForPrimitive() {
        // Create a stub for the SomeClass class.
        $parameterMock = $this->getMockBuilder('\DicDoc\ParameterInformation')
                ->disableOriginalConstructor()
                //->setMethods(["getImplements","getShortClassName","getType", "getClassName","isObject"])
                ->getMock();

        $parameterMock->method('isObject')
                ->willReturn(false);

        $parameterMock->method('getType')
                ->willReturn("int");

        $parameterCommentGenerator = new \DicDoc\ParameterCommentGenerator();
          $this->assertEquals("/** @var int */", $parameterCommentGenerator->docBlock($parameterMock));
    }

      public function testCreateCommentClass() {
        // Create a stub for the SomeClass class.
        $parameterMock = $this->getMockBuilder('\DicDoc\ParameterInformation')
                ->disableOriginalConstructor()
                //->setMethods(["getImplements","getShortClassName","getType", "getClassName","isObject"])
                ->getMock();

        $parameterMock->method('isObject')
                ->willReturn(true);

        $parameterMock->method('getClassName')
                ->willReturn("namespace\\FooClass");

        $parameterMock->method('getImplements')
                ->willReturn([]);

        $parameterMock->method('getShortClassName')
                ->willReturn("FooClass");

        $parameterCommentGenerator = new \DicDoc\ParameterCommentGenerator();
        $this->assertEquals("/** @var \\namespace\\FooClass \$fooClass */", $parameterCommentGenerator->docBlock($parameterMock));
    }

    public function testCreateCommentInterface() {
        // Create a stub for the SomeClass class.
        $parameterMock = $this->getMockBuilder('\DicDoc\ParameterInformation')
                ->disableOriginalConstructor()
                //->setMethods(["getImplements","getShortClassName","getType", "getClassName","isObject"])
                ->getMock();

        $parameterMock->method('isObject')
                ->willReturn(true);

        $parameterMock->method('getClassName')
                ->willReturn("namespace\\FooClass");

        $parameterMock->method('getImplements')
                ->willReturn(["Contable"]);

        $parameterMock->method('getShortClassName')
                ->willReturn("FooClass");

        $parameterCommentGenerator = new \DicDoc\ParameterCommentGenerator();
        $this->assertEquals("/** @var \\Contable \$fooClass */", $parameterCommentGenerator->docBlock($parameterMock));
    }

    public function testCreateCommentTwoInterface() {
        // Create a stub for the SomeClass class.
        $parameterMock = $this->getMockBuilder('\DicDoc\ParameterInformation')
                ->disableOriginalConstructor()
                //->setMethods(["getImplements","getShortClassName","getType", "getClassName","isObject"])
                ->getMock();

        $parameterMock->method('isObject')
                ->willReturn(true);

        $parameterMock->method('getClassName')
                ->willReturn("\\namespace\\FooClass");

        $parameterMock->method('getImplements')
                ->willReturn(["Contable", "ArrayAcess"]);

        $parameterMock->method('getShortClassName')
                ->willReturn("FooClass");

        $parameterCommentGenerator = new \DicDoc\ParameterCommentGenerator();
        $this->assertEquals("/** @var \\Contable|\\ArrayAcess \$fooClass */", $parameterCommentGenerator->docBlock($parameterMock));
    }

}
