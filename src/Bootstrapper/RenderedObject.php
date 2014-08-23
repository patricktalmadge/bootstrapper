<?php
namespace Bootstrapper;

use Illuminate\Support\Facades\Facade;

abstract class RenderedObject extends Facade
{

    public function __toString()
    {
        try
        {
            return $this->render();
        }
        catch (\Exception $e)
        {
            $class = get_class($e);
            return "<div><p class='bg-warning text-warning'>An exception of type <code>{$class}</code> was thrown with the message: <code>{$e->getMessage()}</code></div>";
        }
    }

    public abstract function render();

} 
