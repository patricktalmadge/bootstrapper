<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccordionSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Accordion');
    }

    function it_can_be_named()
    {
        $this->named('foo')->render()->shouldBe(
            "<div class='panel-group' id='foo'></div>"
        );
    }

    function it_does_not_throw_if_there_is_no_name()
    {
        $this->render()->shouldBe(
            "<div class='panel-group' id='1-bootstrapper-accordion-1'></div>"
        );
    }

    function it_can_have_contents()
    {
        $this->named('foo')->withContents(
            [
                [
                    'title' => 'foo',
                    'contents' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#foo' href='#foo-0'>foo</a></h4></div><div id='foo-0' class='panel-collapse collapse'><div class='panel-body'>bar</div></div></div></div>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->named('foo')->withAttributes(
            [
                'bar' => 'baz',
            ]
        )->render()->shouldBe(
            "<div class='panel-group' id='foo' bar='baz'></div>"
        );
    }

    function it_can_give_attributes_to_the_contents()
    {
        $this->named('foo')->withContents(
            [
                [
                    'title' => 'foo',
                    'contents' => 'bar',
                    'attributes' => ['foo' => 'bar']
                ]
            ]
        )->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default' foo='bar'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#foo' href='#foo-0'>foo</a></h4></div><div id='foo-0' class='panel-collapse collapse'><div class='panel-body'>bar</div></div></div></div>"
        );
    }

    function it_can_open_one_item()
    {
        $this->named('foo')->withContents(
            [
                [
                    'title' => 'foo',
                    'contents' => 'bar'
                ],
                [
                    'title' => 'goo',
                    'contents' => 'gar'
                ]
            ]
        )->open(0)->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#foo' href='#foo-0'>foo</a></h4></div><div id='foo-0' class='panel-collapse collapse in'><div class='panel-body'>bar</div></div></div><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a data-toggle='collapse' data-parent='#foo' href='#foo-1'>goo</a></h4></div><div id='foo-1' class='panel-collapse collapse'><div class='panel-body'>gar</div></div></div></div>"
        );
    }

    function it_can_be_stringified()
    {
        $this->named('bar')->__toString()->shouldBe($this->render());
    }

}
