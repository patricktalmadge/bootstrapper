<?php

namespace spec\Bootstrapper;

use Bootstrapper\Navigation;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class NavbarSpec extends ObjectBehavior
{

    function let()
    {
        $url = Mockery::mock('Illuminate\\Routing\\UrlGenerator');
        $url->shouldReceive('to')->with('/')->andReturn('http://localhost');

        $this->beConstructedWith($url);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Navbar');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><div class='navbar-collapse collapse'></div></div></nav>"
        );
    }

    function it_can_be_given_a_brand()
    {
        $this->withBrand('foo', '/')->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button><a class='navbar-brand' href='/'>foo</a></div><div class='navbar-collapse collapse'></div></div></nav>"
        );
    }

    function it_defaults_to_the_root_page_when_branding()
    {
        $this->withBrand('foo')->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button><a class='navbar-brand' href='http://localhost'>foo</a></div><div class='navbar-collapse collapse'></div></div></nav>"
        );
    }

    function it_can_have_attributes_added()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation' data-foo='bar'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><div class='navbar-collapse collapse'></div></div></nav>"
        );
    }

    function it_can_have_strings_added_to_it()
    {
        $this->withContent('foo')->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><div class='navbar-collapse collapse'>foo</div></div></nav>"
        );
    }

    function it_can_have_navigation_added(Navigation $navigation)
    {
        $navigation->navbar()->shouldBeCalledTimes(1);
        $navigation->__toString()->shouldBeCalledTimes(1)->willReturn('foo');

        $this->withContent($navigation)->render()->shouldBe(
            "<nav class='navbar navbar-default' role='navigation'><div class='container-fluid'><div class='navbar-header'><button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'><span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button></div><div class='navbar-collapse collapse'>foo</div></div></nav>"
        );
    }
}
