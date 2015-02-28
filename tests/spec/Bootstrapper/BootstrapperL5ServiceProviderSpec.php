<?php

namespace spec\Bootstrapper {

    use Bootstrapper\BootstrapperServiceProvider;
    use PhpSpec\Exception\Example\SkippingException;
    use PhpSpec\Exception\Exception;
    use PhpSpec\ObjectBehavior;
    use Prophecy\Argument;

    class BootstrapperL5ServiceProviderSpec extends ObjectBehavior
    {
        /**
         * @var FakeApp
         */
        protected $app;

        function let()
        {
            $this->app = new FakeApp();
            $this->beConstructedWith($this->app);
        }

        function it_is_initializable()
        {
            $this->shouldHaveType('Bootstrapper\BootstrapperL5ServiceProvider');
        }

        function it_can_register_things()
        {
            if (!method_exists(
                new BootstrapperServiceProvider($this->app),
                'publishes'
            )
            ) {
                throw new SkippingException('This test can only be run in L5');
            }

            $this->register();

            $classes = [
                'bootstrapper::accordion' => 'Bootstrapper\\Accordion',
                'bootstrapper::alert' => 'Bootstrapper\\Alert',
                'bootstrapper::badge' => 'Bootstrapper\\Badge',
                'bootstrapper::breadcrumb' => 'Bootstrapper\\Breadcrumb',
                'bootstrapper::buttongroup' => 'Bootstrapper\\ButtonGroup',
                'bootstrapper::button' => 'Bootstrapper\\Button',
                'bootstrapper::carousel' => 'Bootstrapper\\Carousel',
                'bootstrapper::config' => 'Bootstrapper\\Bridges\\Config\\Laravel5Config',
                'bootstrapper::controlgroup' => 'Bootstrapper\\ControlGroup',
                'bootstrapper::dropdownbutton' => 'Bootstrapper\\DropdownButton',
                'bootstrapper::form' => 'Bootstrapper\\Form',
                'bootstrapper::icon' => 'Bootstrapper\\Icon',
                'bootstrapper::image' => 'Bootstrapper\\Image',
                'bootstrapper::inputgroup' => 'Bootstrapper\\InputGroup',
                'bootstrapper::label' => 'Bootstrapper\\Label',
                'bootstrapper::helpers' => 'Bootstrapper\\Helpers',
                'bootstrapper::mediaobject' => 'Bootstrapper\\MediaObject',
                'bootstrapper::modal' => 'Bootstrapper\\Modal',
                'bootstrapper::navbar' => 'Bootstrapper\\Navbar',
                'bootstrapper::navigation' => 'Bootstrapper\\Navigation',
                'bootstrapper::panel' => 'Bootstrapper\\Panel',
                'bootstrapper::progressbar' => 'Bootstrapper\\ProgressBar',
                'bootstrapper::tabbable' => 'Bootstrapper\\Tabbable',
                'bootstrapper::table' => 'Bootstrapper\\Table',
                'bootstrapper::thumbnail' => 'Bootstrapper\\Thumbnail',
            ];

            foreach($classes as $class => $className)
            {
                if (!$this->app->make($class) instanceof $className)
                {
                    throw new Exception("Expected an instance of $className when resolving $class. Instead recieved: " . get_class($this->app->make($class)));
                }
            }
        }

        function it_falls_over_on_laravel_4()
        {
            if (method_exists(
                new BootstrapperServiceProvider($this->app),
                'publishes'
            )) {
                throw new SkippingException('This test can only be run in L4');
            }

            $this->shouldThrow('Exception')->duringRegister();
        }
    }

    class FakeApp implements \ArrayAccess
    {
        protected $registered = [];
        protected $classes = [];

        public function bind($abstract, $concrete = null, $shared = false)
        {
            $this->registered[$abstract] = $concrete;
        }

        public function make($abstract, $parameters = array())
        {
            switch($abstract)
            {
                case 'config':
                    $mock = \Mockery::mock('Illuminate\\Contracts\\Config\\Repository');
                    $mock->shouldReceive('get')->andReturn([]);
                    $mock->shouldReceive('set');
                    return $mock;
                case 'html':
                    $mock = \Mockery::mock('Illuminate\\Html\\HtmlBuilder');
                    return $mock;
                case 'url':
                    $mock = \Mockery::mock('Illuminate\\Routing\\UrlGenerator');
                    return $mock;
                case 'session.store':
                    $mock = \Mockery::mock('Illuminate\\Session\\Store');
                    $mock->shouldReceive('getToken');
                    return $mock;
                case 'files':
                    $mock = \Mockery::mock('Files');
                    $mock->shouldReceive('isDirectory');
                    return $mock;
            }

            if (!isset($this->registered[$abstract]))
            {
                throw new \Exception("'$abstract' isn't defined yet");
            }

            if (!isset($this->classes[$abstract])) {
                $this->classes[$abstract] = $this->registered[$abstract]($this);
            }

            return $this->classes[$abstract];
        }

        public function offsetExists($offset)
        {
            return isset($this->registered[$offset]);
        }

        public function offsetGet($offset)
        {
            return $this->make($offset);
        }

        public function offsetSet($offset, $value)
        {
            return $this->bind($offset, $value);
        }

        public function offsetUnset($offset)
        {
            unset($this->registered[$offset]);
            unset($this->classes[$offset]);
        }
    }
}
namespace {
    function config_path()
    {
        return '';
    }
}