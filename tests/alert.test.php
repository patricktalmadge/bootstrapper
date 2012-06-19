<?php namespace Bootstraper;

\Bundle::start('Bootstraper');

use \Bootstraper;

class TestAlert extends \PHPUnit_Framework_TestCase {

	private $message = '<strong>Hello</strong> world!';

	public function testAlertSuccess()
	{
		$return = Alert::success($this->message);
		$this->assertEquals($return, $this->swapReturn('success', $this->message));
	}

	public function testAlertInfo()
	{
		$return = Alert::info($this->message);
		$this->assertEquals($return, $this->swapReturn('info', $this->message));
	}

	public function testAlertWarning()
	{
		$return = Alert::warning($this->message);
		$this->assertEquals($return, $this->swapReturn('warning', $this->message));
	}

	public function testAlertError()
	{
		$return = Alert::error($this->message);
		$this->assertEquals($return, $this->swapReturn('error', $this->message));
	}

	public function testAlertDanger()
	{
		$return = Alert::danger($this->message);
		$this->assertEquals($return, $this->swapReturn('danger', $this->message));
	}

	private function swapReturn($type, $message)
	{
		return '<div class=" alert alert-block alert-'.$type.
			'"><a class="close" data-dismiss="alert" href="#">&times;</a>'.$message.
			'</div>';
	}
}