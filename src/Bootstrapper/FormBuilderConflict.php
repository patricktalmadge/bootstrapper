<?php
/**
 * Bootstrapper FormBuilderConflict class
 */

namespace Bootstrapper;

// @codingStandardsIgnoreStart
if (class_exists('\\Collective\\Html\\FormBuilder')) {
    class FormBuilderConflict extends \Collective\Html\FormBuilder
    {
    }
} else {
    class FormBuilderConflict extends \Illuminate\Html\FormBuilder
    {
    }
}
// @codingStandardsIgnoreEnd
