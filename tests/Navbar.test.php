<?php
use Bootstrapper\Navbar;
use Bootstrapper\Navigation;

class NavbarTest extends BootstrapperWrapper
{
    private function getBasicMatcher()
    {
        $matcher = array(
            'tag' => 'div',
            'attributes' => array('class' => 'navbar'),
            'child' => array(
                'tag' => 'div',
                'attributes' => array('class' => 'navbar-inner'),
                'child' => array(
                    'tag' => 'div',
                    'attributes' => array('class' => 'container'),
                ),
            )
        );

        return $matcher;
    }

    public function testBasic()
    {
        $navbar = Navbar::create();
        $matcher = $this->getBasicMatcher();
        $this->assertTag($matcher, $navbar);
    }

    public function testAttributes()
    {
        $navbar = Navbar::create(array('class' => 'foo', 'data-foo' => 'bar'));
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' foo';
        $matcher['attributes']['data-foo'] = 'bar';
        $this->assertTag($matcher, $navbar);
    }

    public function testFixTop()
    {
        $navbar = Navbar::create(array(), Navbar::FIX_TOP);
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' navbar-fixed-top';
        $this->assertTag($matcher, $navbar);
    }

    public function testFixBottom()
    {
        $navbar = Navbar::create(array(), Navbar::FIX_BOTTOM);
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' navbar-fixed-bottom';
        $this->assertTag($matcher, $navbar);
    }

    public function testInverse()
    {
        $navbar = Navbar::inverse();
        $matcher = $this->getBasicMatcher();
        $matcher['attributes']['class'] .= ' navbar-inverse';

        $this->assertTag($matcher, $navbar);

    }

    public function testBrand()
    {
        //<a href="#" class="brand">Bootstrapper</a>
        $navbar = Navbar::create()->with_brand('Bootstrapper', '#');
        $matcher = $this->getBasicMatcher();
        $matcher['child']['child']['child'] = array(
            'tag' => 'a',
            'attributes' => array('class' => 'brand', 'href' => '#'),
            'content' => 'Bootstrapper'
        );

        $this->assertTag($matcher, $navbar);

    }

    public function testCollapse()
    {
        $navbar = Navbar::create()->collapsible();
        $matcher = $this->getBasicMatcher(true);

        //Add collapse tags
        $matcher['child']['child']['child'] = array(
            'tag' => 'a',
            'attributes' => array(
                'class' => 'btn btn-navbar',
                'data-toggle' => 'collapse',
                'data-target' => '.nav-collapse'
            ),
            'children' => array(
                'count' => 3,
                'only' => array(
                    'tag' => 'span',
                    'class' => 'icon-bar'
                ),
            ),
        );
        $matcher['child']['child']['descendant'] = array(
            'tag' => 'div',
            'attributes' => array('class' => 'nav-collapse')
        );

        $this->assertTag($matcher, $navbar);
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
        $matcher['child']['child']['child'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertTag($matcher, $navbar);
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
        $matcher['child']['child']['child'] = array(
            'tag' => 'ul',
            'attributes' => array('class' => 'nav foo', 'data-foo' => 'bar'),
            'children' => array(
                'count' => 2,
                'only' => array('tag' => 'li')
            )
        );

        $this->assertTag($matcher, $navbar);
    }
}
