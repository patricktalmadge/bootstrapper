<?php

namespace spec\Bootstrapper;

use Illuminate\Support\Collection;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Table');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<table class='table'></table>");
    }

    function it_can_be_given_a_type()
    {
        $types = ['striped', 'bordered', 'hover', 'condensed'];

        foreach ($types as $type) {
            $this->$type()->render()->shouldBe("<table class='table table-{$type}'></table>");
        }
    }

    function it_can_be_given_an_array_as_contents()
    {
        $this->withContents([['foo' => 'bar', 'baz' => 'bar'], ['foo' => 'gar', 'baz' => 'gar']])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table>"
        );
    }

    function it_can_sort_of_handle_keys_being_inconsistent()
    {
        $this->withContents([['foo' => 'bar', 'baz' => 'bar'], ['goo' => 'gar', 'gaz' => 'gar']])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th><th>baz</th><th>goo</th><th>gaz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td><td></td><td></td></tr><tr><td></td><td></td><td>gar</td><td>gar</td></tr></tbody></table>"
        );
    }

    function it_can_handle_being_given_an_eloquent_model()
    {
        $model1 = Mockery::mock('Eloquent');
        $model1->shouldReceive('getAttributes')->andReturn(['foo' => 'bar']);
        $model2 = Mockery::mock('Eloquent');
        $model2->shouldReceive('getAttributes')->andReturn(['foo' => 'baz']);
        $collection = new Collection([$model1, $model2]);
        $this->withContents($collection)->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead><tbody><tr><td>bar</td></tr><tr><td>baz</td></tr></tbody></table>"
        );
    }
}
