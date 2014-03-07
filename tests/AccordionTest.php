<?php

include_once '_start.php';


use Bootstrapper\Accordion;

class AccordionTest extends BootstrapperWrapper
{

  public function getMatcher() {
    return array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'panel-group',
        'id' => 'test'
      ),
      'child' => array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'panel panel-default'
        ),
        'child' => array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'panel-heading'
          ),
          'child' => array(
            'tag' => 'h4',
            'attributes' => array(
              'class' => 'panel-title'
            ),
            'child' => array(
              'tag' => 'a',
              'attributes' => array(
                'class' => 'accordion-toggle',
                'data-toggle' => 'collapse',
                'data-parent' => '#test',
                'href' => '#test-1',
              ),
              'content' => 'First',
            )
          )
        ),
        'descendant' => array(
          'tag' => 'div',
          'attributes' => array(
            'id' => 'test-1',
            'class' => 'panel-collapse collapse'
          ),
	  'child' => array(
	    'tag' => 'div',
	    'attributes' => array(
	      'class' => 'panel-body'
	    ),
            'content' => "Contents of first"
	  )
        )
      ),
      'descendant' => array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'panel panel-default'
        ),
        'child' => array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'panel-heading'
          ),
          'child' => array(
            'tag' => 'h4',
            'attributes' => array(
              'class' => 'panel-title'
            ),
            'child' => array(
              'tag' => 'a',
              'attributes' => array(
                'class' => 'accordion-toggle',
                'data-toggle' => 'collapse',
                'data-parent' => '#test',
                'href' => '#test-2',
              ),
              'content' => 'Second',
            )
          )
        ),
        'descendant' => array(
          'tag' => 'div',
          'attributes' => array(
            'id' => 'test-2',
            'class' => 'panel-collapse collapse'
	    ),
	  'child' => array(
	    'tag' => 'div',
	    'attributes' => array(
	      'class' => 'panel-body'
	    ),
	    'content' => "Contents of second"
          ),
        )
      )
    );

  }

  public function testWeCanCreateAnAccordion() {
    $accordion = Accordion::create('test');

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'panel-group',
        'id' => 'test'
      )
    );

    $this->assertHtml($matcher, $accordion);

  }

  public function testWeCanCreateAnAccordionWithAttributes() {

    $accordion = Accordion::create('test', $this->testAttributes);

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'foo panel-group',
        'data-foo' => 'bar'
      ),
    );

    $this->assertHtml($matcher, $accordion);
  }

  public function testWeCanCreateAccordionsWithContents() {

    $accordion = Accordion::create('test')
         ->withContents(array(
      array('First', 'Contents of first'),
      array('Second', 'Contents of second'),
    ));

    $matcher = $this->getMatcher();

    $this->assertHtml($matcher, $accordion);
  }

  public function testWeCanOpenAnAccordionPanelByDefault() {
    $accordion = Accordion::create('test')
         ->withContents(array(array('First', 'Contents of first'),
			      array('Second', 'Contents of second')),
			1);

    $matcher = $this->getMatcher();
    $matcher['child']['descendant']['attributes']['class'] .= ' in';

    $this->assertHtml($matcher, $accordion);
  }

  public function testWeCanAddAttributesToThePanels() {
    $accordion = Accordion::create('test')
         ->withContents(array(array('First',
				    'Contents of first',
				    $this->testAttributes),
			      array('Second',
				    'Contents of second')));

    $matcher = $this->getMatcher();

    $matcher['child']['attributes'] = array(
      'class' => 'panel panel-default foo',
      'data-foo' => 'bar'
    );

    $this->assertHtml($matcher, $accordion);
  }

}

?>
