<?php namespace Bootstrapper;

class Panel {

  protected $attributes;

  protected $header;

  protected $body;

  protected $footer;

  public function __construct($attributes = array()) {
    $this->attributes = $attributes;
  }

  public static function __callStatic($method, $parameters) {
    $method = $method != 'normal'? $method : 'default';
    $parameters = $parameters ? $parameters : array(array());
    $parameters = Helpers::add_class($parameters[0], 'panel panel-' . $method);
    return new static($parameters);
  }

  public function __toString() {

    $string = "<div".Helpers::getContainer('html')->attributes($this->attributes) . ">";
    if ($this->header) {
      $string .= "<div class='panel-heading'>";
      $string .= "<h3 class='panel-title'>" . $this->header . "</h3>";
      $string .= "</div>";
    }
    if ($this->body) {
      $string .= "<div class='panel-body'>";
      $string .= $this->body;
      $string .= "</div>";
    }
    if ($this->footer) {
      $string .= "<div class='panel-footer'>";
      $string .= $this->footer;
      $string .= "</div>";
    }
    $string .= "</div>";

    return $string;
    
  }

  public static function create($type, $parameters) {

    return static::$type($parameters);
    
  }

  public function header($header) {
    $this->header = $header;
    return $this;
  }

  public function body($body) {
    $this->body = $body;
    return $this;
  }

  public function footer($footer) {
    $this->footer = $footer;
    return $this;
  }

  public function render() {
    return $this->__toString();
  }

}

?>
