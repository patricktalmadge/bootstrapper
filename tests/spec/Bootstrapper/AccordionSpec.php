<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccordionSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Accordion');
    }

    function it_can_create_a_new_accordion()
    {
        $accordion = $this->create('foo');

        $accordion->shouldHaveType('Bootstrapper\Accordion');
        $accordion->name->shouldBe('foo');
    }

    function it_can_be_created_with_attributes()
    {
        $accordion = $this->create('foo', ['bar' => 'baz']);

        $accordion->attributes->shouldBe(['bar' => 'baz']);
    }

    function it_can_have_contents_added()
    {
        $accordion = $this->addContents(['header' => 'bar', 'contents' => 'baz']);
        $accordion->contents->shouldBe(
            [
                ['header' => 'bar', 'contents' => 'baz']
            ]
        );
    }

    function it_can_have_multiple_contents_added()
    {
        $accordion = $this->addContents(
            [
                ['header' => 'bar', 'contents' => 'baz'],
                ['header' => 'jar', 'contents' => 'jaz']
            ]
        );
        $accordion->contents->shouldBe(
            [
                ['header' => 'bar', 'contents' => 'baz'],
                ['header' => 'jar', 'contents' => 'jaz']
            ]
        );
    }

    function it_can_have_contents_added_several_times()
    {

        $accordion = $this->addContents(
            ['header' => 'bar', 'contents' => 'baz']
        )->addContents(
            ['header' => 'jar', 'contents' => 'jaz']
        );

        $accordion->contents->shouldBe(
            [
                ['header' => 'bar', 'contents' => 'baz'],
                ['header' => 'jar', 'contents' => 'jaz']
            ]
        );
    }

    function it_can_be_rendered()
    {
        $accordion = $this->addContents(
            ['header' => 'bar', 'contents' => 'baz']
        );

        $accordion->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-1'>bar</a></h4></div><div class='panel-collapse collapse' id='foo-1'><div class='panel-body'>baz</div></div></div></div>"
        );
    }

    function it_renders_correctly_if_it_has_multiple_contents()
    {
        $accordion = $this->addContents(
            ['header' => 'bar', 'contents' => 'baz']
        )->addContents(
            ['header' => 'jar', 'contents' => 'jaz']
        );

        $accordion->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-1'>bar</a></h4></div><div class='panel-collapse collapse' id='foo-1'><div class='panel-body'>baz</div></div></div><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-2'>jar</a></h4></div><div class='panel-collapse collapse' id='foo-2'><div class='panel-body'>jaz</div></div></div></div>"
        );
    }

    function it_renders_corrently_if_we_have_attributes()
    {
        $this->create('foo',['bar'=>'baz'])->render()->shouldBe("<div class='panel-group' id='foo' bar='baz'></div>");
    }

    function it_can_add_attributes_to_each_panel()
    {
        $this->addContents(
            ['header' => 'bar', 'contents' => 'baz', 'attributes' => ['test' => 'yay']]
        )->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default' test='yay'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-1'>bar</a></h4></div><div class='panel-collapse collapse' id='foo-1'><div class='panel-body'>baz</div></div></div></div>"
        );
    }

    function it_can_open_one_panel()
    {

        $accordion = $this->addContents(
            ['header' => 'bar', 'contents' => 'baz']
        )->addContents(
            ['header' => 'jar', 'contents' => 'jaz']
        )->open(1)->render()->shouldBe(
            "<div class='panel-group' id='foo'><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-1'>bar</a></h4></div><div class='panel-collapse collapse in' id='foo-1'><div class='panel-body'>baz</div></div></div><div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse' data-parent='#foo' href='#foo-2'>jar</a></h4></div><div class='panel-collapse collapse' id='foo-2'><div class='panel-body'>jaz</div></div></div></div>"
        );


    }

}

?>