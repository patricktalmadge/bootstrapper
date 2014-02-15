<?php
include_once '_start.php';

use Bootstrapper\Form;
use Bootstrapper\Button;

class FormTest extends BootstrapperWrapper
{
  public function types()
  {
    return array(
      array(
        'search_open',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar">'
      ),
      array(
        'search_open_secure',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar">'
      ),
      array(
        'search_open_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'search_open_secure_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'inline_open',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-inline" data-foo="bar">'
      ),
      array(
        'inline_open_secure',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-inline" data-foo="bar">'
      ),
      array(
        'inline_open_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-inline" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'inline_open_secure_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-inline" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'horizontal_open',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-horizontal" data-foo="bar">'
      ),
      array(
        'horizontal_open_secure',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-horizontal" data-foo="bar">'
      ),
      array(
        'horizontal_open_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-horizontal" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'horizontal_open_secure_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo form-horizontal" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'vertical_open',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar">'
      ),
      array(
        'vertical_open_secure',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar">'
      ),
      array(
        'vertical_open_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar" enctype="multipart/form-data">'
      ),
      array(
        'vertical_open_secure_for_files',
        '<form method="POST" action="http://test/login" accept-charset="UTF-8" class="foo" data-foo="bar" enctype="multipart/form-data">'
      )
    );
  }

  /**
   * @dataProvider types
   */
  public function testFormOpen($type, $expected)
  {
    $form = Form::$type('login', 'POST', $this->testAttributes);
    $this->assertEquals($expected.'<input name="_token" type="hidden" value="foo">', $form);
  }

  public function testInlineHelp()
  {
    $expected = '<span class="foo help-inline" data-foo="bar">foobar</span>';
    $html = Form::inline_help('foobar', $this->testAttributes);
    $this->assertEquals($expected, $html);
  }

  public function testBlockHelp()
  {
    $expected = '<p class="foo help-block" data-foo="bar">foobar</p>';
    $html = Form::block_help('foobar', $this->testAttributes);
    $this->assertEquals($expected, $html);
  }

  public function displaytypes()
  {
    return array(
      array(Form::NORMAL),
      array(Form::WARNING),
      array(Form::ERROR),
      array(Form::SUCCESS),
    );
  }

  /**
   * @dataProvider displaytypes
   */
  public function testControlGroup($displaytype)
  {
    $class = $displaytype;

    if ($displaytype != '') {
      $class = ' '.$displaytype;
    }

    $matcher = array(
      'tag' => 'div',
      'attributes' => array('class' => 'form-group'.$class),
      'child' => array(
        'tag' => 'label',
        'attributes' => array('for' => 'inputfoo'),
        'content' => 'foo',
      ),
      'descendant' => array(
        'tag' => 'input',
        'attributes' => array('type' => 'text', 'name' => 'inputfoo', 'id' => 'inputfoo', 'class' => 'form-control'),
      ),
    );

    $html = Form::control_group(
      Form::label('inputfoo', 'foo'),
      Form::text('inputfoo'),
      $displaytype
    );

    $this->assertHTML($matcher, $html);
  }

  /**
   * @dataProvider displaytypes
   */
  public function testControlGroupFull($displaytype)
  {
    $class = $displaytype;

    if ($displaytype != '') {
      $class = ' '.$displaytype;
    }

    // Had to match label and go up to the parent
    // than back down to get the other elements. Odd but can't
    // figure out how to find 3 different child elements
    $matcher = array(
      'tag' => 'label',
      'attributes' => array('for' => 'inputfoo'),
      'content' => 'foo',
      'parent' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'form-group'.$class),
        'child' => array(
          'tag' => 'input',
          'attributes' => array('type' => 'text', 'name' => 'inputfoo', 'id' => 'inputfoo', 'class' => 'form-control'),
        ),
        'descendant' => array(
          'tag' => 'p',
          'attributes' => array('class'=>'help-block'),
          'content' => 'You foobared that!',
        ),

      ),
    );

    $html = Form::control_group(
      Form::label('inputfoo', 'foo'),
      Form::text('inputfoo'),
      $displaytype,
      Form::block_help('You foobared that!')
    );

    $this->assertHTML($matcher, $html);
  }

  private function getLablledMatcher($type, $value, $full = false)
  {
    $matcher = array(
      'tag' => 'label',
      'attributes' => array('class' => $type),
      'content' => 'foo',
      'child' => array(
        'tag' => 'input',
        'attributes' => array('type' => $type, 'name' => 'foo', 'value' => $value),
      ),
    );

    if ($full) {
      $matcher['child']['attributes']['class'] = 'foo';
      $matcher['child']['attributes']['data-foo'] = 'bar';
      $matcher['child']['attributes']['checked'] = 'checked';
    }

    return $matcher;
  }

  public function testLabelledCheckboxMin()
  {
    $html = Form::labelled_checkbox('foo', 'foo');
    $matcher = $this->getLablledMatcher('checkbox', 1);
    $this->assertHTML($matcher, $html);
  }

  public function testLabelledCheckboxFull()
  {
    $html = Form::labelled_checkbox('foo', 'foo', 'bar', true, $this->testAttributes);
    $matcher = $this->getLablledMatcher('checkbox', 'bar', true);
    $this->assertHTML($matcher, $html);
  }

  public function testInlineLabelledCheckboxMin()
  {
    $html = Form::inline_labelled_checkbox('foo', 'foo');
    $matcher = $this->getLablledMatcher('checkbox', 1);
    $matcher['attributes']['class'] .= '-inline';
    $this->assertHTML($matcher, $html);
  }

  public function testInlineLabelledCheckboxFull()
  {
    $html = Form::inline_labelled_checkbox('foo', 'foo', 'bar', true, $this->testAttributes);
    $matcher = $this->getLablledMatcher('checkbox', 'bar', true);
    $matcher['attributes']['class'] .= '-inline';
    $this->assertHTML($matcher, $html);
  }

  public function testLabelledRadioMin()
  {
    $html = Form::labelled_radio('foo', 'foo');
    $matcher = $this->getLablledMatcher('radio', 1);
    $this->assertHTML($matcher, $html);
  }

  public function testLabelledRadioFull()
  {
    $html = Form::labelled_radio('foo', 'foo', 'bar', true, $this->testAttributes);
    $matcher = $this->getLablledMatcher('radio', 'bar', true);
    $this->assertHTML($matcher, $html);
  }

  public function testInlineLabelledRadioMin()
  {
    $html = Form::inline_labelled_radio('foo', 'foo');
    $matcher = $this->getLablledMatcher('radio', 1);
    $matcher['attributes']['class'] .= '-inline';
    $this->assertHTML($matcher, $html);
  }

  public function testInlineLabelledRadioFull()
  {
    $html = Form::inline_labelled_radio('foo', 'foo', 'bar', true, $this->testAttributes);
    $matcher = $this->getLablledMatcher('radio', 'bar', true);
    $matcher['attributes']['class'] .= '-inline';
    $this->assertHTML($matcher, $html);
  }

  public function testMultiSelectMin()
  {
    $html = Form::multiselect('multiSelect', array('1', '2', '3', '4', '5'));

    $matcher = array(
      'tag' => 'select',
      'attributes' => array('class' => 'form-control', 'multiple' => 'multiple', 'name' => 'multiSelect'),
      'children' => array(
        'count' => 5,
        'only' => array(
          'tag' => 'option'
        ),
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  public function testMultiSelectFull()
  {
    $html = Form::multiselect('multiSelect', array('1', '2', '3', '4', '5'), '3', $this->testAttributes);

    $matcher = array(
      'tag' => 'select',
      'attributes' => array('class' => 'form-control foo', 'multiple' => 'multiple', 'name' => 'multiSelect'),
      'children' => array(
        'count' => 5,
        'only' => array(
          'tag' => 'option'
        ),
      ),
      'child' => array(
        'tag' => 'option',
        'attributes' => array('value' => 3, 'selected' => 'selected'),
      )
    );

    $this->assertHTML($matcher, $html);
  }

  public function testUneditable()
  {
    $html = Form::uneditable('foo', $this->testAttributes);
    $expected = '<span class="foo uneditable-input" data-foo="bar">foo</span>';

    $this->assertEquals($expected, $html);
  }

  public function testFile()
  {
    $html = Form::file('foo', $this->testAttributes);
    $expected = '<input class="foo input-file" data-foo="bar" name="foo" type="file">';

    $this->assertEquals($expected, $html);
  }

  public function testSearchBox()
  {
    $html = Form::search_box('foo', 'bar', $this->testAttributes);
    $expected = '<input class="foo search-query form-control" data-foo="bar" name="foo" type="text" value="bar">';

    $this->assertEquals($expected, $html);
  }

  public function testActionBar()
  {
    $html = Form::actions(array(Button::primary_submit('Save changes'), Form::button('Cancel')));

    $matcher = array(
      'tag' => 'div',
      'attributes' => array('class' => 'form-control'),
      'child' => array(
        'tag' => 'button',
        'attributes' => array('class' => 'btn-primary btn', 'type' => 'submit'),
        'content' => 'Save changes',
      ),
      'descendant' => array(
        'tag' => 'button',
        'attributes' => array('class' => 'btn', 'type' => 'button'),
        'content' => 'Cancel',
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  private function paMatcher()
  {
    // <div class="input-group">
    // <select class="form-control">
    //   <option>hi</option>
    //   <option>hi2</option>
    // </select>
    // <div class="input-group-btn">
    //   <input class="btn btn-default" value="valami" type="submit">
    // </div>
    //</div>
    return array(
      'tag' => 'div',
      'attributes' => array('class' => 'input-group'),
      'descendant' => array(
        'tag' => 'input',
        'attributes' => array(
          'type' => 'text', 'name' => 'inputfoo'
        ),
      ),
      'child' => array(
        'tag' => 'span',
        'attributes' => array(
          'class' => 'input-group-addon'
        ),
        'content' => '$',
      )
    );
  }

  public function testLabel()
  {
    $html = Form::label('foo');
    $matcher = array(
      'tag' => 'label',
      'attributes' => array('for' => 'foo', 'class' => 'control-label')
    );
    $this->assertHTML($matcher, $html);
  }


  public function testPrepend()
  {
    $html = Form::prepend(Form::text('inputfoo'), '$');
    $matcher = $this->paMatcher();
    $this->assertHTML($matcher, $html);
  }

  public function testAppend()
  {
    $html = Form::append(Form::text('inputfoo'), '$');
    $matcher = $this->paMatcher();
    $this->assertHTML($matcher, $html);
  }

  public function testPrependAppend()
  {
    $html = Form::prepend_append(Form::text('inputfoo'), '$', '.00');

    $matcher = array(
      'tag' => 'input',
      'attributes' => array('type' => 'text', 'name' => 'inputfoo'),
      'parent' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'input-group'),
        'child' => array(
          'tag' => 'span',
          'attributes' => array('class' => 'input-group-addon'),
          'content' => '$',
        ),
        'descendant' => array(
          'tag' => 'span',
          'attributes' => array('class' => 'input-group-addon'),
          'content' => '.00',
        ),
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  public function testAppendButton()
  {
    $html = Form::append_buttons(Form::text('appendedInputButton'), Form::button('Go!'));

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'input-group'
      ),
      'child' => array(
        'tag' => 'input',
        'attributes' => array(
          'class' => 'form-control',
          'type' => 'text',
          'name' => 'appendedInputButton'),
      ),
      'descendant' => array(
        'tag' => 'span',
        'attributes' => array(
          'class' => 'input-group-btn'
        ),
        'child' => array(
          'tag' => 'button',
          'attributes' => array(
            'class' => 'btn-default btn',
            'type' => 'button'),
          'content' => 'Go!',
        )
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  public function testAppendButtons()
  {
    $html = Form::append_buttons(Form::text('appendedInputButton'), array(Form::button('Search'),Form::button('Options')));

    $matcher = array(
      'tag' => 'button',
      'attributes' => array(
        'class' => 'btn-default btn',
        'type' => 'button'),
      'content' => 'Search',
      'parent' => array(
        'tag' => 'span',
        'attributes' => array(
          'class' => 'input-group-btn'
        ),
        'parent' => array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'input-group'
          ),
          'child' => array(
            'tag' => 'input',
            'attributes' => array(
              'class' => 'form-control',
              'type' => 'text',
              'name' => 'appendedInputButton'),
          ),
          'descendant' => array(
            'tag' => 'span',
            'attributes' => array(
              'class' => 'input-group-btn'
            ),
            'child' => array(
              'tag' => 'button',
              'attributes' => array(
                'class' => 'btn-default btn',
                'type' => 'button'
              ),
              'content' => 'Options',
            ),
          ),
        ),
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  public function testPrependButton()
  {
    $html = Form::prepend_buttons(Form::text('appendedInputButton'), Form::button('Go!'));

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'input-group'
      ),
      'child' => array(
        'tag' => 'input',
        'attributes' => array(
          'class' => 'form-control',
          'type' => 'text',
          'name' => 'appendedInputButton'),
      ),
      'descendant' => array(
        'tag' => 'span',
        'attributes' => array(
          'class' => 'input-group-btn'
        ),
        'child' => array(
          'tag' => 'button',
          'attributes' => array(
            'class' => 'btn-default btn',
            'type' => 'button'),
          'content' => 'Go!',
        )
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  public function testPrependButtons()
  {
    $html = Form::prepend_buttons(Form::text('appendedInputButton'), array(Form::button('Search'),Form::button('Options')));



    $matcher = array(
      'tag' => 'button',
      'attributes' => array(
        'class' => 'btn-default btn',
        'type' => 'button'),
      'content' => 'Search',
      'parent' => array(
        'tag' => 'span',
        'attributes' => array(
          'class' => 'input-group-btn'
        ),
        'parent' => array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'input-group'
          ),
          'child' => array(
            'tag' => 'input',
            'attributes' => array(
              'class' => 'form-control',
              'type' => 'text',
              'name' => 'appendedInputButton'),
          ),
          'descendant' => array(
            'tag' => 'span',
            'attributes' => array(
              'class' => 'input-group-btn'
            ),
            'child' => array(
              'tag' => 'button',
              'attributes' => array(
                'class' => 'btn-default btn',
                'type' => 'button'
              ),
              'content' => 'Options',
            ),
          ),
        ),
      ),
    );

    $this->assertHTML($matcher, $html);
  }

  private function createButtonMatcher($type)
  {
    return array(
      'tag' => 'button',
      'attributes' => array(
        'type'     => $type,
        'data-foo' => 'bar',
        'class'    => 'foo btn btn-default'),
      'content' => 'foo',
    );
  }

  public function testSubmitButton()
  {
    $html = Form::submit('foo', $this->testAttributes);
    $matcher = $this->createButtonMatcher('submit');
    $this->assertHTML($matcher, $html);
  }

  public function testResetButton()
  {
    $html = Form::reset('foo', $this->testAttributes);
    $matcher = $this->createButtonMatcher('reset');
    $this->assertHTML($matcher, $html);
  }

  public function testButton()
  {
    $html = Form::button('foo', $this->testAttributes);
    $matcher = $this->createButtonMatcher('button');
    $this->assertHTML($matcher, $html);
  }

  public function sizes()
  {
    $sizes = array(
      array('mini'),
      array('small'),
      array('medium'),
      array('large'),
      array('xlarge'),
      array('xxlarge'),
    );

    for ($i = 1; $i <= 12; $i++) {
      $sizes[] = array('span'.$i);
    }

    return $sizes;
  }
  // 'mini', 'small', 'medium', 'large', 'xlarge', 'xxlarge',

  // 'input', 'text', 'password', 'uneditable', 'select', 'multiselect', 'file', 'textarea', 'date', 'number', 'url', 'telephone', 'email', 'search'


  private function createMagicClass($size)
  {
    $class = $size;
    if (!stristr($size, 'span')) {
      $class = 'input-'.$size;
    }

    return $class;
  }

  /**
   * @dataProvider sizes
   */
  public function testPasswordFileSizes($size)
  {
    $types = array('password', 'file');

    $class = $this->createMagicClass($size);
    foreach ($types as $type) {
      $matcher = array(
        'tag' => 'input',
        'attributes' => array(
          'type'     => $type,
          'data-foo' => 'bar',
          'name'     => 'foo',
          'class'    => 'foo '.$class,
        ),
      );

      $m = $size.'_'.$type;

      $html = Form::$m('foo', $this->testAttributes);
      $this->assertHTML($matcher, $html);
    }
  }

  /**
   * @dataProvider sizes
   */
  public function testUneditableSizes($size)
  {
    $class = $this->createMagicClass($size);

    $matcher = array(
      'tag' => 'span',
      'content'  => 'foo',
      'attributes' => array(
        'class'    => 'foo '.$class.' uneditable-input',
        'data-foo' => 'bar',
      ),
    );

    $m = $size.'_uneditable';
    $html = Form::$m('foo', $this->testAttributes);
    $this->assertHTML($matcher, $html);
  }

  /**
   * @dataProvider sizes
   */
  public function testInputSizes($size)
  {
    $class = $this->createMagicClass($size);

    $matcher = array(
      'tag' => 'input',
      'attributes' => array(
        'type'     => 'text',
        'data-foo' => 'bar',
        'name'     => 'foo',
        'value'    => 'hi',
        'class'    => 'foo '.$class,
      ),
    );

    $m = $size.'_input';

    $html = Form::$m('text', 'foo', 'hi', $this->testAttributes);
    $this->assertHTML($matcher, $html);
  }

  /**
   * @dataProvider sizes
   */
  public function testSelectMultiSelectSizes($size)
  {
    $types = array('select', 'multiselect');

    $class = $this->createMagicClass($size);
    foreach ($types as $type) {
      $matcher = array(
        'tag' => 'select',
        'attributes' => array(
          'name' => 'foo',
          'data-foo' => 'bar',
          'class'    => 'foo',
        ),
        'children' => array(
          'count' => 5,
          'only' => array(
            'tag' => 'option'
          ),
        ),
        'child' => array(
          'tag' => 'option',
          'attributes' => array('value' => 3, 'selected' => 'selected'),
        )
      );

      if ($type === 'multiselect') {
        $matcher['attributes']['multiple'] = 'multiple';
      }

      $m = $size.'_'.$type;

      $html = Form::$m('foo', array('1', '2', '3', '4', '5'), '3', $this->testAttributes);
      $this->assertHTML($matcher, $html);
    }
  }

  /**
   * @dataProvider sizes
   */
  public function testTextareaSizes($size)
  {
    $class = $this->createMagicClass($size);

    $matcher = array(
      'tag' => 'textarea',
      'content'  => 'foobared',
      'attributes' => array(
        'name'     => 'foo',
        'class'    => 'foo '.$class,
        'data-foo' => 'bar',
        'rows'     => 10,
        'cols'     => 50,
      ),
    );

    $m = $size.'_textarea';
    $html = Form::$m('foo', 'foobared', $this->testAttributes);
    $this->assertHTML($matcher, $html);
  }

  /**
   * @dataProvider sizes
   */
  public function testOtherInputSizes($size)
  {
    $types = array('text', 'date', 'number', 'url', 'tel', 'email', 'search');

    $class = $this->createMagicClass($size);
    foreach ($types as $type) {
      $dataType = $type === 'telephone' ? 'tel' : $type;
      $matcher = array(
        'tag' => 'input',
        'attributes' => array(
          'type'     => $dataType,
          'data-foo' => 'bar',
          'value'    => 'hi',
          'name'     => 'foo',
          'class'    => 'foo '.$class,
        ),
      );

      $m = $size.'_'.$type;
      $html = Form::$m('foo', 'hi', $this->testAttributes);
      $this->assertHTML($matcher, $html);
    }
  }

  public function testMacro()
  {
    $this->markTestSkipped('Waiting for a fix on Power Pack Form class');

    Form::macro('foo', function() {
      return '<article type="bar">';
    });

    $html =  Form::foo();
    $expected = '<article type="bar">';
    $this->assertEquals($expected, $html);
  }

  public function testCreateControlGroupWithOffsets() {
    $matcher = array(
      'tag' => 'div',
      'attributes' => array('class' => 'form-group'),
      'child' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'col-sm-2'),
        'child' => array(
          'tag' => 'label',
          'attributes' => array('for' => 'inputfoo'),
          'content' => 'foo',
        ),
      ),
      'descendant' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'col-sm-10'),
        'child' => array(
          'tag' => 'input',
          'attributes' => array('type' => 'text', 'name' => 'inputfoo', 'id' => 'inputfoo', 'class' => 'form-control'),
        ),
      ),
    );

    $html = Form::control_group(
      Form::label('inputfoo', 'foo'),
      Form::text('inputfoo'),
      null,
      null,
      2
    );

    $this->assertHTML($matcher, $html);
  }

  public function testCreateFullControlGroupWithOffsets() {
    $matcher = array(
      'tag' => 'div',
      'attributes' => array('class' => 'col-sm-2'),
      'child' => array(
        'tag' => 'label',
        'attributes' => array('for' => 'inputfoo'),
        'content' => 'foo',
      ),
      'parent' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'form-group'),
        'child' => array(
          'tag' => 'div',
          'attributes' => array('class' => 'col-sm-10'),
          'child' => array(
            'tag' => 'input',
            'attributes' => array('type' => 'text', 'name' => 'inputfoo', 'id' => 'inputfoo', 'class' => 'form-control'),
          ),
        ),
        'descendant' => array(
          'tag' => 'div',
          'attributes' => array('class' => 'col-sm-10'),
          'child' => array(
            'tag' => 'p',
            'attributes' => array('class'=>'help-block'),
            'content' => 'You foobared that!',
          ),
        ),
      ),
    );

    $html = Form::control_group(
      Form::label('inputfoo', 'foo'),
      Form::text('inputfoo'),
      null,
      Form::block_help('You foobared that!'),
      2
    );

    $this->assertHTML($matcher, $html);
  }

}
