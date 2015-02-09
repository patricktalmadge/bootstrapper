<?php
/**
 * Bootstrapper Button class
 */

namespace Bootstrapper;

/**
 * Creates a Bootstrap 3 compliant Button
 *
 * @package Bootstrapper
 */
class Button extends RenderedObject
{

    /**
     * Constant for default buttons
     */
    const NORMAL = 'btn-default';

    /**
     * Constant for primary buttons
     */
    const PRIMARY = 'btn-primary';

    /**
     * Constant for success buttons
     */
    const SUCCESS = 'btn-success';

    /**
     * Constant for info buttons
     */
    const INFO = 'btn-info';

    /**
     * Constant for warning buttons
     */
    const WARNING = 'btn-warning';

    /**
     * Constant for danger buttons
     */
    const DANGER = 'btn-danger';

    /**
     * Constant for button links
     */
    const LINK = 'btn-link';

    /**
     * Constant for large buttons
     */
    const LARGE = 'btn-lg';

    /**
     * Constant for small buttons
     */
    const SMALL = 'btn-sm';

    /**
     * Constant for extra small buttons
     */
    const EXTRA_SMALL = 'btn-xs';

    /**
     * Constant for block buttons
     */
    const BLOCK = 'btn-block';

    /**
     * @var string The type of the button
     */
    protected $type = 'btn-default';

    /**
     * @var bool Whether the button is a block button or not
     */
    protected $block = false;

    /**
     * @var string The contents of the button
     */
    protected $value = '';

    /**
     * @var string The icon, if one should be used
     */
    protected $icon;

    /**
     * @var string The size of the button
     */
    protected $size;

    /**
     * @var bool Whether the button should be disabled
     */
    protected $disabled;

    /**
     * @var bool True if the icon should be after the text
     */
    protected $appendIcon;

    /**
     * @var string The url to link to if this is link button
     */
    protected $url;

    /**
     * Sets the type of the button
     *
     * @param $type string The new type of the button. Assumes that the btn-
     *              prefix is there
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the size of the button
     *
     * @param $size string The new size of the button. Assumes that the btn-
     *              prefix is there
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Renders the button
     *
     * @return string as a string
     */
    public function render()
    {
        // Set up sensible defaults
        $defaults = ['type' => 'button', 'class' => "btn {$this->type}"];

        if ($this->url) {
            // An <a> tag should not have a type attribute
            unset($defaults['type']);
        }

        $attributes = new Attributes($this->attributes, $defaults);

        // Add size and block status if needed
        if ($this->size) {
            $attributes->addClass($this->size);
        }

        if ($this->block) {
            $attributes->addClass(self::BLOCK);
        }

        // Add the icon if needed
        $value = $this->icon ? $this->getValueWithIcon() : $this->value;

        // Set disabled and url
        if ($this->disabled) {
            $attributes['disabled'] = 'disabled';
        }

        if ($this->url) {
            $attributes['href'] = $this->url;
        }

        // Create the right tag
        $tag = $this->url ? 'a' : 'button';

        return "<{$tag} {$attributes}>{$value}</{$tag}>";
    }

    /**
     * Creates a button with class .btn-default and the given contents
     *
     * @param string $contents The contents of the button The contents of the
     *                         button
     * @return Button
     */
    public function normal($contents = '')
    {
        return $this->setType(self::NORMAL)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-primary and the given contents
     *
     * @param string $contents The contents of the button The contents of the
     *                         button
     * @return Button
     */
    public function primary($contents = '')
    {
        return $this->setType(self::PRIMARY)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-success and the given contents
     *
     * @param string $contents The contents of the button The contents of the
     *                         button
     * @return Button
     */
    public function success($contents = '')
    {
        return $this->setType(self::SUCCESS)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-info and the given contents
     *
     * @param string $contents The contents of the button
     * @return Button
     */
    public function info($contents = '')
    {
        return $this->setType(self::INFO)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-warning and the given contents
     *
     * @param string $contents The contents of the button
     * @return Button
     */
    public function warning($contents = '')
    {
        return $this->setType(self::WARNING)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-danger and the given contents
     *
     * @param string $contents The contents of the button
     * @return Button
     */
    public function danger($contents = '')
    {
        return $this->setType(self::DANGER)
            ->withValue($contents);
    }

    /**
     * Creates an button with class .btn-link and the given contents
     *
     * @param string $contents The contents of the button
     * @return Button
     */
    public function link($contents = '')
    {
        return $this->setType(self::LINK)
            ->withValue($contents);
    }

    /**
     * Sets the button to be a block button
     *
     * @return $this
     */
    public function block()
    {
        $this->block = true;

        return $this;
    }

    /**
     * Makes the button a submit button
     *
     * @return $this
     */
    public function submit()
    {
        $this->attributes['type'] = 'submit';

        return $this;
    }

    /**
     * Makes the button a reset button
     *
     * @return $this
     */
    public function reset()
    {
        $this->attributes['type'] = 'reset';

        return $this;
    }

    /**
     * Sets the value of the button
     *
     * @param $value string The new value of the button
     * @return $this
     */
    public function withValue($value = '')
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Sets the button to be a large button
     *
     * @return $this
     */
    public function large()
    {
        return $this->setSize(self::LARGE);
    }

    /**
     * Sets the button to be a small button
     *
     * @return $this
     */
    public function small()
    {
        return $this->setSize(self::SMALL);
    }

    /**
     * Sets the button to be an extra small button
     *
     * @return $this
     */
    public function extraSmall()
    {
        return $this->setSize(self::EXTRA_SMALL);
    }

    /**
     * More descriptive version of withAttributes
     *
     * @see withAttributes
     * @param array $attributes The attributes to add
     * @return $this
     */
    public function addAttributes(array $attributes)
    {
        return $this->withAttributes($attributes);
    }

    /**
     * Disables the button
     *
     * @return $this
     */
    public function disable()
    {
        $this->disabled = true;

        return $this;
    }

    /**
     * Adds an icon to the button
     *
     * @param      $icon   string The icon to add
     * @param bool $append Whether the icon should be added after the text or
     *                     before
     * @return $this
     */
    public function withIcon($icon, $append = true)
    {
        $this->icon = $icon;
        $this->appendIcon = $append;

        return $this;
    }

    /**
     * Descriptive version of withIcon(). Adds the icon after the text
     *
     * @see withIcon
     * @param $icon string The icon to add
     * @return $this
     */
    public function appendIcon($icon)
    {
        return $this->withIcon($icon, true);
    }

    /**
     * Descriptive version of withIcon(). Adds the icon before the text
     *
     * @param $icon string The icon to add
     * @return $this
     */
    public function prependIcon($icon)
    {
        return $this->withIcon($icon, false);
    }

    /**
     * Adds a url to the button, making it a link. This will generate an <a> tag
     *
     * @param $url string The url to link to
     * @return $this
     */
    public function asLinkTo($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the type of the button
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of the button. Does not return the value with the icon
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Gets the attributes of the button
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Gets the value with the icon
     *
     * @return string The new value
     */
    protected function getValueWithIcon()
    {
        if ($this->appendIcon) {
            return $this->value ? "{$this->value} {$this->icon}" : $this->icon;
        } else {
            return $this->value ? "{$this->icon} {$this->value}" : $this->icon;
        }
    }
}
