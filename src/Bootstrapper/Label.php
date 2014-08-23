<?php

namespace Bootstrapper;

class Label extends RenderedObject
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

    public function primary($contents = '')
    {
        $this->setType(self::LABEL_PRIMARY);

        return $this->withContents($contents);
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function success($contents = '')
    {
        $this->setType(self::LABEL_SUCCESS);

        return $this->withContents($contents);
    }

    public function info($contents = '')
    {
        $this->setType(self::LABEL_INFO);

        return $this->withContents($contents);
    }

    public function warning($contents = '')
    {
        $this->setType(self::LABEL_WARNING);

        return $this->withContents($contents);
    }

    public function danger($contents = '')
    {
        $this->setType(self::LABEL_DANGER);

        return $this->withContents($contents);
    }

    public function create($contents, $type = self::LABEL_DEFAULT)
    {
        $this->setType($type);

        return $this->withContents($contents);
    }

    public function normal($contents = '')
    {
        $this->setType(self::LABEL_DEFAULT);

        return $this->withContents($contents);
    }
}
