<?php
namespace Test;

use DicDoc\CallerPosition;
use DicDoc\CommentLineAppender;
use PHPUnit_Framework_TestCase;

class CommentLineAppenderTest extends PHPUnit_Framework_TestCase {

	public $testFilePath;
	public $emptyFilePath;

	public function setup() {
		$this->testFilePath = tempnam(sys_get_temp_dir(), 'TC');
		file_put_contents($this->testFilePath, "LINE1\nLINE2\nLINE3\nLINE4");
		$this->emptyFilePath = tempnam(sys_get_temp_dir(), 'TC');
		file_put_contents($this->emptyFilePath, "");
	}

	public function tearDown() {
		unlink($this->testFilePath);
		unlink($this->emptyFilePath);
	}

	public function testAddComment() {
		$callerPosition = new CallerPosition($this->testFilePath, 2);
		$fileCommenter = new CommentLineAppender();
		$fileCommenter->insertComment($callerPosition->getFile(),"##COMMENT##",$callerPosition->getLine());
		$this->assertEquals("LINE1\n##COMMENT##\nLINE2\nLINE3\nLINE4", file_get_contents($this->testFilePath));

	}

	public function testAddCommentWithOverFlowPosition() {
		$callerPosition = new CallerPosition($this->testFilePath, 99);
		$fileCommenter = new CommentLineAppender();
		$fileCommenter->insertComment($callerPosition->getFile(),"##COMMENT##",$callerPosition->getLine());
		$this->assertEquals("LINE1\nLINE2\nLINE3\nLINE4", file_get_contents($this->testFilePath));
	}

	public function testAddCommentOnMissingFile() {
                $callerPosition = new CallerPosition("/sdfsd/sfsdf/fsfd", 2);
				$fileCommenter = new CommentLineAppender();
		$this->assertFalse($fileCommenter->insertComment($callerPosition->getFile(),"##COMMENT##",$callerPosition->getLine()));
		
	}

	public function testAddCommentOnFirstLine() {
                $callerPosition = new CallerPosition($this->testFilePath, 1);
		$fileCommenter = new CommentLineAppender();
			$fileCommenter->insertComment($callerPosition->getFile(),"##COMMENT##",$callerPosition->getLine());
		$this->assertEquals("##COMMENT##\nLINE1\nLINE2\nLINE3\nLINE4", file_get_contents($this->testFilePath));;
	}

	public function testAddCommentOnLastLine() {
                $callerPosition = new CallerPosition($this->testFilePath, 4);
		$fileCommenter = new CommentLineAppender();
				$fileCommenter->insertComment($callerPosition->getFile(),"##COMMENT##",$callerPosition->getLine());
		$this->assertEquals("LINE1\nLINE2\nLINE3\n##COMMENT##\nLINE4", file_get_contents($this->testFilePath));

	}

}
