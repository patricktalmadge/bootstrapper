<?php
use Bootstrapper\Navbar;

class NavbarTest extends BootstrapperWrapper
{
    public function testNavbarBasic()
    {
        $navbar = Navbar::create();

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

        $this->assertTag($matcher, $navbar);
    }
}