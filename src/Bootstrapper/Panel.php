<?php
/**
 * Bootstrapper Panel class
 */

namespace Bootstrapper;

/**
 * Creates Bootstrap 3 compliant panels
 *
 * @package Bootstrapper
 */
class Panel extends RenderedObject
{

    /**
     * Constant for primary panels
     */
    const PRIMARY = 'panel-primary';

    /**
     * Constant for success panels
     */
    const SUCCESS = 'panel-success';

    /**
     * Constant for info panels
     */
    const INFO = 'panel-info';

    /**
     * Constant for warning panels
     */
    const WARNING = 'panel-warning';

    /**
     * Constant for danger panels
     */
    const DANGER = 'panel-danger';

    /**
     * Constant for default panels
     */
    const NORMAL = 'panel-default';

    /**
     * @var string The type of the panel
     */
    protected $type = self::NORMAL;

    /**
     * @var string The header of the panel
     */
    protected $header;

    /**
     * @var string The body of the panel
     */
    protected $body;

    /**
     * @var string|Table The table of the panel
     */
    protected $table;

    /**
     * @var string The footer of the panel
     */
    protected $footer;

    /**
     * Renders the panel
     *
     * @return string
     */
    public function render()
    {
        $attributes = new Attributes(
            $this->attributes,
            ['class' => "panel {$this->type}"]
        );
        $string = "<div {$attributes}>";

        if ($this->header) {
            $string .= $this->renderHeader();
        }

        if ($this->body) {
            $string .= $this->renderBody();
        }

        if ($this->table) {
            $string .= $this->renderTable();
        }

        if ($this->footer) {
            $string .= $this->renderFooter();
        }

        $string .= "</div>";

        return $string;
    }

    /**
     * Creates a primary panel
     *
     * @return $this
     */
    public function primary()
    {
        $this->setType(self::PRIMARY);

        return $this;
    }

    /**
     * Creates a success panel
     *
     * @return $this
     */
    public function success()
    {
        $this->setType(self::SUCCESS);

        return $this;
    }

    /**
     * Creates an info panel
     *
     * @return $this
     */
    public function info()
    {
        $this->setType(self::INFO);

        return $this;
    }

    /**
     * Creates an warning panel
     *
     * @return $this
     */
    public function warning()
    {
        $this->setType(self::WARNING);

        return $this;
    }

    /**
     * Creates an danger panel
     *
     * @return $this
     */
    public function danger()
    {
        $this->setType(self::DANGER);

        return $this;
    }

    /**
     * Sets the type of the panel
     *
     * @param string $type The new type. Assume the panel- prefix
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Sets the header of the panel
     *
     * @param string $header The header
     * @return $this
     */
    public function withHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Renders the header
     *
     * @return string
     */
    protected function renderHeader()
    {
        $string = "<div class='panel-heading'>";
        $string .= "<h3 class='panel-title'>{$this->header}</h3>";
        $string .= '</div>';

        return $string;
    }

    /**
     * Sets the body of the panel
     *
     * @param string $body The body
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
        return "<div class='panel-body'>{$this->body}</div>";
    }

    /**
     * Sets the table of the panel
     *
     * @param string|Table $table The table
     * @return $this
     */
    public function withTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Renders the body
     *
     * @return string
     */
    protected function renderTable()
    {
        if ($this->table instanceof Table) {
            return $this->table->render();
        } else {
            return $this->table;
        }
    }

    /**
     * Sets the footer
     *
     * @param string $footer The new footer
     * @return $this
     */
    public function withFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Renders the footer
     *
     * @return string
     */
    protected function renderFooter()
    {
        return "<div class='panel-footer'>{$this->footer}</div>";
    }

    /**
     * Creates a normal panel
     *
     * @return $this
     */
    public function normal()
    {
        $this->setType(self::NORMAL);

        return $this;
    }
}
