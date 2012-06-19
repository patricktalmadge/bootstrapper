<?php namespace Bootstraper;

\Bundle::start('Bootstraper');

class TestForm extends \PHPUnit_Framework_TestCase {


	public function testOk(){
		$this->assertTrue(true);

	}
  //   /**
  //    * Test that a given condition is met.
  //    *
  //    * @return void
  //    */
  //   public function testFormOpen()
  //   {
  //   	$formOpen = Form::open('login', 'POST', array('class' => Form::TYPE_HORIZONTAL));
  //       $this->assertEquals($formOpen, '<form class="form-horizontal" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">');
  //   	$this->assertTrue(Form::needsControlGroup());

  //  		$formOpen = Form::open('login', 'POST', array('class' => Form::TYPE_INLINE));
  //       $this->assertEquals($formOpen, '<form class="form-inline" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">');
  //       $this->assertFalse(Form::needsControlGroup());

  //   	$formOpen = Form::open('login', 'POST', array('class' => Form::TYPE_VERTICAL));
  //       $this->assertEquals($formOpen, '<form class="form-vertical" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">');
  //   	$this->assertFalse(Form::needsControlGroup());

  //  		$formOpen = Form::open('login', 'POST', array('class' => Form::TYPE_SEARCH));
  //       $this->assertEquals($formOpen, '<form class="form-search" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">');
  //       $this->assertFalse(Form::needsControlGroup());

  //       $formOpen = Form::open_secure('login', 'POST', array('class' => Form::TYPE_HORIZONTAL));
  //       $this->assertEquals($formOpen, '<form class="form-horizontal" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">');
  //   	$this->assertTrue(Form::needsControlGroup());

  //   	$formOpen = Form::open_secure('login', 'POST', array('class' => Form::TYPE_INLINE));
  //       $this->assertEquals($formOpen, '<form class="form-inline" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">');
  //       $this->assertFalse(Form::needsControlGroup());
  //   }

  //   public function testFormBuild()
  //   {
  //   	$form = Form::open('login', 'POST');
  //   	$form .= Form::label('user', 'Username');
  //   	$form .= Form::text('user', null, array('class' => 'span3', 'placeholder' => 'Type something...'));

  //   	$testCase = '<form method="POST" action="https://:/index.php/login" accept-charset="UTF-8">
		//   <label for="user">Username</label>
		//   <input class="span3" placeholder="Type something..." type="text" name="user" id="user">
		//   <span class="help-block">Example block-level help text here.</span>
		//   <label class="checkbox">
		//     <input type="checkbox"> Check me out
		//   </label>
		//   <button type="submit" class="btn">Submit</button>
		// </form>';

		// $this->assertEquals($form, $testCase);
  //   }

}