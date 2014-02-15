<?php namespace Bootstrapper;

class Accordion {

  protected $name;

  protected $attributes;

  public function __construct($name, $attributes) {
    $this->name = $name;
    $this->attributes = $attributes;
  }

  public static function create($name, $attributes = array()) {
    return new static($name, $attributes);
  }

  public function __toString() {
    $attributes = Helpers::add_class($this->attributes, 'panel-group');
    $attributes = Helpers::add_class($attributes, $this->name, 'id');
    
    $string = "<div".Helpers::getContainer('html')->attributes($attributes) . ">";

    $string .= "</div>";

    return $string;
  }

  public function render() {
    return $this->__toString();
  }

}

?>
