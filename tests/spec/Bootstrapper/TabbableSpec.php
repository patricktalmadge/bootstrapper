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
}
