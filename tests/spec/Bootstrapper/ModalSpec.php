<?php

namespace spec\Bootstrapper;

use Bootstrapper\Button;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModalSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Modal');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe(
            "<div class='modal'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div></div></div></div>"
        );
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='modal' data-foo='bar'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div></div></div></div>"
        );;
    }

    function it_can_be_given_a_title()
    {
        $this->withTitle('title')->render()->shouldBe(
            "<div class='modal'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button><h4 class='modal-title'>title</h4></div></div></div></div>"
        );
    }

    function it_can_be_given_a_body()
    {
        $this->withBody('content')->render()->shouldBe(
            "<div class='modal'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div><div class='modal-body'>content</div></div></div></div>"
        );
    }

    function it_can_be_given_a_footer()
    {
        $this->withFooter('footer')->render()->shouldBe(
            "<div class='modal'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div><div class='modal-footer'>footer</div></div></div></div>"
        );
    }

    function it_can_be_named()
    {
        $this->named('foo')->render()->shouldBe(
            "<div class='modal' id='foo'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div></div></div></div>"
        );
    }

    function it_can_be_given_a_button()
    {
        $this->named('foo')->withButton()->render()->shouldBe(
            "<button type='button' class='btn btn-default' data-toggle='modal' data-target='#foo'>Open Modal</button><div class='modal' id='foo'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div></div></div></div>"
        );
    }

    function it_squawks_if_you_have_a_button_but_no_id()
    {
        $this->withButton()->shouldThrow('Bootstrapper\\Exceptions\\ModalException')->duringRender();
    }

    function it_allows_you_to_customise_the_button()
    {
        $button = new Button();

        $this->named('foo')->withButton($button->primary()->withValue('open'))->render()->shouldBe(
            "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#foo'>open</button><div class='modal' id='foo'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button></div></div></div></div>"
        );
    }

}

