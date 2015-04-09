<?php

namespace spec\Bootstrapper;

use Bootstrapper\Table;
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
        $this->withAttributes(['data-foo' => 'bar'])->render(
            "<div class='panel panel-default' data-foo='bar'></div>"
        );
    }

    function it_can_be_given_a_type()
    {
        $types = ['primary', 'success', 'info', 'warning', 'danger', 'normal'];

        foreach ($types as $type) {
            $class = $type == 'normal' ? 'default' : $type;
            $this->$type()->render()->shouldBe(
                "<div class='panel panel-{$class}'></div>"
            );
        }
    }

    function it_can_be_given_a_header()
    {
        $this->withHeader('foo')->render()->shouldBe(
            "<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>foo</h3></div></div>"
        );
    }

    function it_can_be_given_a_body()
    {
        $this->withBody('foo')->render()->shouldBe(
            "<div class='panel panel-default'><div class='panel-body'>foo</div></div>"
        );
    }

    function it_can_be_given_a_table()
    {
        $this->withTable(
            "<table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table>"
        )->render()->shouldBe(
            "<div class='panel panel-default'><table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table></div>"
        );
    }

    function it_can_accept_a_table_object(Table $table)
    {
        $table->render()->willReturn(
            "<table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table>"
        );

        $this->withTable($table)->render()->shouldBe(
            "<div class='panel panel-default'><table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table></div>"
        );
    }

    function it_should_throw_when_the_table_object_throws(Table $table)
    {
        $table->render()->willThrow('ErrorException');

        $this->withTable($table)->shouldThrow('ErrorException')->during('render');
    }

    function it_can_be_given_a_footer()
    {
        $this->withFooter('foo')->render()->shouldBe(
            "<div class='panel panel-default'><div class='panel-footer'>foo</div></div>"
        );
    }
}
