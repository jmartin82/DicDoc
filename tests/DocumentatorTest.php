<?php
namespace Test;

use DicDoc\CallerPosition;
use DicDoc\Documentator;
use DicDoc\ParameterInformation;
use PHPUnit_Framework_TestCase;
use Test\Example\TestClass;

class DocumentatorTest extends PHPUnit_Framework_TestCase {

	public function testCorrectCall() {

		$testClass = new TestClass();
		$parameterInformation = new ParameterInformation($testClass);
		$offset = 1;
		$filePos = 33;
		$fileName = "file";
		$callerPosition = new CallerPosition($fileName, $filePos);
		$comment = "comment";

		$parameterCommentGenerator = $this->getMockBuilder('DicDoc\Interfaces\ParameterDocumentator')
			->setMethods(array('docBlock'))
			->getMock();

		$parameterCommentGenerator->expects($this->once())
			->method('docBlock')
			->with($this->equalTo($parameterInformation))
			->willReturn($comment);

		$commentAppender = $this->getMockBuilder('DicDoc\Interfaces\TextFileManipulator')
			->setMethods(array('insertComment'))
			->getMock();

		$commentAppender->expects($this->once())
			->method('insertComment')
			->with($this->equalTo($fileName),
				$this->equalTo($comment),
				$this->equalTo($offset + $filePos));

		$documentator = new Documentator($commentAppender, $parameterCommentGenerator);
		$documentator->document($parameterInformation, $callerPosition, $offset);

	}

}
