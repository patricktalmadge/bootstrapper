<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PanelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Panel');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='panel panel-default'></div>");
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render("<div class='panel panel-default' data-foo='bar'></div>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['primary', 'success', 'info', 'warning', 'danger', 'normal'];

        foreach ($types as $type) {
            $class = $type == 'normal' ? 'default' : $type;
            $this->$type()->render()->shouldBe("<div class='panel panel-{$class}'></div>");
        }
    }

    function it_can_be_given_a_header()
    {
        $this->withHeader('foo')->render()->shouldBe("<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>foo</h3></div></div>");
    }

    function it_can_be_given_a_body()
    {
        $this->withBody('foo')->render()->shouldBe("<div class='panel panel-default'><div class='panel-body'>foo</div></div>");
    }

    function it_can_be_given_a_footer()
    {
        $this->withFooter('foo')->render()->shouldBe("<div class='panel panel-default'><div class='panel-footer'>foo</div></div>");
    }
}
