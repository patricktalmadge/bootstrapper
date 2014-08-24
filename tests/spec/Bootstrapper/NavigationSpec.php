<?php

namespace spec\Bootstrapper;

use Bootstrapper\Navigation;
use Illuminate\Routing\UrlGenerator;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NavigationSpec extends ObjectBehavior
{

    function let(UrlGenerator $url)
    {
        $url->current()->willReturn('link');

        $this->beConstructedWith($url);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bootstrapper\Navigation');
        $this->shouldHaveType('Bootstrapper\RenderedObject');
    }

    function it_can_be_rendered()
    {
        $this->render()->shouldBe("<ul class='nav nav-tabs'></ul>");
    }

    function it_can_be_given_attributes()
    {
        $this->withAttributes(['data-foo' => 'bar'])->render()->shouldBe(
            "<ul class='nav nav-tabs' data-foo='bar'></ul>"
        );
    }

    function it_can_be_made_into_pills()
    {
        $this->pills()->render()->shouldBe("<ul class='nav nav-pills'></ul>");
    }

    function it_can_be_made_into_a_navbar()
    {
        $this->navbar()->render()->shouldBe("<ul class='nav navbar-nav'></ul>");
    }

    function it_can_be_given_contents()
    {
        $this->links(
            [
                [
                    'link' => 'foo',
                    'title' => 'bar',
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_allows_you_to_use_shortcut_methods()
    {
        $types = ['pills', 'tabs'];

        foreach ($types as $type) {
            $this->$type(
                [
                    [
                        'link' => 'foo',
                        'title' => 'bar',
                    ],
                    [
                        'link' => 'goo',
                        'title' => 'gar',
                    ],
                ]
            )->render()->shouldBe(
                "<ul class='nav nav-{$type}'><li><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
            );
        }

    }

    function it_provides_autorouting()
    {
        $this->links(
            [
                [
                    'link' => 'link',
                    'title' => 'bar',
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='active'><a href='link'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_allows_you_to_turn_off_autorouting()
    {
        $this->autoroute(false)->links(
            [
                [
                    'link' => 'link',
                    'title' => 'bar',
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li><a href='link'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_creates_dropdown_menus()
    {
        $this->links([
            [
                'dropdown',
                [
                    [
                        'link' => 'foo',
                        'title' => 'bar',
                    ],
                    [
                        'link' => 'goo',
                        'title' => 'gar',
                    ],
                ]
            ]
        ])->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>dropdown <span class='caret'></span></a><ul class='dropdown-menu' role='menu'><li><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul></li></ul>"
        );
    }

    function it_auto_actives_dropdown_menus_correctly()
    {
        $this->links([
            [
                'dropdown',
                [
                    [
                        'link' => 'link',
                        'title' => 'bar',
                    ],
                    [
                        'link' => 'goo',
                        'title' => 'gar',
                    ],
                ]
            ]
        ])->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='dropdown active'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>dropdown <span class='caret'></span></a><ul class='dropdown-menu' role='menu'><li><a href='link'>bar</a></li><li><a href='goo'>gar</a></li></ul></li></ul>"
        );
    }

    function it_can_be_justified()
    {
        $this->justified()->render()->shouldBe(
            "<ul class='nav nav-tabs nav-justified'></ul>"
        );
    }

    function it_can_be_stacked()
    {
        $this->stacked()->render()->shouldBe(
            "<ul class='nav nav-tabs nav-stacked'></ul>"
        );
    }

    function it_allows_you_to_disable_a_link()
    {
        $this->links(
            [
                [
                    'link' => 'foo',
                    'title' => 'bar',
                    'disabled' => true
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='disabled'><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_allows_you_to_declare_a_link_as_active()
    {
        $this->links(
            [
                [
                    'link' => 'foo',
                    'title' => 'bar',
                    'active' => true
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='active'><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_allows_you_to_give_attributes_to_the_links()
    {
        $this->links(
            [
                [
                    'link' => 'foo',
                    'title' => 'bar',
                    'linkAttributes' => ['data-foo' => 'bar', 'class' => 'baz']
                ],
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li><a href='foo' data-foo='bar' class='baz'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_lets_you_add_attributes_using_the_shortcut_methods()
    {

        $types = ['pills', 'tabs'];
        $attributes = ['class' => 'foo', 'data-bar' => 'baz'];

        foreach ($types as $type) {
            $this->$type(
                [
                    [
                        'link' => 'foo',
                        'title' => 'bar',
                    ],
                    [
                        'link' => 'goo',
                        'title' => 'gar',
                    ],
                ], $attributes
            )->render()->shouldBe(
                "<ul class='nav nav-{$type} foo' data-bar='baz'><li><a href='foo'>bar</a></li><li><a href='goo'>gar</a></li></ul>"
            );
        }
    }

    function it_lets_you_use_the_dividers()
    {
        $this->links(
            [
                [
                    'link' => 'foo',
                    'title' => 'bar',
                ],
                Navigation::NAVIGATION_DIVIDER,
                [
                    'link' => 'goo',
                    'title' => 'gar',
                ],
            ]
        )->render()->shouldBe(
            "<ul class='nav nav-tabs'><li><a href='foo'>bar</a></li><li class='divider'></li><li><a href='goo'>gar</a></li></ul>"
        );
    }

    function it_lets_you_use_the_dividers_inside_a_dropdown()
    {
        $this->links([
                [
                    'dropdown',
                    [
                        [
                            'link' => '#',
                            'title' => 'bar',
                        ],
                        Navigation::NAVIGATION_DIVIDER,
                        [
                            'link' => '#',
                            'title' => 'gar',
                        ],
                    ]
                ]
            ])->render()->shouldBe(
            "<ul class='nav nav-tabs'><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>dropdown <span class='caret'></span></a><ul class='dropdown-menu' role='menu'><li><a href='#'>bar</a></li><li class='divider'></li><li><a href='#'>gar</a></li></ul></li></ul>"
        );
    }
}
