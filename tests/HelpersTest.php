<?php
include_once '_start.php';

use Bootstrapper\Helpers;

class HelpersTest extends BootstrapperWrapper
{

    public function testOutputCorrectCSSLinks() {
	$css = Helpers::get_CSS();

	$this->assertEquals("<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'><link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css'>", $css);
    }

    public function testOutputCorrectJSLinks() {
	$js = Helpers::get_JS();

	$this->assertEquals("<script src='http://code.jquery.com/jquery-2.1.0.min.js'></script><script src='//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>", $js);
    }

}

?>
