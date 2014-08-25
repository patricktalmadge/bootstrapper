<?php

namespace Bootstrapper;

class Tabbable extends RenderedObject
{
    const PILL = 'pill';
    const TAB = 'tab';

    /**
     * @var Navigation
     */
    private $links;
    private $contents = [];
    private $active = 0;
    private $type = 'tab';
    private $fade = false;

    public function __construct(Navigation $links)
    {
        $this->links = $links->autoroute(false)->withAttributes(['role' => 'tablist']);
    }

    public function render()
    {
        $string = $this->renderNavigation();
        $string .= $this->renderContents();

        return $string;
    }

    public function tabs($contents = [])
    {
        $this->links->tabs();
        $this->type = self::TAB;

        return $this->withContents($contents);
    }

    public function pills($contents = [])
    {
        $this->links->pills();
        $this->type = self::PILL;

        return $this->withContents($contents);
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    private function renderNavigation()
    {
        $this->links->links($this->createNavigationLinks());

        return $this->links->render();
    }

    private function createNavigationLinks()
    {
        $links = [];
        $count = 0;
        foreach ($this->contents as $link) {
            $links[] = [
                'link' => '#' . Helpers::slug($link['title']),
                'title' => $link['title'],
                'linkAttributes' => ['role' => 'tab', 'data-toggle' => $this->type],
                'active' => $count == $this->active
            ];
            $count += 1;
        }
        return $links;
    }

    private function renderContents()
    {
        $tabs = $this->createContentTabs();

        $string = '<div class=\'tab-content\'>';
        foreach ($tabs as $tab) {
            $string .= "<div {$tab['attributes']}>{$tab['content']}</div>";
        }

        $string .= '</div>';

        return $string;
    }

    private function createContentTabs()
    {
        $tabs = [];
        $count = 0;
        foreach ($this->contents as $item) {
            $itemAttributes = isset($item['attributes']) ? $item['attributes'] : [];
            $attributes = new Attributes($itemAttributes, ['class' => 'tab-pane', 'id' => Helpers::slug($item['title'])]);
            if ($this->fade) {
                $attributes['class'] .= ' fade';
            }
            if ($this->active == $count) {
                $attributes['class'] .= $this->fade ? ' in active' : ' active';
            }
            $tabs[] = [
                'content' => $item['content'],
                'attributes' => $attributes
            ];
            $count += 1;
        }

        return $tabs;
    }

    public function active($active)
    {
        $this->active = $active;

        return $this;
    }

    public function fade()
    {
        $this->fade = true;

        return $this;
    }
}
