<?php
namespace Test;
use DicDoc\BackTraceCallerPositionFinder;
use PHPUnit_Framework_TestCase;

class BackTraceCallerPositionFinderTest extends PHPUnit_Framework_TestCase {

	public function funcTest() {
		$callerResolver = new BackTraceCallerPositionFinder();
		return $callerResolver->getCallerPosition();
	}

	public function testGetCallerData() {
		$foo = true;
		$caller = $this->funcTest($foo);
		$this->assertEquals(__FILE__, $caller->getFile());
		$this->assertEquals(15, $caller->getLine());
	}

	public function testCallerDataInnerClass() {
		$inner = function () {
			$inner2 = function () {
				$inner3 = function () {
					$inner4 = function () {
						$inner5 = function () {
							return $this->funcTest($var = true);
						};
						return $inner5();
					};
					return $inner4();
				};
				return $inner3();
			};
			return $inner2();
		};
		$caller = $inner();
		$this->assertEquals(__FILE__, $caller->getFile());
		$this->assertEquals(26, $caller->getLine());
	}

	/**
	 * @expectedException \DicDoc\Exceptions\CallerResolverException
	 */
	public function testNotCallerFound() {
		$callerResolver = new BackTraceCallerPositionFinder(1);
		$callerResolver->getCallerPosition();
	}
}
?>