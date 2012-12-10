<?php
use Bootstrapper\Tabbable;
use Bootstrapper\Navigation;

class TabbableTest extends BootstrapperWrapper
{
  // Matchers ------------------------------------------------------ /

  private function createMatcher($position, $type, $childLinkText = null, $childContentText = null)
  {
    $position = 'tabs-'.$position;
    $type = 'nav-'.$type;

    $base = array(
      'tag' => 'div',
      'attributes' => array('class' => 'tabbable '.$position),
      'descendant' => array(
        'tag' => 'ul',
        'attributes' => array('class' => 'nav '.$type),
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

    if ($childLinkText !== null) {
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

    if ($childContentText !== null) {
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

  public function testBasicTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs(Navigation::links($arr));
    $matcher = $this->createMatcher('above','tabs');

    $this->assertTag($matcher, $tabs);
  }

  public function testBasicPills()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::pills(Navigation::links($arr));
    $matcher = $this->createMatcher('above','pills');

    $this->assertTag($matcher, $tabs);
  }

  public function testBasicLists()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::lists(Navigation::links($arr));
    $matcher = $this->createMatcher('above','list');

    $this->assertTag($matcher, $tabs);
  }

  public function testLeftTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_left(Navigation::links($arr));
    $matcher = $this->createMatcher('left','tabs');

    $this->assertTag($matcher, $tabs);
  }

  public function testRightTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_right(Navigation::links($arr));
    $matcher = $this->createMatcher('right','tabs');

    $this->assertTag($matcher, $tabs);
  }

  public function testBelowTab()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs_below(Navigation::links($arr));
    $matcher = $this->createMatcher('below','tabs');

    $this->assertTag($matcher, $tabs);
  }

  public function testStacked()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs(Navigation::links($arr))->stacked();
    $matcher = $this->createMatcher('above','tabs');
    $matcher['descendant']['attributes']['class'] .= ' nav-stacked';
    $this->assertTag($matcher, $tabs);
  }

  public function testMenuAttributes()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs(Navigation::links($arr))->menu_attributes(array('class' => 'foo', 'data-bar' => 'bar'));
    $matcher = $this->createMatcher('above','tabs');
    $matcher['descendant']['attributes']['class'] = 'foo ' . $matcher['descendant']['attributes']['class'];
    $matcher['descendant']['attributes']['data-bar'] = 'bar';
    $this->assertTag($matcher, $tabs);
  }

  public function testContentAttributes()
  {
    $arr = $this->createLinks();

    $tabs = Tabbable::tabs(Navigation::links($arr))->content_attributes(array('class' => 'foo', 'data-bar' => 'bar'));
    $matcher = $this->createMatcher('above','tabs');
    $matcher['child']['attributes']['class'] = 'foo ' . $matcher['child']['attributes']['class'];
    $matcher['child']['attributes']['data-bar'] = 'bar';
    $this->assertTag($matcher, $tabs);
  }

  public function testActiveTab()
  {
    $arr = $this->createLinks();

    //Set second tab as active
    $arr[1][2] = true;

    $tabs = Tabbable::tabs(Navigation::links($arr));

    //Set matcher with
    $matcher = $this->createMatcher('above','tabs', 'Section 2', "Howdy, I'm in Section 2.");
    $this->assertTag($matcher, $tabs);
  }

}
