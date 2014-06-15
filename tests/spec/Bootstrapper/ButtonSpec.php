<?php

namespace spec\Bootstrapper;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ButtonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Button');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<button type='button' class='btn btn-default'></button>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['primary','success','info','warning','danger','link'];

        foreach($types as $type) {
            $this->$type()->render()->shouldBe("<button type='button' class='btn btn-{$type}'></button>");
        }
    }

}
