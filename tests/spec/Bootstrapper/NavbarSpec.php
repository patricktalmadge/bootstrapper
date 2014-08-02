<?php

namespace spec\Bootstrapper;

use Bootstrapper\Navigation;
use Illuminate\Routing\UrlGenerator;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NavbarSpec extends ObjectBehavior
{

    function let(UrlGenerator $generator)
    {
        $generator->to('/')->willReturn('http://localhost');

        $this->beConstructedWith($generator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Navbar');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }

    function it_can_be_given_a_brand()
    {
        $this->withBrand('foo', '/')->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button><a class='navbar-brand' href='/'>foo</a></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }

    function it_defaults_to_the_root_page_when_branding()
    {
        $this->withBrand('foo')->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button><a class='navbar-brand' href='http://localhost'>foo</a></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }

    function it_can_have_attributes_added()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation' data-foo='bar'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }

    function it_can_have_strings_added_to_it()
    {
        $this->withContent('foo')->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'>foo</nav></div></div>"
        );
    }

    function it_can_have_navigation_added(Navigation $navigation)
    {
        $navigation->navbar()->shouldBeCalledTimes(1);
        $navigation->__toString()->shouldBeCalledTimes(1)->willReturn('foo');

        $this->withContent($navigation)->render()->shouldBe(
            "<div class='navbar navbar-default' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'>foo</nav></div></div>"
        );
    }

    function it_can_be_inverted()
    {
        $this->inverse()->render()->shouldBe(
            "<div class='navbar navbar-inverse' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }

    function it_can_be_given_a_type()
    {
        $types = ['staticTop' => 'navbar-static-top', 'top' => 'navbar-fixed-top', 'bottom' => 'navbar-fixed-bottom'];
        foreach ($types as $type => $class) {
            $this->$type()->render()->shouldBe(
                "<div class='navbar navbar-default {$class}' role='navigation'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'></nav></div></div>"
            );
        }
    }

    function it_has_a_shortcut_method()
    {
        $this->create('foo', ['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='navbar navbar-default foo' role='navigation' data-foo='bar'><div class='container'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><nav class='navbar-collapse collapse'></nav></div></div>"
        );
    }
}
