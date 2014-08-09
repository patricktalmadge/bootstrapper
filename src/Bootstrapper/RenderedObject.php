<?php
namespace Bootstrapper;

use Illuminate\Support\Facades\Facade;

abstract class RenderedObject extends Facade
{

    public function __toString()
    {
        return $this->render();
    }

    public abstract function render();

} 
