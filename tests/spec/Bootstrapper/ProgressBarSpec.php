<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProgressBarSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\ProgressBar');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'><span class='sr-only'>0% complete</span></div></div>");
    }

    function it_can_be_given_a_value()
    {
        $this->value(20)->render()->shouldBe("<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100' style='width: 20%'><span class='sr-only'>20% complete</span></div></div>");
    }

    function it_allows_you_to_make_the_percentage_visible()
    {
        $this->visible()->render()->shouldBe("<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>0%</div></div>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['success', 'info', 'warning', 'danger', 'normal'];

        foreach ($types as $type) {
            $class = $type == 'normal' ? 'default' : $type;
            $this->$type()->render()->shouldBe("<div class='progress'><div class='progress-bar progress-bar-{$class}' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'><span class='sr-only'>0% complete</span></div></div>");
        }
    }

    function it_can_be_striped()
    {
        $this->striped()->render()->shouldBe("<div class='progress'><div class='progress-bar progress-bar-striped' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'><span class='sr-only'>0% complete</span></div></div>");
    }

    function it_can_be_animated()
    {
        $this->striped()->animated()->render()->shouldBe("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'><span class='sr-only'>0% complete</span></div></div>");
    }

    function it_is_smart_enough_to_stripe_when_animated()
    {
        $this->animated()->render()->shouldBe("<div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'><span class='sr-only'>0% complete</span></div></div>");
    }

    function it_can_stack_progress_bars()
    {
        $this->stack(
            [
                ['success', 'value=10'],
                ['animated', 'value=20'],
                ['striped', 'value=30'],
                ['visible']
            ]
        )->shouldBe(
            "<div class='progress'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 10%'><span class='sr-only'>10% complete</span></div><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100' style='width: 20%'><span class='sr-only'>20% complete</span></div><div class='progress-bar progress-bar-striped' role='progressbar' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' style='width: 30%'><span class='sr-only'>30% complete</span></div><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>0%</div></div>"
        );
    }

    function it_allows_you_to_use_shortcuts()
    {
        $types = ['success', 'info', 'warning', 'danger', 'normal'];

        foreach ($types as $type) {
            $class = $type == 'normal' ? 'default' : $type;
            $this->$type(40)->render()->shouldBe("<div class='progress'><div class='progress-bar progress-bar-{$class}' role='progressbar' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100' style='width: 40%'><span class='sr-only'>40% complete</span></div></div>");
        }
    }

    function it_allows_you_to_set_the_visible_string()
    {
        $this->visible('Here is a value! %s%%')->render()->shouldBe("<div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>Here is a value! 0%</div></div>");
    }
}
