<?php
/**
 * Bootstrapper Form class
 */

namespace Bootstrapper;

use Collective\Html\FormBuilder;

/**
 * Creates Bootstrap 3 compliant forms
 *
 * @package Bootstrapper
 */
class Form extends FormBuilder
{

    /**
     * Constant for horizontal forms
     */
    const FORM_HORIZONTAL = 'form-horizontal';

    /**
     * Constant for inline forms
     */
    const FORM_INLINE = 'form-inline';

    /**
     * Constant for success
     */
    const FORM_SUCCESS = 'has-success';

    /**
     * Constant for warnings
     */
    const FORM_WARNING = 'has-warning';

    /**
     * Constant for errors
     */
    const FORM_ERROR = 'has-error';

    /**
     * Constant for large inputs
     */
    const INPUT_LARGE = 'input-lg';

    /**
     * Constant for form controllers
     */
    const FORM_CONTROL = 'form-control';

    /**
     * Constant for labels
     */
    const LABEL = 'control-label';

    /**
     * {@inheritdoc}
     * @param string|null $value   The value of the submit button
     * @param array       $options The options
     * @return string
     */
    public function submit($value = null, $options = array())
    {
        $options['class'] = isset($options['class']) ?
            'btn ' . Button::NORMAL . ' ' . $options['class'] :
            'btn ' . Button::NORMAL;
        return parent::submit($value, $options);
    }

    /**
     * {@inheritdoc}
     * @param string      $name    The name of the object this label will be
     *                             attached to
     * @param string|null $value   The text of the label
     * @param array       $options The options of the label
     * @return string
     */
    public function label($name, $value = null, $options = array(), $escape_html = true)
    {
        $options['class'] = isset($options['class']) ?
            self::LABEL . ' ' . $options['class'] :
            self::LABEL;

        return parent::label($name, $value, $options, $escape_html);
    }

    /**
     * Opens an inline form
     *
     * @param array $attributes The attributes of the array
     * @return string
     */
    public function inline($attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_INLINE . ' ' . $attributes['class'] :
            self::FORM_INLINE;

        return $this->open($attributes);
    }

    /**
     * Opens a horizontal form
     *
     * @param array $attributes
     * @return string
     */
    public function horizontal($attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_HORIZONTAL . ' ' . $attributes['class'] :
            self::FORM_HORIZONTAL;

        return $this->open($attributes);
    }

    /**
     * Creates a validation block
     *
     * @param string $type       The type of validation
     * @param string $label      The label
     * @param string $input      The input
     * @param array  $attributes The attributes of the validation block
     * @return string
     */
    public function validation($type, $label, $input, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            "form-group {$type} " . $attributes['class'] :
            "form-group {$type} ";
        $attributes = new Attributes($attributes);

        return "<div {$attributes}>{$label}{$input}</div>";
    }

    /**
     * Creates a success validation block
     *
     * @param string $label      The label
     * @param string $input      The input
     * @param array  $attributes The attributes of the validation block
     * @return string
     * @see Bootstrapper\\Form::validation()
     */
    public function success($label, $input, $attributes = [])
    {
        return ($this->validation(
            self::FORM_SUCCESS,
            $label,
            $input,
            $attributes
        ));
    }

    /**
     * Creates a warning validation block
     *
     * @param string $label      The label
     * @param string $input      The input
     * @param array  $attributes The attributes of the validation block
     * @return string
     * @see Bootstrapper\\Form::validation()
     */
    public function warning($label, $input, $attributes = [])
    {
        return ($this->validation(
            Form::FORM_WARNING,
            $label,
            $input,
            $attributes
        ));
    }

    /**
     * Creates an error validation block
     *
     * @param string $label      The label
     * @param string $input      The input
     * @param array  $attributes The attributes of the validation block
     * @return string
     * @see Bootstrapper\\Form::validation()
     */
    public function error($label, $input, $attributes = [])
    {
        return ($this->validation(
            Form::FORM_ERROR,
            $label,
            $input,
            $attributes
        ));
    }

    /**
     * Creates a feedback block with an icon
     *
     * @param string $label      The label
     * @param string $input      The input
     * @param string $icon       The icon
     * @param array  $attributes The attributes of the block
     * @return string
     */
    public function feedback($label, $input, $icon, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            'form-group has-feedback ' . $attributes['class'] :
            'form-group has-feedback';
        $attributes = new Attributes($attributes);
        $icon = "<span class='glyphicon glyphicon-{$icon} form-control-feedback'></span>";

        return "<div {$attributes}>{$label}{$input}{$icon}</div>";
    }

    /**
     * Creates a help block
     *
     * @param string $helpText The help text
     * @param array  $attributes
     * @return string
     */
    public function help($helpText, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            'help-block ' . $attributes['class'] :
            'help-block';
        $attributes = new Attributes($attributes);

        return "<span {$attributes}>{$helpText}</span>";
    }

    /**
     * Opens a horizontal form with a given model
     *
     * @param mixed $model
     * @param array $attributes
     * @return string
     * @see Bootstrapper\Form::horizontal()
     * @see Illuminate\Html::model()
     */
    public function horizontalModel($model, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_HORIZONTAL . ' ' . $attributes['class'] :
            self::FORM_HORIZONTAL;

        return $this->model($model, $attributes);
    }

    /**
     * Opens a inline form with a given model
     *
     * @param mixed $model
     * @param array $attributes
     * @return string
     * @see Bootstrapper\Form::inline()
     * @see Illuminate\Html::model()
     */
    public function inlineModel($model, $attributes = [])
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_INLINE . ' ' . $attributes['class'] :
            self::FORM_INLINE;

        return $this->model($model, $attributes);
    }

    /**
     * {@inheritdoc}
     * @param string $name
     * @param array  $list
     * @param null   $selected
     * @param array  $attributes
     * @return string
     */
    public function select(
        $name,
        $list = array(),
        $selected = null,
        $attributes = array()
    ) {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::select($name, $list, $selected, $attributes);
    }

    /**
     * {@inheritdoc}
     * @param string      $name       The name of the text area
     * @param string|null $value      The default value
     * @param array       $attributes The attributes of the text area
     * @return string
     */
    public function textarea($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::textarea($name, $value, $attributes);
    }

    /**
     * {@inheritdoc}
     * @param string $name       The name of the password input
     * @param array  $attributes The attributes of the input
     * @return string
     */
    public function password($name, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::password($name, $attributes);
    }

    /**
     * {@inheritdoc}
     * @param string      $name       The name of the text input
     * @param string|null $value      The default value
     * @param array       $attributes The attributes of the input
     * @return string
     */
    public function text($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::text($name, $value, $attributes);
    }

    /**
     * {@inheritdoc}
     * @param string      $name       The name of the email input
     * @param string|null $value      The default value of the input
     * @param array       $attributes The attributes of the email input
     * @return string
     */
    public function email($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::email($name, $value, $attributes);
    }

    /**
     * Creates a datetime form element
     *
     * @param string $name       The name of the element
     * @param null   $value      The value
     * @param array  $attributes The attributes
     * @return string
     * @see Illuminate\FormBuilder\input()
     */
    public function datetime($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('datetime', $name, $value, $attributes);
    }

    /**
     * Creates a datetime local element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     * @see Illuminate\FormBuilder\input()
     */
    public function datetimelocal($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('datetime-local', $name, $value, $attributes);
    }

    /**
     * Creates a date input
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function date($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('date', $name, $value, $attributes);
    }

    /**
     * Creates a month input
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function month($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('month', $name, $value, $attributes);
    }

    /**
     * Creates a week form element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function week($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('week', $name, $value, $attributes);
    }

    /**
     * Creates a time form element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function time($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('time', $name, $value, $attributes);
    }

    /**
     * Creates a number form element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function number($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('number', $name, $value, $attributes);
    }

    /**
     * Creates a url form element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function url($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('url', $name, $value, $attributes);
    }

    /**
     * Creates a search element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function search($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('search', $name, $value, $attributes);
    }

    /**
     * Creates a tel element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function tel($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('tel', $name, $value, $attributes);
    }

    /**
     * Creates a color element
     *
     * @param string $name The name of the element
     * @param null   $value
     * @param array  $attributes
     * @return string
     */
    public function color($name, $value = null, $attributes = array())
    {
        $attributes['class'] = isset($attributes['class']) ?
            self::FORM_CONTROL . ' ' . $attributes['class'] :
            self::FORM_CONTROL;

        return parent::input('color', $name, $value, $attributes);
    }

    /**
     * Determine whether the form element with the given name
     * has any validation errors.
     *
     * @param  string $name
     * @return bool
     */
    public function hasErrors($name)
    {
        $session = $this->getSessionStore();
        if (is_null($session) || !$session->has('errors')) {
            // If the session is not set, or the session doesn't contain
            // any errors, the form element does not have any errors
            // applied to it.
            return false;
        }
        // Get the errors from the session.
        $errors = $session->get('errors');
        // Check if the errors contain the form element with the given name.
        return $errors->has($this->transformKey($name));
    }

    /**
     * Get the formatted errors for the form element with the given name.
     *
     * @param  string   $name
     * @return string
     */
    public function getFormattedError($name)
    {
        if (!$this->hasErrors($name)) {
            // If the form element does not have any errors, return
            // an emptry string.
            return '';
        }
        // Get the errors from the session.
        $errors = $this->getSessionStore()->get('errors');

        // Return the formatted error message, if the form element has any.
        return $errors->first($this->transformKey($name), $this->help(':message'));
    }
}
