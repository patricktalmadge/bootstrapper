<?php
use Bootstrapper\Form;
use Bootstrapper\Button;

class FormTest extends BootstrapperWrapper
{
    public function types()
    {
        return array(
            array(
                'search_open', 
                '<form class="foo form-search" data-foo="bar" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'search_open_secure',
                '<form class="foo form-search" data-foo="bar" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'search_open_for_files',
                '<form class="foo form-search" data-foo="bar" enctype="multipart/form-data" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'search_open_secure_for_files',
                '<form class="foo form-search" data-foo="bar" enctype="multipart/form-data" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'inline_open',
                '<form class="foo form-inline" data-foo="bar" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'inline_open_secure',
                '<form class="foo form-inline" data-foo="bar" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'inline_open_for_files',
                '<form class="foo form-inline" data-foo="bar" enctype="multipart/form-data" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'inline_open_secure_for_files',
                '<form class="foo form-inline" data-foo="bar" enctype="multipart/form-data" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'horizontal_open',
                '<form class="foo form-horizontal" data-foo="bar" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'horizontal_open_secure',
                '<form class="foo form-horizontal" data-foo="bar" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'horizontal_open_for_files',
                '<form class="foo form-horizontal" data-foo="bar" enctype="multipart/form-data" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'horizontal_open_secure_for_files',
                '<form class="foo form-horizontal" data-foo="bar" enctype="multipart/form-data" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'vertical_open',
                '<form class="foo" data-foo="bar" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'vertical_open_secure',
                '<form class="foo" data-foo="bar" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'vertical_open_for_files',
                '<form class="foo" data-foo="bar" enctype="multipart/form-data" method="POST" action="http://:/index.php/login" accept-charset="UTF-8">'
                ),
            array(
                'vertical_open_secure_for_files',
                '<form class="foo" data-foo="bar" enctype="multipart/form-data" method="POST" action="https://:/index.php/login" accept-charset="UTF-8">'
                )
        );
    }

    /**
     * @dataProvider types
     */
    public function testFormOpen($type, $exepcted)
    {
        $form = Form::$type('login', 'POST', $this->testAttributes);
        $this->assertEquals($exepcted, $form);
    }

    public function testInlineHelp()
    {
        $exepcted = '<span class="foo help-inline" data-foo="bar">foobar</span>';
        $html = Form::inline_help('foobar', $this->testAttributes);
        $this->assertEquals($exepcted, $html);
    }
    
    public function testBlockHelp()
    {
        $exepcted = '<p class="foo help-block" data-foo="bar">foobar</p>';
        $html = Form::block_help('foobar', $this->testAttributes);
        $this->assertEquals($exepcted, $html);
    }

    public function displaytypes()
    {
        return array(
            array(Form::NORMAL),
            array(Form::WARNING),
            array(Form::ERROR),
            array(Form::SUCCESS),
        );
    }

    /**
     * @dataProvider displaytypes
     */
    public function testControlGroup($displaytype)
    {
        $class = $displaytype;

        if($displaytype != ''){
            $class = ' '.$displaytype;
        }

        $expected = '<div class="control-group'.$class.'"><label class="control-label" for="inputfoo">foo</label><div class="controls"><input type="text" name="inputfoo" id="inputfoo"></div></div>';

        $html = Form::control_group(
                    Form::label('inputfoo', 'foo'),
                    Form::text('inputfoo'), 
                    $displaytype
                );

        $this->assertEquals($expected, $html);
    }

    /**
     * @dataProvider displaytypes
     */
    public function testControlGroupFull($displaytype)
    {
        $class = $displaytype;

        if($displaytype != ''){
            $class = ' '.$displaytype;
        }

        $expected = '<div class="control-group'.$class.'"><label class="control-label" for="inputfoo">foo</label><div class="controls"><input type="text" name="inputfoo" id="inputfoo"><p class="help-block">You foobared that!</p></div></div>';

        $html = Form::control_group(
                    Form::label('inputfoo', 'foo'),
                    Form::text('inputfoo'), 
                    $displaytype, 
                    Form::block_help('You foobared that!')
                );

        $this->assertEquals($expected, $html);
    }

    public function testLabelledCheckboxMin() 
    {
        $html = Form::labelled_checkbox('foo', 'foo');
        $expected = '<label class="checkbox"><input type="checkbox" name="foo" value="1"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testLabelledCheckboxFull() 
    {
        $html = Form::labelled_checkbox('foo', 'foo', 'bar', true, $this->testAttributes);
        $expected = '<label class="checkbox"><input class="foo" data-foo="bar" checked="checked" type="checkbox" name="foo" value="bar"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testInlineLabelledCheckboxMin() 
    {
        $html = Form::inline_labelled_checkbox('foo', 'foo');
        $expected = '<label class="checkbox inline"><input type="checkbox" name="foo" value="1"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testInlineLabelledCheckboxFull() 
    {
        $html = Form::inline_labelled_checkbox('foo', 'foo', 'bar', true, $this->testAttributes);
        $expected = '<label class="checkbox inline"><input class="foo" data-foo="bar" checked="checked" type="checkbox" name="foo" value="bar"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testLabelledRadioMin() 
    {
        $html = Form::labelled_radio('foo', 'foo');
        $expected = '<label class="radio"><input type="radio" name="foo" value="1"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testLabelledRadioFull() 
    {
        $html = Form::labelled_radio('foo', 'foo', 'bar', true, $this->testAttributes);
        $expected = '<label class="radio"><input class="foo" data-foo="bar" checked="checked" type="radio" name="foo" value="bar"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testInlineLabelledRadioMin() 
    {
        $html = Form::inline_labelled_radio('foo', 'foo');
        $expected = '<label class="radio inline"><input type="radio" name="foo" value="1"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testInlineLabelledRadioFull() 
    {
        $html = Form::inline_labelled_radio('foo', 'foo', 'bar', true, $this->testAttributes);
        $expected = '<label class="radio inline"><input class="foo" data-foo="bar" checked="checked" type="radio" name="foo" value="bar"> foo</label>';
        $this->assertEquals($expected, $html);
    }

    public function testMultiSelectMin()
    {
        $html = Form::multiselect('multiSelect', array('1', '2', '3', '4', '5'));
        $expected = '<select multiple="multiple" name="multiSelect"><option value="0">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option></select>';

        $this->assertEquals($expected, $html);
    }

    public function testMultiSelectFull()
    {
        $html = Form::multiselect('multiSelect', array('1', '2', '3', '4', '5'), '3', $this->testAttributes);
        $expected = '<select class="foo" data-foo="bar" multiple="multiple" name="multiSelect"><option value="0">1</option><option value="1">2</option><option value="2">3</option><option value="3" selected="selected">4</option><option value="4">5</option></select>';

        $this->assertEquals($expected, $html);
    }

    public function testUneditable()
    {
        $html = Form::uneditable('foo', $this->testAttributes);
        $expected = '<span class="foo uneditable-input" data-foo="bar">foo</span>';

        $this->assertEquals($expected, $html);
    }

    public function testFile()
    {
        $html = Form::file('foo', $this->testAttributes);
        $expected = '<input class="foo input-file" data-foo="bar" type="file" name="foo">';

        $this->assertEquals($expected, $html);
    }

    public function testSearchBox()
    {
        $html = Form::search_box('foo', 'bar', $this->testAttributes);
        $expected = '<input class="foo search-query" data-foo="bar" type="text" name="foo" value="bar">';

        $this->assertEquals($expected, $html);
    }

    public function testActionBar()
    {
        $html = Form::actions(array(Button::primary_submit('Save changes'), Form::button('Cancel')));
        $expected = '<div class="form-actions"><button class="btn-primary btn" type="submit">Save changes</button> <button type="button" class="btn">Cancel</button></div>';

        $this->assertEquals($expected, $html);
    }

    public function testPrepend()
    {
        $html = Form::prepend(Form::text('inputfoo'), '$');
        $expected = '<div class="input-prepend"><span class="add-on">$</span><input type="text" name="inputfoo" id="inputfoo"></div>';

        $this->assertEquals($expected, $html);
    }

    public function testAppend()
    {
        $html = Form::append(Form::text('inputfoo'), '$');
        $expected = '<div class="input-append"><input type="text" name="inputfoo" id="inputfoo"><span class="add-on">$</span></div>';

        $this->assertEquals($expected, $html);
    }

    public function testPrependAppend()
    {
        $html = Form::prepend_append(Form::text('inputfoo'), '$', '.00');
        $expected = '<div class="input-prepend input-append"><span class="add-on">$</span><input type="text" name="inputfoo" id="inputfoo"><span class="add-on">.00</span></div>';

        $this->assertEquals($expected, $html);
    }
}