<?php
namespace Bootstrapper;


abstract class RenderedObject
{

    public function __toString()
    {
        return $this->render();
    }

} 