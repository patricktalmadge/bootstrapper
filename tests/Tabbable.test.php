<?php
use Bootstrapper\Tabbable;

class TabbableTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($position, $childLinkText = null, $childContentText = null)
  {
    $position = 'tabs-'.$position;

    $base = array(
      'tag' => 'div',
      'attributes' => array('class' => 'tabbable '.$position),
      'descendant' => array(
        'tag' => 'ul',
        'attributes' => array('class' => 'nav nav-tabs'),
        'children' => array(
          'count' => 3,
          'only' => array('tag' => 'li'),
        ),
      ),
      'child' => array(
        'tag' => 'div',
        'attributes' => array('class' => 'tab-content'),
        'children' => array(
          'count' => 3,
          'only' => array(
            'tag' => 'div',
            'class' => 'tab-pane'
          ),
        ),
      )
    );

    if($childLinkText !== null)
    {
      $base['descendant']['child'] = array(
            'tag' => 'li',
            'class' => 'active',
            'child' => array(
              'tag' => 'a',
              'attributes' => array('data-toggle' => 'tab'),          
              'content' => $childLinkText
            )
          );
    }

    if($childContentText !== null)
    {
      $base['child']['child'] = array(
          'tag' => 'div',
          'attributes' => array('class' => 'tab-pane active'),
          'child' => array(
            'tag' => 'p',         
            'content' => $childContentText
          )
        );
    }
    return $base;
  }

  private function createLinks()
  {
    return array(
        array('Section 1', "<p>I'm in Section 1.</p>"),
        array('Section 2', "<p>Howdy, I'm in Section 2.</p>"),
        array('Section 3', "<p>What up girl, this is Section 3.</p>")
      );
  }

  // <div class="tabbable tabs-left">
  //   <ul class="nav nav-tabs">
  //     <li class="active"><a href="#tab_8zI7w_0" data-toggle="tab">Section 1</a></li>
  //     <li ><a href="#tab_8zI7w_1" data-toggle="tab">Section 2</a></li>
  //     <li ><a href="#tab_8zI7w_2" data-toggle="tab">Section 3</a></li>
  //   </ul>
  //   <div  class=" tab-content">
  //     <div class="tab-pane active" id="tab_8zI7w_0"><p>I'm in Section 1.</p></div>
  //     <div class="tab-pane" id="tab_8zI7w_1"><p>Howdy, I'm in Section 2.</p></div>
  //     <div class="tab-pane" id="tab_8zI7w_2"><p>What up girl, this is Section 3.</p></div>
  //   </div>
  // </div>

  public function testBasicTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs(Tabbable::links($arr));
    $matcher = $this->createMatcher('above');

    $this->assertTag($matcher, $tabs);
  }

  public function testLeftTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_left(Tabbable::links($arr));
    $matcher = $this->createMatcher('left');

    $this->assertTag($matcher, $tabs);
  }

  public function testRightTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_right(Tabbable::links($arr));
    $matcher = $this->createMatcher('right');

    $this->assertTag($matcher, $tabs);
  }

  public function testBelowTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_below(Tabbable::links($arr));
    $matcher = $this->createMatcher('below');

    $this->assertTag($matcher, $tabs);
  }

  public function testActiveTab()
  {
    $arr = $this->createLinks();

    //Set second tab as active
    $arr[1][2] = true;

    $tabs = Tabbable::tabs(Tabbable::links($arr));

    //Set matcher with 
    $matcher = $this->createMatcher('above', 'Section 2', "Howdy, I'm in Section 2.");
    $this->assertTag($matcher, $tabs);
  }

}