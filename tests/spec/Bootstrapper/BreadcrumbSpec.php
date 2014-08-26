<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BreadcrumbSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Breadcrumb');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<ol class='breadcrumb'></ol>");
    }

    function it_can_be_given_links()
    {
        $this->withLinks(
            [
                'foo' => 'bar'
            ]
        )->render()->shouldBe("<ol class='breadcrumb'><li><a href='bar'>foo</a></li></ol>");
    }

    function it_can_work_out_active_links()
    {
        $this->withLinks(
            [
                'foo'
            ]
        )->render()->shouldBe("<ol class='breadcrumb'><li class='active'>foo</li></ol>");
    }
}
