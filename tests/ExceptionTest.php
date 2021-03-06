<?php

use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
	public function testException()
	{
		$e = new \Useful\Exception('test', 2);
		$this->assertInstanceOf('\Useful\Exception', $e);
		$this->assertInstanceOf('\Exception', $e);
		$this->assertEquals('test', $e->getMessage());
		$this->assertEquals(2, $e->getCode());

		$e1 = new \Exception('first');

		$e = new \Useful\Exception('test', 2, $e1);
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals(null, $e->getData());

		$e = new \Useful\Exception('test', 2, 'data');
		$this->assertEquals(null, $e->getPreviousException());
		$this->assertEquals('data', $e->getData());

		$e = new \Useful\Exception('test', 2, null, $e1);
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals(null, $e->getData());

		$e = new \Useful\Exception('test', 2, null, 'data');
		$this->assertEquals(null, $e->getPreviousException());
		$this->assertEquals('data', $e->getData());

		$e = new \Useful\Exception('test', 2, $e1, 'data');
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals('data', $e->getData());

		$e = new \Useful\Exception('test', 2, 'data', $e1);
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals('data', $e->getData());

		$e = new \Useful\Exception(
			'test',
			2,
			array(
				'a' => 'data',
				'exception' => $e1,
			)
		);
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals(array('a' => 'data'), $e->getData());
		$this->assertEquals('data', $e->getData('a'));
		$this->assertEquals(null, $e->getData('b'));

		$e = new \Useful\Exception(
			'test',
			2,
			array(
				'a' => 'data',
				'error' => $e1,
			)
		);
		$this->assertEquals($e1, $e->getPreviousException());
		$this->assertEquals(array('a' => 'data'), $e->getData());
		$this->assertEquals('data', $e->getData('a'));
		$this->assertEquals(null, $e->getData('b'));
    }
}
