<?php
/**
 * Bootstrapper label class
 */

namespace Bootstrapper;

/**
 * Creates bootstrap 3 compliant labels
 *
 * @package Bootstrapper
 */
class Label extends RenderedObject
{

    /**
     * Constant for primary labels
     */
    const LABEL_PRIMARY = 'label-primary';

    /**
     * Constant for success labels
     */
    const LABEL_SUCCESS = 'label-success';

    /**
     * Constant for info labels
     */
    const LABEL_INFO = 'label-info';

    /**
     * Constant for warning labels
     */
    const LABEL_WARNING = 'label-warning';

    /**
     * Constant for danger labels
     */
    const LABEL_DANGER = 'label-danger';

    /**
     * Constant for default labels
     */
    const LABEL_DEFAULT = 'label-default';

    /**
     * @var string The type of the label
     */
    protected $type = 'label-default';

    /**
     * @var string The contents of the label
     */
    protected $contents;

    /**
     * Renders the label
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            [
                'class' => "label {$this->type}"
            ]
        );

        return "<span {$attributes}>{$this->contents}</span>";
    }

    /**
     * Sets the contents of the label
     *
     * @param string $contents The new contents of the label
     * @return $this
     */
    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * Sets the type of the label. Assumes that the label- prefix is already set
     *
     * @param string $type The new type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Creates a primary label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function primary($contents = '')
    {
        $this->setType(self::LABEL_PRIMARY);

        return $this->withContents($contents);
    }

    /**
     * Creates a success label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function success($contents = '')
    {
        $this->setType(self::LABEL_SUCCESS);

        return $this->withContents($contents);
    }

    /**
     * Creates an info label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function info($contents = '')
    {
        $this->setType(self::LABEL_INFO);

        return $this->withContents($contents);
    }

    /**
     * Creates a warning label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function warning($contents = '')
    {
        $this->setType(self::LABEL_WARNING);

        return $this->withContents($contents);
    }

    /**
     * Creates a danger label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function danger($contents = '')
    {
        $this->setType(self::LABEL_DANGER);

        return $this->withContents($contents);
    }

    /**
     * Creates a label
     *
     * @param string $contents The contents of the label
     * @param string $type     The type to use
     * @return $this
     */
    public function create($contents, $type = self::LABEL_DEFAULT)
    {
        $this->setType($type);

        return $this->withContents($contents);
    }

    /**
     * Creates a normal label
     *
     * @param string $contents The contents of the label
     * @return $this
     */
    public function normal($contents = '')
    {
        $this->setType(self::LABEL_DEFAULT);

        return $this->withContents($contents);
    }
}
