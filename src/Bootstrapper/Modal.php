<?php
/**
 * Bootstrapper Modal class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant modal
 *
 * @package Bootstrapper
 */
class Modal extends RenderedObject
{

    /**
     * @var string The title of the modal
     */
    protected $title;

    /**
     * @var string The body of the modal
     */
    protected $body;

    /**
     * @var string The footer of the modal
     */
    protected $footer;

    /**
     * @var string The name of the modal
     */
    protected $name;

    /**
     * @var string The button of the modal
     */
    protected $button;

    /**
     * Renders the modal
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes($this->attributes, ['class' => 'modal']);

        $string = $this->renderButton($attributes);

        $string .= "<div {$attributes}><div class='modal-dialog'><div class='modal-content'>";

        $string .= $this->renderHeader();
        $string .= $this->renderBody();
        $string .= $this->renderFooter();

        $string .= "</div></div></div>";

        return $string;
    }

    /**
     * Sets the title of the modal
     *
     * @param string $title
     * @return $this
     */
    public function withTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Renders the header of the modal
     *
     * @return string
     */
    protected function renderHeader()
    {
        $title = '';
        if ($this->title) {
            $title .= "<h4 class='modal-title'>{$this->title}</h4>";
        }

        return "<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>"
            . "&times;</button>{$title}</div>";
    }

    /**
     * Sets the body of the modal
     *
     * @param string $body The new body of the modal
     * @return $this
     */
    public function withBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Renders the body
     *
     * @return string
     */
    protected function renderBody()
    {
        return $this->body ? "<div class='modal-body'>{$this->body}</div>" : '';
    }

    /**
     * Renders the footer
     *
     * @return string
     */
    protected function renderFooter()
    {
        return $this->footer ? "<div class='modal-footer'>{$this->footer}</div>" : '';
    }

    /**
     * Set the footer of the modal
     *
     * @param string $footer The footer
     * @return $this
     */
    public function withFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Sets the name of the modal
     *
     * @param string $name The name of the modal
     * @return $this
     */
    public function named($name)
    {
        $this->name = $name;
        $this->attributes['id'] = $name;

        return $this;
    }

    /**
     * Sets the button
     *
     * @param Button $button The button to open the modal with
     * @return $this
     */
    public function withButton(Button $button = null)
    {
        if ($button) {
            $this->button = $button;
        } else {
            $button = new Button();

            $this->button = $button->withValue('Open Modal');
        }

        return $this;
    }

    /**
     * Renders the button
     *
     * @param Attributes $attributes The attributes of the modal
     * @return string
     */
    protected function renderButton(Attributes $attributes)
    {
        if (!$this->button) {
            return '';
        }

        if (!isset($attributes['id'])) {
            $attributes['id'] = Helpers::generateId($this);
        }

        $this->button->addAttributes(
            ['data-toggle' => 'modal', 'data-target' => "#{$attributes['id']}"]
        )->render();

        return $this->button->render();
    }
}
