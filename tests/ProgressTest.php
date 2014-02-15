<?php
include_once '_start.php';

use Bootstrapper\Progress;

class ProgressTest extends BootstrapperWrapper
{
    // Matchers ------------------------------------------------------ /

    private function matchProgress($type = 'normal', $width = 50, $striped = false, $active = false)
    {
        $class = 'foo';

        if($striped) $class .= ' progress-striped';
        if($active) $class .= ' active';
        $type = ($type != 'normal') ? ' progress-bar-'.$type : '';

        return array(
            'tag' => 'div',
            'attributes' => array(
                'class'    => $class . ' progress',
                'data-foo' => 'bar',
            ),
            'child' => array(
                'tag' => 'div',
                'attributes' => array(
                    'class' => 'progress-bar' . $type,
                    'style' => 'width: ' .$width. '%;'
                ),
            ),
        );
    }

    // Data providers ------------------------------------------------ /

    public function provideBars()
    {
        return array(
            array('normal'),
            array('success'),
            array('info'),
            array('warning'),
            array('danger'),
        );
    }

    // Tests --------------------------------------------------------- /

    /**
     * @dataProvider provideBars
     */
    public function testSimple($class)
    {
        $progress = Progress::$class(50, $this->testAttributes);
        $matcher = $this->matchProgress($class);

        $this->assertHTML($matcher, $progress);
    }

    public function testStacked()
    {
        $progress = Progress::danger(
            array(25 => 'success', 50 => 'error', 10 => 'warning'),
            $this->testAttributes
        );

        // Build more complex matcher
        $matcher = $this->matchProgress();
        $matcher['attributes']['class'] = 'foo progress';
        $matcher['child']['attributes']['class'] = 'progress-bar progress-bar-error';
        $matcher['descendant'] = array(
            'tag' => 'div',
            'attributes' => array(
                'class' => 'progress-bar progress-bar-success',
                'style' => 'width: 25%;'
            ),
        );
        $matcher['children'] = array(
            'count' => 3,
            'only' => array(
                'tag' => 'div',
                'attributes' => array('class' => 'progress-bar'),
            ),
        );

        $this->assertHTML($matcher, $progress);
    }

    public function testFloat()
    {
        $progress = Progress::success(5.40, $this->testAttributes);
        $matcher = $this->matchProgress('success', 5);

        $this->assertHTML($matcher, $progress);
    }

    public function testAutomatic()
    {
        $classes = array(
            0   => 'danger',
            20  => 'danger',
            40  => 'warning',
            60  => 'info',
            80  => 'success',
            100 => 'success');

        for ($i = 0; $i <= 100; $i = $i + 20) {
            $progress = Progress::automatic($i, $this->testAttributes);
            $matcher = $this->matchProgress($classes[$i], $i);

            $this->assertHTML($matcher, $progress);
        }
    }

    public function testStriped()
    {
        $progress = Progress::striped_info(50, $this->testAttributes);
        $matcher = $this->matchProgress('info', 50, true);

        $this->assertHTML($matcher, $progress);
    }

    public function testActive()
    {
        $progress = Progress::active_info(50, $this->testAttributes);
        $matcher = $this->matchProgress('info', 50, false, true);

        $this->assertHTML($matcher, $progress);
    }

    public function testActiveStriped()
    {
        $progress = Progress::striped_active_info(50, $this->testAttributes);
        $matcher = $this->matchProgress('info', 50, true, true);

        $this->assertHTML($matcher, $progress);
    }

    public function testExceptionAttributes()
    {
        $this->setExpectedException('InvalidArgumentException');

        $progress = Progress::striped_normal(50, 'foo');
    }
}
