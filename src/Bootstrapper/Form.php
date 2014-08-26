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
    const FORM_CONTROL = 'form-control';
    const LABEL = 'control-label';

    public function label($name, $value = null, $options = array())
    {
        $options['class'] = isset($options['class']) ? self::LABEL . ' ' . $options['class'] : self::LABEL;

        return parent::label($name, $value, $options);
    }

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

    public function validation($type, $label, $input, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? "form-group {$type} " . $attributes['class'] : "form-group {$type} ";
        $attributes = new Attributes($attributes);

        return "<div {$attributes}>{$label}{$input}</div>";
    }

    public function success($label, $input, $attributes = [])
    {
        return ($this->validation(Form::FORM_SUCCESS, $label, $input, $attributes));
    }

    public function warning($label, $input, $attributes = [])
    {
        return ($this->validation(Form::FORM_WARNING, $label, $input, $attributes));
    }

    public function error($label, $input, $attributes = [])
    {
        return ($this->validation(Form::FORM_ERROR, $label, $input, $attributes));
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

    public function horizontalModel($model, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_HORIZONTAL . ' ' . $attributes['class'] : self::FORM_HORIZONTAL;

        return $this->model($model, $attributes);
    }

    public function inlineModel($model, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_INLINE . ' ' . $attributes['class'] : self::FORM_INLINE;

        return $this->model($model, $attributes);
    }

    public function select($name, $list = array(), $selected = null, $options = array())
    {
        $options['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::select($name, $list, $selected, $options);
    }

    public function textarea($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::textarea($name, $value, $attributes);
    }

    public function password($name, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::password($name, $attributes);
    }

    public function text($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::text($name, $value, $attributes);
    }

    public function email($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::email($name, $value, $attributes);
    }

    public function datetime($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('datetime',$name, $value, $attributes);
    }

    public function datetimelocal($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('datetime-local',$name, $value, $attributes);
    }

    public function date($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('date',$name, $value, $attributes);
    }

    public function month($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('month',$name, $value, $attributes);
    }

    public function week($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('week',$name, $value, $attributes);
    }

    public function time($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('time',$name, $value, $attributes);
    }

    public function number($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('number',$name, $value, $attributes);
    }

    public function url($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('url',$name, $value, $attributes);
    }

    public function search($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('search',$name, $value, $attributes);
    }

    public function tel($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('tel',$name, $value, $attributes);
    }

    public function color($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ? self::FORM_CONTROL . ' ' . $attributes['class'] : self::FORM_CONTROL;

        return parent::input('color',$name, $value, $attributes);
    }

}
