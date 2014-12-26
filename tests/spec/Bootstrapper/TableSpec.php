<?php

namespace spec\Bootstrapper;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Support\Collection;
use Mockery;
use PhpSpec\Exception\Example\ErrorException;
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
            $this->$type()->render()->shouldBe(
                "<table class='table table-{$type}'></table>"
            );
        }
    }

    function it_can_be_given_an_array_as_contents()
    {
        $this->withContents(
            [['foo' => 'bar', 'baz' => 'bar'], ['foo' => 'gar', 'baz' => 'gar']]
        )->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th><th>baz</th></tr></thead><tbody><tr><td>bar</td><td>bar</td></tr><tr><td>gar</td><td>gar</td></tr></tbody></table>"
        );
    }

    function it_can_sort_of_handle_keys_being_inconsistent()
    {
        $this->withContents(
            [['foo' => 'bar', 'baz' => 'bar'], ['goo' => 'gar', 'gaz' => 'gar']]
        )->render()->shouldBe(
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
        $wasThrown = false;
        try
        {
            $this->withContents($collection)->render()->shouldBe(
                "<table class='table'><thead><tr><th>foo</th></tr></thead><tbody><tr><td>bar</td></tr><tr><td>baz</td></tr></tbody></table>"
            );
        }
        catch(ErrorException $e)
        {
            if (strpos($e->getMessage(), 'An object that does not implement the TableInterface '
        . 'was passed to a table. This is depreciated and will be removed in '
        . 'a future version of Bootstrapper') === false)
            {
                throw $e;
            }
            $wasThrown = true;
        }

        if (!$wasThrown) {
            throw new ErrorException(
                E_USER_WARNING,
                'Expected an error to be triggered during ' . __METHOD__,
                __FILE__,
                __LINE__
            );
        }
    }

    function it_allows_you_to_ignore_attributes()
    {
        $this->withContents(
            [['foo' => 'bar', 'baz' => 'bar'], ['foo' => 'gar', 'baz' => 'gar']]
        )->ignore(['baz'])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead><tbody><tr><td>bar</td></tr><tr><td>gar</td></tr></tbody></table>"
        );
    }

    function it_allows_you_to_use_callbacks()
    {
        $this->withContents([['foo' => 0], ['foo' => 2]])
            ->callback(
                'foo',
                function ($field, $row) {
                    return 'Foo = ' . $field;
                }
            )
            ->callback(
                'Edit',
                function ($field, $row) {
                    return "<div>Edit {$row['foo']}</div>";
                }
            )
            ->render()
            ->shouldBe(
                "<table class='table'><thead><tr><th>foo</th><th>Edit</th></tr></thead><tbody><tr><td>Foo = 0</td><td><div>Edit 0</div></td></tr><tr><td>Foo = 2</td><td><div>Edit 2</div></td></tr></tbody></table>"
            );
    }

    function it_allows_you_to_only_return_certain_things()
    {
        $this->withContents(
            [['foo' => 'bar', 'baz' => 'bar'], ['foo' => 'gar', 'baz' => 'gar']]
        )->only(['foo'])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead><tbody><tr><td>bar</td></tr><tr><td>gar</td></tr></tbody></table>"
        );
    }

    function it_renders_headers_if_you_use_only()
    {
        $this->only(['foo'])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead></table>"
        );
    }

    function it_renders_headers_if_you_use_callbacks()
    {
        $this->callback(
            'foo',
            function () {
            }
        )->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead></table>"
        );
    }

    function it_uses_the_correct_order_when_only_is_used()
    {
        $this->only(['foo', 'bar', 'baz'])->withContents(
            [
                [
                    'baz' => 'baz',
                    'foo' => 'foo',
                    'bar' => 'bar'
                ]
            ]
        )->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th><th>bar</th><th>baz</th></tr></thead><tbody><tr><td>foo</td><td>bar</td><td>baz</td></tr></tbody></table>"
        );
    }

    function it_allows_you_to_add_a_footer()
    {
        $this->withFooter('Foo')->render()->shouldBe(
            "<table class='table'><tfoot>Foo</tfoot></table>"
        );
    }

    function it_renders_the_tfoot_tag_before_the_body()
    {
        $this->withContents(
            [
                [
                    'foo' => 'foo'
                ]
            ]
        )->withFooter('Foo')->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th></tr></thead><tfoot>Foo</tfoot><tbody><tr><td>foo</td></tr></tbody></table>"
        );
    }

    function it_expects_something_that_implements_the_table_interface()
    {
        $item = new TableSpecFoo();

        $this->withContents([$item])->render()->shouldBe(
            "<table class='table'><thead><tr><th>foo</th><th>bar</th></tr></thead><tbody><tr><td>goo</td><td>gar</td></tr></tbody></table>"
        );
    }
}

class TableSpecFoo implements TableInterface
{

    private $values = [
        'foo' => 'goo',
        'bar' => 'gar',
    ];

    public function getTableHeaders()
    {
        return array_keys($this->values);
    }

    public function getValueForHeader($header)
    {
        return $this->values[$header];
    }
}
