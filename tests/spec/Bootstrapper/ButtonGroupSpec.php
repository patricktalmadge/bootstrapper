<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ButtonGroupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\ButtonGroup');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='button-group' data-toggle='buttons'></div>");
    }

    function it_can_be_given_contents()
    {
        $this->withContents(
            [
                [
                    'type' => 'btn-danger',
                    'contents' => 'foo'
                ],
                [
                    'type' => 'btn-danger',
                    'contents' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<div class='button-group' data-toggle='buttons'><label class='btn btn-danger'><input type='radio'>foo</label><label class='btn btn-danger'><input type='radio'>bar</label></div>"
        );
    }

    function it_can_change_types()
    {
        $types = ['radio', 'checkbox', 'baz'];

        foreach ($types as $type) {
            $this->asType($type)->withContents(
                [
                    [
                        'type' => 'btn-danger',
                        'contents' => 'foo'
                    ],
                    [
                        'type' => 'btn-danger',
                        'contents' => 'bar'
                    ]
                ]
            )->render()->shouldBe(
                "<div class='button-group' data-toggle='buttons'><label class='btn btn-danger'><input type='{$type}'>foo</label><label class='btn btn-danger'><input type='{$type}'>bar</label></div>"
            );
        }
    }

    function it_can_handle_contents_without_a_type()
    {
        $this->withContents(
            [
                ['contents' => 'foo'],
                [
                    'type' => 'btn-danger',
                    'contents' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<div class='button-group' data-toggle='buttons'><label class='btn btn-default'><input type='radio'>foo</label><label class='btn btn-danger'><input type='radio'>bar</label></div>"
        );
    }

    function it_can_be_sized()
    {
        $sizes = ['large' => 'btn-group-lg', 'small' => 'btn-group-sm', 'extraSmall' => 'btn-group-xs'];

        foreach ($sizes as $size => $class) {
            $this->$size()->render()->shouldBe("<div class='button-group {$class}' data-toggle='buttons'></div>");
        }

    }
}
