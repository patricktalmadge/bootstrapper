<?php
/**
 * Bootstrapper Service Provider
 */

namespace Bootstrapper;

use Bootstrapper\Bridges\Config\Laravel5Config;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider for Laravel
 *
 * @package Bootstrapper
 */
class BootstrapperL5ServiceProvider extends ServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/config.php' => config_path(
                    'bootstrapper.php'
                )
            ]
        );
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bootstrapper.php',
            'bootstrapper'
        );


        $this->registerAccordion();
        $this->registerAlert();
        $this->registerBadge();
        $this->registerBreadcrumb();
        $this->registerButtonGroup();
        $this->registerButton();
        $this->registerCarousel();
        $this->registerConfig();
        $this->registerControlGroup();
        $this->registerDropdownButton();
        $this->registerFormBuilder();
        $this->registerIcon();
        $this->registerImage();
        $this->registerInputGroup();
        $this->registerHelpers();
        $this->registerLabel();
        $this->registerMediaObject();
        $this->registerModal();
        $this->registerNavbar();
        $this->registerNavigation();
        $this->registerPanel();
        $this->registerProgressBar();
        $this->registerTabbable();
        $this->registerTable();
        $this->registerThumbnail();
    }

    /**
     * Registers the Accordion class in the IoC
     */
    private function registerAccordion()
    {
        $this->app->bind(
            'bootstrapper::accordion',
            function () {
                return new Accordion();
            }
        );
    }

    /**
     * Registers the Alert class in the IoC
     */
    private function registerAlert()
    {
        $this->app->bind(
            'bootstrapper::alert',
            function () {
                return new Alert();
            }
        );
    }

    /**
     * Registers the Badge class into the IoC
     */
    private function registerBadge()
    {
        $this->app->bind(
            'bootstrapper::badge',
            function () {
                return new Badge;
            }
        );
    }

    /**
     * Registers the Breadcrumb class into the IoC
     */
    private function registerBreadcrumb()
    {
        $this->app->bind(
            'bootstrapper::breadcrumb',
            function () {
                return new Breadcrumb;
            }
        );
    }

    /**
     * Registers the ButtonGroup class into the IoC
     */
    private function registerButtonGroup()
    {
        $this->app->bind(
            'bootstrapper::buttongroup',
            function () {
                return new ButtonGroup;
            }
        );
    }

    /**
     * Registers the Button class into the IoC
     */
    private function registerButton()
    {
        $this->app->bind(
            'bootstrapper::button',
            function () {
                return new Button;
            }
        );
    }

    /**
     * Registers the Carousel class into the IoC
     */
    private function registerCarousel()
    {
        $this->app->bind(
            'bootstrapper::carousel',
            function () {
                return new Carousel;
            }
        );
    }

    private function registerConfig()
    {
        $this->app->bind(
            'bootstrapper::config',
            function ($app) {
                return new Laravel5Config($app->make('config'));
            }
        );
    }

    /**
     * Registers the ControlGroup class into the IoC
     */
    private function registerControlGroup()
    {
        $this->app->bind(
            'bootstrapper::controlgroup',
            function ($app) {
                return new ControlGroup($app['bootstrapper::form']);
            }
        );
    }

    /**
     * Registers the DropdownButton class into the IoC
     */
    private function registerDropdownButton()
    {
        $this->app->bind(
            'bootstrapper::dropdownbutton',
            function () {
                return new DropdownButton;
            }
        );
    }

    /**
     * Registers the FormBuilder class into the IoC
     */
    private function registerFormBuilder()
    {
        $this->app->bind(
            'collective::html',
            function ($app) {
                return new HtmlBuilder($app->make('url'), $app->make('view'));
            }
        );
        $this->app->bind(
            'bootstrapper::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->token()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );
    }

    /**
     * Registers the Icon class into the IoC
     */
    private function registerIcon()
    {
        $this->app->bind(
            'bootstrapper::icon',
            function ($app) {
                return new Icon($app['bootstrapper::config']);
            }
        );
    }

    /**
     * Registers the Image class into the IoC
     */
    private function registerImage()
    {
        $this->app->bind(
            'bootstrapper::image',
            function () {
                return new Image;
            }
        );
    }

    /**
     * Registers the InputGroup class into the IoC
     */
    private function registerInputGroup()
    {
        $this->app->bind(
            'bootstrapper::inputgroup',
            function () {
                return new InputGroup;
            }
        );
    }

    /**
     * Registers the Label class into the IoC
     */
    private function registerLabel()
    {
        $this->app->bind(
            'bootstrapper::label',
            function () {
                return new Label;
            }
        );
    }

    /**
     * Registers the Helpers class into the IoC
     */
    private function registerHelpers()
    {
        $this->app->bind(
            'bootstrapper::helpers',
            function ($app) {
                return new Helpers($app['bootstrapper::config']);
            }
        );
    }

    /**
     * Registers the MediaObject class into the IoC
     */
    private function registerMediaObject()
    {
        $this->app->bind(
            'bootstrapper::mediaobject',
            function () {
                return new MediaObject;
            }
        );
    }

    /**
     * Registers the Modal class into the IoC
     */
    private function registerModal()
    {
        $this->app->bind(
            'bootstrapper::modal',
            function () {
                return new Modal;
            }
        );
    }

    /**
     * Registers the Navbar class into the IoC
     */
    private function registerNavbar()
    {
        $this->app->bind(
            'bootstrapper::navbar',
            function ($app) {
                return new Navbar($app->make('url'));
            }
        );
    }

    /**
     * Registers the Navigation class into the IoC
     */
    private function registerNavigation()
    {
        $this->app->bind(
            'bootstrapper::navigation',
            function ($app) {
                return new Navigation($app->make('url'));
            }
        );
    }

    /**
     * Registers the Panel class into the IoC
     */
    private function registerPanel()
    {
        $this->app->bind(
            'bootstrapper::panel',
            function () {
                return new Panel;
            }
        );
    }

    /**
     * Registers the ProgressBar class into the IoC
     */
    private function registerProgressBar()
    {
        $this->app->bind(
            'bootstrapper::progressbar',
            function () {
                return new ProgressBar;
            }
        );
    }

    /**
     * Registers the Tabbable class into the IoC
     */
    private function registerTabbable()
    {
        $this->app->bind(
            'bootstrapper::tabbable',
            function ($app) {
                return new Tabbable($app['bootstrapper::navigation']);
            }
        );
    }

    /**
     * Registers the Table class into the IoC
     */
    private function registerTable()
    {
        $this->app->bind(
            'bootstrapper::table',
            function () {
                return new Table;
            }
        );
    }

    /**
     * Registers the Thumbnail class into the IoC
     */
    private function registerThumbnail()
    {
        $this->app->bind(
            'bootstrapper::thumbnail',
            function () {
                return new Thumbnail;
            }
        );
    }
}
