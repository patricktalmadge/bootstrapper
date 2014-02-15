<?php
include_once '_start.php';

use Bootstrapper\Panel;

class PanelTest extends BootstrapperWrapper
{

  public function setUp() {
    parent::setUp();

    $this->panel = Panel::normal($this->testAttributes);
  }

  public function getMatcher($class) {
    $class = ($class == 'normal') ? 'panel-default' : 'panel-'.$class;

    return array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'foo panel ' . $class,
        'data-foo' => 'bar'
      )
    );

    //            <div class='panel panel-{{ $type }}'>
    //          <div class='panel-heading'>
    //            <h3 class='panel-title'>{{ $type }}</h3>
    //          </div>
    //         <div class='panel-body'>
    //
    //          </div>
    //          <div class='panel-footer'>
    //            More footer shit
    //          </div>
    //        </div>
  }

  public function headingMatcher() {
    return array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'panel-heading'
      ),
      'child' => array(
        'tag' => 'h3',
        'attributes' => array(
          'class' => 'panel-title'
        ),
        'content' => 'Foo'
      )
    );
  }

  public function bodyMatcher() {
    return array(
      'tag' => 'div',
      'attributes' => array(
        'class' => "panel-body",
      ),
      'content' => 'Bar'
    );
  }

  public function footerMatcher() {
    return array(
      'tag' => 'div',
      'attributes' => array(
        'class' => "panel-footer",
      ),
      'content' => 'Baz'
    );
  }


  // Data providers  ----------------------------------------------- /

  public function classes()
  {
    return array(
      array('normal'),
      array('custom'),
      array('danger'),
      array('info'),
      array('success'),
      array('warning'),
    );
  }

  // Tests --------------------------------------------------------- /

  /**
   * @dataProvider classes
   */
  public function testWeCanCreateAPanel($class) {
    $panel = Panel::$class($this->testAttributes);

    $matcher = $this->getMatcher($class);

    $this->assertHtml($matcher, $panel);
  }

  /**
   * @dataProvider classes
   */
  public function testWeCanUseTheCreateMethod($class) {
    $panel = Panel::create($class, $this->testAttributes);

    $matcher = $this->getMatcher($class);

    $this->assertHtml($matcher, $panel);
  }

  public function testWeCanAddAHeader() {

    $this->panel->header("Foo");

    $matcher = $this->getMatcher('normal');
    $matcher['child'] = $this->headingMatcher();

    $this->assertHtml($matcher, $this->panel);

  }

  public function testWeCanAddABody() {

    $this->panel->body("Bar");

    $matcher = $this->getMatcher('normal');
    $matcher['child'] = $this->bodyMatcher();

    $this->assertHtml($matcher, $this->panel);

  }

  public function testWeCanAddAFooter() {

    $this->panel->footer("Baz");

    $matcher = $this->getMatcher('normal');
    $matcher['child'] = $this->footerMatcher();

    $this->assertHtml($matcher, $this->panel);

  }

  public function getCorrectMatcher($method) {
    if ($method == "header") return $this->headingMatcher();
    if ($method == "body") return $this->bodyMatcher();
    if ($method == "footer") return $this->footerMatcher();
  }

  public function testWeCanCallThemInSequence() {
    $methods = array(
      "header" => "Foo",
      "body" => "Bar",
      "footer" => "Baz"
    );
    foreach($methods as $firstMethod => $firstParam) {
      foreach($methods as $secondMethod => $secondParam) {
        if ($secondMethod != $firstMethod) {
          foreach($methods as $thirdMethod => $thirdParam) {
            if ($thirdMethod != $firstMethod &&
                $thirdMethod != $secondMethod ) {

              $panel = Panel::normal($this->testAttributes)
                                          ->$firstMethod($firstParam)
                                          ->$secondMethod($secondParam)
                                          ->$thirdMethod($thirdParam);

              $parent = $this->getMatcher("normal");
              $parent['child'] = $this->getCorrectMatcher($secondMethod);
              $parent['descendant'] = $this->getCorrectMatcher($thirdMethod);
              $matcher = $this->getCorrectMatcher($firstMethod);
              $matcher['parent'] = $parent;

              $this->assertHtml($matcher, $panel);
            }
          }
          $panel = Panel::normal($this->testAttributes)
                                      ->$firstMethod($firstParam)
                                      ->$secondMethod($secondParam);

          $matcher = $this->getMatcher("normal");
          $matcher['child'] = $this->getCorrectMatcher($firstMethod);
          $matcher['descendant'] = $this->getCorrectMatcher($secondMethod);

          $this->assertHtml($matcher, $panel);
        }
      }
      $panel = Panel::normal($this->testAttributes)
                                  ->$firstMethod($firstParam);

      $matcher = $this->getMatcher("normal");
      $matcher['child'] = $this->getCorrectMatcher($firstMethod);

      $this->assertHtml($matcher, $panel);
    }
  }

}

?>
