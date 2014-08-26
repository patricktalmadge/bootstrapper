<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DropdownButtonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\DropdownButton');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
        );
    }

    function it_can_be_given_a_label()
    {
        $this->labelled('foo')->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'>foo <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
        );
    }

    function it_can_be_given_contents()
    {
        $this->withContents(
            [
                [
                    'url' => 'foo',
                    'label' => 'bar'
                ],
                [
                    'url' => 'goo',
                    'label' => 'gar'
                ]

            ]
        )->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'><li><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul></div>"
        );
    }

    function it_can_be_given_a_divider()
    {
        $this->withContents(
            [
                [
                    'url' => 'foo',
                    'label' => 'bar'
                ],
                \Bootstrapper\DropdownButton::DIVIDER,
                [
                    'url' => 'goo',
                    'label' => 'gar'
                ]

            ]
        )->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'><li><a href='foo'>bar</a></li><li class='divider'></li><li><a href='goo'>gar</a></li></ul></div>"
        );
    }

    function it_can_be_given_a_type()
    {
        $types = ['primary', 'danger', 'warning', 'success', 'info', 'normal'];
        foreach ($types as $type) {
            $class = $type === 'normal' ? 'default' : $type;
            $this->$type()->render()->shouldBe(
                "<div class='btn-group'><button class='btn btn-{$class} dropdown-toggle' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
            );
        }
    }

    function it_can_be_given_a_size()
    {
        $sizes = ['large' => 'btn-lg', 'small' => 'btn-sm', 'extraSmall' => 'btn-xs'];

        foreach ($sizes as $size => $class) {
            $this->$size()->render()->shouldBe(
                "<div class='btn-group'><button class='btn btn-default dropdown-toggle {$class}' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
            );
        }
    }

    function it_can_be_split()
    {
        $this->split()->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default' type='button'></button><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'><span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
        );

        $this->labelled('foo')->split()->render()->shouldBe(
            "<div class='btn-group'><button class='btn btn-default' type='button'>foo</button><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'><span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
        );
        // Check that types and stuff still work

        // Resets object
        $this->labelled('');

        $sizes = ['large' => 'btn-lg', 'small' => 'btn-sm', 'extraSmall' => 'btn-xs'];

        foreach ($sizes as $size => $class) {
            $this->$size()->split()->render()->shouldBe(
                "<div class='btn-group'><button class='btn btn-default {$class}' type='button'></button><button class='btn btn-default dropdown-toggle {$class}' data-toggle='dropdown' type='button'><span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
            );
        }

        $types = ['primary', 'danger', 'warning', 'success', 'info'];
        foreach ($types as $type) {
            $this->$type()->render()->shouldBe(
                "<div class='btn-group'><button class='btn btn-{$type} btn-xs' type='button'></button><button class='btn btn-{$type} dropdown-toggle btn-xs' data-toggle='dropdown' type='button'><span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
            );
        }
    }

    function it_can_be_made_to_dropup()
    {
        $this->dropup()->render()->shouldBe(
            "<div class='btn-group dropup'><button class='btn btn-default dropdown-toggle' data-toggle='dropdown' type='button'> <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
        );
    }

    function it_has_shortcut_methods()
    {
        $types = ['primary', 'danger', 'warning', 'success', 'info', 'normal'];
        foreach ($types as $type) {
            $class = $type === 'normal' ? 'default' : $type;
            $this->$type($type)->render()->shouldBe(
                "<div class='btn-group'><button class='btn btn-{$class} dropdown-toggle' data-toggle='dropdown' type='button'>$type <span class='caret'></span></button><ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'></ul></div>"
            );
        }
    }
}
