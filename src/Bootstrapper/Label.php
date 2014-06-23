<?php

namespace Bootstrapper;

class Label
{

    const LABEL_PRIMARY = 'label-primary';
    const LABEL_SUCCESS = 'label-success';
    const LABEL_INFO = 'label-info';
    const LABEL_WARNING = 'label-warning';
    const LABEL_DANGER = 'label-danger';
    const LABEL_DEFAULT = 'label-default';
    private $type = 'label-default';
    private $contents;

    public function render()
    {
        return "<span class='label {$this->type}'>{$this->contents}</span>";
    }

    public function withContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    public function primary()
    {
        $this->setType(self::LABEL_PRIMARY);

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function success()
    {
        $this->setType(self::LABEL_SUCCESS);

        return $this;
    }

    public function info()
    {
        $this->setType(self::LABEL_INFO);

        return $this;
    }

    public function warning()
    {
        $this->setType(self::LABEL_WARNING);

        return $this;
    }

    public function danger()
    {
        $this->setType(self::LABEL_DANGER);

        return $this;
    }

    public function __toString()
    {
        return $this->render();
    }

    public function create($contents, $type = self::LABEL_DEFAULT)
    {
        $this->setType($type);
        return $this->withContents($contents);
    }
}
