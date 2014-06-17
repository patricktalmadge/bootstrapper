<?php

namespace Bootstrapper;

use Illuminate\Html\FormBuilder;

class Form extends FormBuilder
{

    const FORM_HORIZONTAL = 'form-horizontal';
    const FORM_INLINE = 'form-inline';
    const FORM_SUCCESS = 'has-success';
    const FORM_WARNING = 'has-warning';
    const FORM_ERROR = 'has-error';
    const INPUT_LARGE = 'input-lg';

    function inline($attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_INLINE . ' ' . $attributes['class'] : self::FORM_INLINE;

        return $this->open($attributes);
    }

    function horizontal($attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_HORIZONTAL . ' ' . $attributes['class'] : self::FORM_HORIZONTAL;

        return $this->open($attributes);
    }

    public function validation($type, $label, $input, $attributes = []) {
        $attributes['class'] = isset($attributes['class']) ? "form-group {$type} " . $attributes['class'] : "form-group {$type} ";
        $attributes = new Attributes($attributes);
        return "<div {$attributes}>{$label}{$input}</div>";
    }

    public function success($label, $input, $attributes = [])
    {
        return($this->validation(Form::FORM_SUCCESS, $label, $input, $attributes));
    }

    public function warning($label, $input, $attributes = [])
    {
        return($this->validation(Form::FORM_WARNING, $label, $input, $attributes));
    }

    public function error($label, $input, $attributes = [])
    {
        return($this->validation(Form::FORM_ERROR, $label, $input, $attributes));
    }

    public function feedback($label, $input, $icon, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? 'form-group has-feedback ' . $attributes['class'] : 'form-group has-feedback';
        $attributes = new Attributes($attributes);
        return "<div {$attributes}>{$label}{$input}<span class='glyphicon glyphicon-{$icon} form-control-feedback'></span></div>";
    }

    public function help($helpText, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? 'help-block ' . $attributes['class'] : 'help-block';
        $attributes = new Attributes($attributes);
        return "<span {$attributes}>{$helpText}</span>";
    }
}
