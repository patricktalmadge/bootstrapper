<?php

namespace spec\Bootstrapper;

use Bootstrapper\Form;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ControlGroupSpec extends ObjectBehavior
{
    function let(Form $form)
    {
        $this->beConstructedWith($form);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\ControlGroup');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<div class='form-group'></div>");
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<div class='form-group' data-foo='bar'></div>"
        );
    }

    function it_can_be_given_contents()
    {
        $this->withContents('<div>contents</div>')->render()->shouldBe(
            "<div class='form-group'><div>contents</div></div>"
        );
    }

    function it_can_be_given_contents_as_an_array(Form $form)
    {
        $form->label('first', 'First')->willReturn('label1');
        $form->checkbox('first', 'First')->willReturn('checkbox1');

        $form->label('second', 'Second')->willReturn('label2');
        $form->checkbox('second', 'Second')->willReturn('checkbox2');

        $this->withContents(
            [
                [
                    'label' => ['first', 'First'],
                    'input' => ['type' => 'checkbox', 'first', 'First']
                ],
                [
                    'label' => ['second', 'Second'],
                    'input' => ['type' => 'checkbox', 'second', 'Second']
                ]
            ]
        )->render()->shouldBe(
            "<div class='form-group'>label1 checkbox1<br />label2 checkbox2<br /></div>"
        );
    }

    function it_can_be_given_a_label()
    {
        $this->withLabel('foo')->render()->shouldBe(
            "<div class='form-group'>foo</div>"
        );
    }

    function it_can_be_given_a_label_with_a_size()
    {
        $this->withLabel('foo', 4)->render()->shouldBe(
            "<div class='form-group'>foo<div class='col-sm-8'></div></div>"
        );
    }

    function it_can_be_given_a_help_block()
    {
        $this->withHelp('foo')->render()->shouldBe("<div class='form-group'>foo</div>");
    }

    function it_places_the_help_block_in_the_correct_place()
    {
        $this->withLabel('bar')->withHelp('foo')->render()->shouldBe(
            "<div class='form-group'>barfoo</div>"
        );
    }

    function it_can_be_generated_in_one_go()
    {
        $this->generate('<div>label</div>', '<div>control</div>', '<div>help</div>')->render()->shouldBe(
            "<div class='form-group'><div>label</div><div>control</div><div>help</div></div>"
        );
    }

    function it_squawks_if_the_label_size_is_silly()
    {
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', 13);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', -1);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', -0);
        $this->shouldThrow('Bootstrapper\\Exceptions\\ControlGroupException')->duringWithLabel('', 12);
    }

    function it_handles_labels_correctly()
    {
        $mock = \Mockery::mock('Bootstrapper\\Form');

        $mock->shouldReceive('label')->with('foo')->andReturn('<label for="foo" class="control-label">Foo</label>');

        $this->withLabel($mock->label('foo'), 4)->render()->shouldBe(
            "<div class='form-group'><label for=\"foo\" class=\"control-label col-sm-4\">Foo</label><div class='col-sm-8'></div></div>"
        );
    }

}
