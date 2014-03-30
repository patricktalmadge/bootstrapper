<?php
include_once '_start.php';

use Bootstrapper\Navbar;
use Bootstrapper\Navigation;

class NavbarTest extends BootstrapperWrapper
{
    private function getBasicMatcher($collapsible = false, $inverse = false)
    {
        $type = ($inverse) ? 'navbar-inverse' : 'navbar-default';
        $matcher = array(
            'tag' => 'nav',
            'attributes' => array('class' => $type.' navbar'),
            'child' => array(
                'tag' => 'div',
                'attributes' => array('class' => 'container'),
                'child' => array(
                    'tag' => 'div',
                    'attributes' => array('class' => 'navbar-header')
                ),
            ),
        );
        if ($collapsible)
            {
            //Add collapse tags
            $matcher['child']['child']['child'] = array(
                'tag' => 'button',
                'attributes' => array(
                    'class' => 'navbar-toggle',
                    'data-toggle' => 'collapse',
                    'data-target' => '.navbar-collapse',
                    'type' => 'button'
                ),
                'child' => array(
                    'tag' => 'span',
                    'class' => 'sr-only',
                    'content' => 'Toggle navigation',
                ),
                'children' => array(
                    'count' => 4,
                    'only' => array(
                        'tag' => 'span'
                    ),
                ),
            );
            $matcher['descendant'] = array(
                'tag' => 'div',
                'attributes' => array('class' => "navbar-collapse collapse")
            );

        }


        return $matcher;
    }

    public function testBasic()
    {
        $navbar = Navbar::create();
        $matcher = $this->getBasicMatcher();
        $this->assertHTML($matcher, $navbar);
    }

    public function testAttributes()
    {
        $navbar = Navbar::create(array('class' => 'foo', 'data-foo' => 'bar'));
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' foo';
        $matcher['attributes']['data-foo'] = 'bar';
        $this->assertHTML($matcher, $navbar);
    }

    public function testFixTop()
    {
        $navbar = Navbar::create(array(), Navbar::FIX_TOP);
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' navbar-fixed-top';
        $this->assertHTML($matcher, $navbar);
    }

    public function testFixBottom()
    {
        $navbar = Navbar::create(array(), Navbar::FIX_BOTTOM);
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' navbar-fixed-bottom';
        $this->assertHTML($matcher, $navbar);
    }

    public function testInverse()
    {
        $navbar = Navbar::inverse();
        $matcher = $this->getBasicMatcher(false, true);
        $this->assertHTML($matcher, $navbar);

    }

    public function testBrand()
    {
        $navbar = Navbar::create()->with_brand('Bootstrapper', '#');
        $matcher = $this->getBasicMatcher();
        $matcher['child']['child']['child'] = array(
            'tag' => 'a',
            'attributes' => array('class' => 'navbar-brand', 'href' => '#'),
            'content' => 'Bootstrapper'
        );

        $this->assertHTML($matcher, $navbar);

    }

    public function testCollapse()
    {
        $navbar = Navbar::create()->collapsible();
        $matcher = $this->getBasicMatcher(true);

        $this->assertHTML($matcher, $navbar);
    }

    public function testMenu()
    {
        $navbar = Navbar::create()->with_menus(
            Navigation::links(array(
                array('foo', '#'),
                array('bar', '#')
            ))
        );

        $matcher = $this->getBasicMatcher();
        $matcher['descendant'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav navbar-nav'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertHTML($matcher, $navbar);
    }

    public function testMenuAttributes()
    {
        $navbar = Navbar::create()->with_menus(
            Navigation::links(array(
                array('foo', '#'),
                array('bar', '#')
            )),
            array('class' => 'foo', 'data-foo' => 'bar')
        );

        $matcher = $this->getBasicMatcher();
        $matcher['descendant'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav navbar-nav foo', 'data-foo' => 'bar'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertHTML($matcher, $navbar);
    }

    public function testNotVisibleMenu()
    {
        $navbar = Navbar::create()->with_menus(
            Navigation::links(array(
                array('foo', '#', false, false, null, null, true),
                array('bar', '#'),
                array('baz', '#', false, false, null, null, false)
            ))
        );

        $matcher = $this->getBasicMatcher();
        $matcher['descendant'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertHTML($matcher, $navbar);
    }

    public function testClosureNotVisibleMenu()
    {
        $visible = function($item) {
            return $item['label'] === 'bar';
        };

        $navbar = Navbar::create()->with_menus(
            Navigation::links(array(
                array('foo', '#'),
                array('bar', '#', false, false, null, null, $visible),
                array('baz', '#', false, false, null, null, $visible)
            ))
        );

        $matcher = $this->getBasicMatcher();
        $matcher['descendant'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertHTML($matcher, $navbar);
    }

    public function testCollapsibleMenu()
    {
        $navbar = Navbar::create()->with_menus(
            Navigation::links(array(
                array('foo', '#'),
                array('bar', '#')
            ))
        )->collapsible();

        $matcher = $this->getBasicMatcher(true);

        $matcher['descendant']['child'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertHtml($matcher, $navbar);
    }

    public function testWeCanPassHTMLToTheBrand() {
        $navbar = Navbar::create()->with_brand('<div>Bootstrapper</div>', '#', false);
        $matcher = $this->getBasicMatcher();
        $matcher['child']['child']['child'] = array(
            'tag' => 'a',
            'attributes' => array('class' => 'navbar-brand', 'href' => '#'),
            'child' => array(
                'tag' => 'div',
                'content' => 'Bootstrapper'
            )
        );

        $this->assertHTML($matcher, $navbar);

    }
}
