<?php

namespace spec\Bootstrapper;

use Bootstrapper\Navigation;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TabbableSpec extends ObjectBehavior
{

    function let()
    {
        $url = \Mockery::mock('Illuminate\Routing\UrlGenerator');
        $navigation = new Navigation($url);

        $this->beConstructedWith($navigation);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Tabbable');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'></ul><div class='tab-content'></div>"
        );
    }

    function it_can_be_made_into_tabs_or_pills()
    {
        $this->tabs()->render()->shouldBe("<ul class='nav nav-tabs' role='tablist'></ul><div class='tab-content'></div>");
        $this->pills()->render()->shouldBe("<ul class='nav nav-pills' role='tablist'></ul><div class='tab-content'></div>");
    }

    function it_can_be_given_contents()
    {
        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='tab'>First</a></li><li><a href='#second' role='tab' data-toggle='tab'>Second</a></li><li><a href='#third' role='tab' data-toggle='tab'>Third</a></li></ul><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    function it_allows_you_to_specify_which_should_be_active()
    {
        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->active(1)->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'><li><a href='#first' role='tab' data-toggle='tab'>First</a></li><li class='active'><a href='#second' role='tab' data-toggle='tab'>Second</a></li><li><a href='#third' role='tab' data-toggle='tab'>Third</a></li></ul><div class='tab-content'><div class='tab-pane' id='first'>foo</div><div class='tab-pane active' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    function it_handles_being_pills_correctly()
    {
        $this->pills()->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-pills' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='pill'>First</a></li><li><a href='#second' role='tab' data-toggle='pill'>Second</a></li><li><a href='#third' role='tab' data-toggle='pill'>Third</a></li></ul><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    function it_allows_you_to_use_shortcuts()
    {
        $this->pills(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-pills' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='pill'>First</a></li><li><a href='#second' role='tab' data-toggle='pill'>Second</a></li><li><a href='#third' role='tab' data-toggle='pill'>Third</a></li></ul><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
        $this->tabs(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='tab'>First</a></li><li><a href='#second' role='tab' data-toggle='tab'>Second</a></li><li><a href='#third' role='tab' data-toggle='tab'>Third</a></li></ul><div class='tab-content'><div class='tab-pane active' id='first'>foo</div><div class='tab-pane' id='second'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }

    function it_allows_you_to_fade_things()
    {
        $this->tabs(
            [
                [
                    'title' => 'First',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo'
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->fade()->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='tab'>First</a></li><li><a href='#second' role='tab' data-toggle='tab'>Second</a></li><li><a href='#third' role='tab' data-toggle='tab'>Third</a></li></ul><div class='tab-content'><div class='tab-pane fade in active' id='first'>foo</div><div class='tab-pane fade' id='second'>foo</div><div class='tab-pane fade' id='third'>foo</div></div>"
        );
    }

    function it_allows_you_to_add_attributes_to_the_tabs()
    {
        $this->withContents(
            [
                [
                    'title' => 'First',
                    'content' => 'foo',
                    'attributes' => ['data-foo' => 'bar']
                ],
                [
                    'title' => 'Second',
                    'content' => 'foo',
                    'attributes' => ['id' => 'foo']
                ],
                [
                    'title' => 'Third',
                    'content' => 'foo'
                ]
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs' role='tablist'><li class='active'><a href='#first' role='tab' data-toggle='tab'>First</a></li><li><a href='#second' role='tab' data-toggle='tab'>Second</a></li><li><a href='#third' role='tab' data-toggle='tab'>Third</a></li></ul><div class='tab-content'><div class='tab-pane active' id='first' data-foo='bar'>foo</div><div class='tab-pane' id='foo'>foo</div><div class='tab-pane' id='third'>foo</div></div>"
        );
    }
}
