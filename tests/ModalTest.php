<?php
include_once '_start.php';

use Bootstrapper\Modal;

class ModalTest extends BootstrapperWrapper
{

  protected function getMatcher() {
    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'foo modal',
        'aria-labelledby' => "bar",
        'aria-hidden' => "true",
	'id' => 'bar'
      ),
      'child' => array(
        'tag' => 'div',
        'attributes' => array(
          'class' => 'modal-dialog'
        ),
        'child' => array(
          'tag' => 'div',
          'attributes' => array(
            'class' => 'modal-content'
          ),
          'child' => array(
            'tag' => 'div',
            'attributes' => array(
              'class' => 'modal-header'
            ),
            'child' => array(
              'tag' => 'button',
              'attributes' => array(
                'type' => 'button',
                'class' => 'close',
                'data-dismiss' => 'modal',
                'aria-hidden' => 'true'
              ),
              'content' => 'x'
            ),
          )
        )
      )
    );
    return $matcher;
  }

  protected function getAttributes() {
    return array('class' => 'foo');
  }

  public function testCanOpenModel() {
    $modal = Modal::create("bar", $this->getAttributes());
    $matcher = $this->getMatcher();
    $this->assertHTML($matcher, $modal);
  }

  public function testCanCreateWithHeader() {
    $modal = Modal::withHeader("Foo Bar", "bar", $this->getAttributes());
    $matcher = $this->getMatcher();
    $matcher['child']['descendant'] =
    array(
      'tag' => "h3",
      'attributes' => array(
      ),
      'content' => 'Foo Bar'
    );
    $this->assertHTML($matcher, $modal);
  }

  public function testCanCreateWithBody() {
    $modal = Modal::withBody("Foo bar", "bar", $this->getAttributes());
    $matcher = $this->getMatcher();
    $matcher['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-body'
      ),
      'content' => 'Foo bar'
    );
    $this->assertHTML($matcher, $modal);
  }

  public function testCanCreateWithFooter() {

    $modal = Modal::withFooter("Foo bar", "bar", $this->getAttributes());

    $matcher = $this->getMatcher();
    $matcher['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-footer'
      ),
      'content' => "Foo bar",
    );

    $this->assertHTML($matcher, $modal);
  }

  public function testCanAddAHeader() {

    $modal = Modal::create("bar", $this->getAttributes())->header("Foo bar");

    $matcher = $this->getMatcher();
    $matcher['child']['descendant'] =
    array(
      'tag' => "h3",
      'content' => 'Foo bar'
    );
    $this->assertHTML($matcher, $modal);
  }

  public function testCanAddBodyText() {

    $modal = Modal::create("bar", $this->getAttributes())->body("Foo bar");
    $matcher = $this->getMatcher();
    $matcher['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-body'
      ),
      'content' => 'Foo bar'
    );
    $this->assertHTML($matcher, $modal);

  }

  public function testCanAddFooter() {

    $modal = Modal::create("bar", $this->getAttributes())->footer("Foo bar");

    $matcher = $this->getMatcher();
    $matcher['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-footer'
      ),
      'content' => "Foo bar",
    );

    $this->assertHTML($matcher, $modal);
  }

  public function testCanCreateAndAddHeaderBodyAndFooter() {

    $modal = Modal::create("bar", $this->getAttributes())->footer("Foo bar")->body("Foo bar")->header("Foo bar");

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-body'
      ),
      'content' => 'Foo bar'
    );
    $parent = $this->getMatcher();
    $parent['descendant'] = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'modal-footer'
      ),
      'content' => "Foo bar",
    );
    $parent['child']['descendant'] =
    array(
      'tag' => "h3",
      'attributes' => array(
      ),
      'content' => 'Foo bar'
    );
    $matcher['parent']['parent']['parent'] = $parent;

    $this->assertHTML($matcher, $modal);

  }

}
