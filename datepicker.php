<?php namespace Bootstrapper;

use \HTML;

/**
 * Datapicker for creating twitter bootstaop style datepickers.
 *
 * @package     Bundles
 * @subpackage  Bootstrapper
 * @author      Tim Reynolds - Follow @timjreynolds
 *
 * @see http://www.eyecon.ro/bootstrap-datepicker/
 */

Class Datepicker
{

    public static function create( $name, $value = null, $attributes = array() )
    {

        // Add the datepicker class
        $attributes = Helpers::add_class($attributes, 'datepicker');

        // return html
        return Form::text($name, $value, $attributes);
	}
}
