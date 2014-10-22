<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AlertSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Alert');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='alert'></div>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['info', 'success', 'warning', 'danger'];
        foreach ($types as $type) {
            $this->$type()->render()->shouldBe(
                "<div class='alert alert-{$type}'></div>"
            );
        }
    }

    function it_can_be_given_contents()
    {
        $this->withContents("Test")->render()->shouldBe(
            "<div class='alert'>Test</div>"
        );
    }

    function it_can_become_closeable()
    {
        $this->close()->render()->shouldBe(
            "<div class='alert alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button></div>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['foo' => 'bar'])->render()->shouldBe(
            "<div class='alert' foo='bar'></div>"
        );
    }

    function it_allows_you_to_use_a_shortcut()
    {
        $types = ['info', 'success', 'warning', 'danger'];
        foreach ($types as $type) {
            $this->$type($type)->render()->shouldBe(
                "<div class='alert alert-{$type}'>{$type}</div>"
            );
        }
    }

    function it_allows_you_to_override_the_close_icon()
    {
        $closers = ['x', '<i class="fa fa-times"></i>'];

        foreach ($closers as $closer) {
            // Force an empty contents since we append with the close icon and this fails the tests
            $this->withContents('');
            $this->close($closer)->render()->shouldBe(
                "<div class='alert alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>{$closer}</button></div>"
            );
        }
    }
}

?>
