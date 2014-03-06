<?php namespace Bootstrapper;

class Accordion {

  protected $name;

  protected $attributes;

  protected $contents = array();

  protected $opened = 0;

  public function __construct($name, $attributes) {
    $this->name = $name;
    $this->attributes = $attributes;
  }

  public static function create($name, $attributes = array()) {
    return new static($name, $attributes);
  }

  public function withContents($contents, $opened = 0) {
    $this->contents = $contents;
    $this->opened = $opened;
    return $this;
  }

  public function __toString() {
    $name = $this->name;
    $attributes = Helpers::add_class($this->attributes, 'panel-group');
    $attributes = Helpers::add_class($attributes, $name, 'id');

    $string = "<div".Helpers::getContainer('html')->attributes($attributes) . ">";
    $count = 1;
    foreach($this->contents as $content) {
      $heading = $content[0];
      $body = $content[1];
      $panelAttributes = isset($content[2]) ? $content[2] : array();
      $panelAttributes = Helpers::add_class($panelAttributes, 'panel panel-default');
      
      $bodyAttributes = array('class' => 'panel-collapse collapse',
			      'id' => "$name-$count");		      
      $bodyAttributes = $count == $this->opened ? Helpers::add_class($bodyAttributes, 'in') : $bodyAttributes;
      
      $string .= "<div" . Helpers::getContainer('html')->attributes($panelAttributes) .">";
      $string .= "<div class='panel-heading'>";
      $string .= "<h4 class='panel-title'>";
      $string .= "<a class='accordion-toggle' data-toggle='collapse' data-parent='#$name' href='#$name-$count'>";
      $string .= $heading;
      $string .= "</a>";
      $string .= "</h4>";
      $string .= "</div>";
      

      $string .= "<div" .  Helpers::getContainer('html')->attributes($bodyAttributes) . ">";  
      $string .= "<div class='panel-body'>"; 
      $string .= $body;
      $string .= "</div>";
      $string .= "</div>";
      $string .= "</div>";
      $count += 1;
    }
    $string .= "</div>";

    return $string;
  }

  public function render() {
    return $this->__toString();
  }

}

?>
