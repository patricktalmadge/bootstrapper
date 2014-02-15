<?php

include_once '_start.php';

/* <div class='panel-group' id='accordion'
/* <div class="panel panel-default"> */
/* <div class="panel-heading"> */
/* <h4 class="panel-title"> */
/* <a class="accordion-toggle" */
/* data-toggle="collapse" */
/* data-parent="#accordion" */
/* href="#collapse{{ $achievement->id }}"> */
/* {{ $achievement->title }}</a> *//*  */
/* </h4> */
/* </div> */
/* <div id="collapse{{ $achievement->id }}" */
/* class="panel-collapse collapse panel-body"> */
/* <p> */
/* {{ $achievement->description }} */
/* </p> */
/* <p> */
/* Achieved by {{ $achievement->users->count() }} member(s). */
/* <p> */
/* <a href='{{ route('achievements.show', $achievement->id) }}'>See more information about this achievement</a> */
/* </p> */
/* </div> */
/* </div> */

use Bootstrapper\Accordion;

class AccordionTest extends BootstrapperWrapper
{

  public function testWeCanCreateAnAccordion() {

    $accordion = Accordion::create('test');

    $matcher = array(
      'tag' => 'div',
      'attributes' => array(
        'class' => 'panel-group',
        'id' => 'test'
      )
    );

    $this->assertHtml($matcher, $accordion);

  }

}

?>
