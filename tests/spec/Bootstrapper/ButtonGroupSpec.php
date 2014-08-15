<?php

namespace spec\Bootstrapper;

use Bootstrapper\Button;
use Bootstrapper\ButtonGroup;
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
        $this->render()->shouldBe("<div class='btn-group' data-toggle='buttons'></div>");
    }

    function it_can_be_sized()
    {
        $sizes = ['large' => 'btn-group-lg', 'small' => 'btn-group-sm', 'extraSmall' => 'btn-group-xs'];

        foreach ($sizes as $size => $class) {
            $this->$size()->render()->shouldBe("<div class='btn-group {$class}' data-toggle='buttons'></div>");
        }
    }

    function it_can_be_given_contents()
    {
        $this->withContents([
            '<div>Foo</div>',
            '<div>Bar</div>',
            '<div>Baz</div>'
        ])->render()->shouldBe("<div class='btn-group' data-toggle='buttons'><div>Foo</div><div>Bar</div><div>Baz</div></div>");
    }

    function it_can_be_made_vertical()
    {
        $this->vertical()->render()->shouldBe("<div class='btn-group-vertical' data-toggle='buttons'></div>");
    }

    function it_can_be_made_a_checkbox()
    {
        $buttonLeft = new Button();
        $buttonLeft->danger('Left');

        $buttonMiddle = new Button();
        $buttonMiddle->danger('Middle');

        $buttonRight = new Button();
        $buttonRight->danger('Right');

        $this->checkbox([
                $buttonLeft,
                $buttonMiddle,
                $buttonRight
        ])->render()->shouldBe("<div class='btn-group' data-toggle='buttons'><label class='btn btn-danger'><input type='checkbox'>Left</label><label class='btn btn-danger'><input type='checkbox'>Middle</label><label class='btn btn-danger'><input type='checkbox'>Right</label></div>");
    }

    function it_can_be_made_a_radio()
    {
        $buttonLeft = new Button();
        $buttonLeft->danger('Left');

        $buttonMiddle = new Button();
        $buttonMiddle->danger('Middle');

        $buttonRight = new Button();
        $buttonRight->danger('Right');

        $this->radio([
                $buttonLeft,
                $buttonMiddle,
                $buttonRight
            ])->render()->shouldBe("<div class='btn-group' data-toggle='buttons'><label class='btn btn-danger'><input type='radio'>Left</label><label class='btn btn-danger'><input type='radio'>Middle</label><label class='btn btn-danger'><input type='radio'>Right</label></div>");
    }
}
