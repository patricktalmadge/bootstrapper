<?php
/**
 * Bootstrapper Service Provider
 */

namespace Bootstrapper;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for Laravel
 *
 * @package Bootstrapper
 */
class BootstrapperServiceProvider extends ServiceProvider
{

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerAccordion();
        $this->registerAlert();
        $this->registerBadge();
        $this->registerBreadcrumb();
        $this->registerButtonGroup();
        $this->registerButton();
        $this->registerCarousel();
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

        $this->package('patricktalmadge/bootstrapper');
        $this->app['config']->package(
            'patricktalmadge/bootstrapper',
            __DIR__ . '/../config'
        );
    }

    /**
     * Registers the Accordion class in the IoC
     */
    private function registerAccordion()
    {
        $this->app->bind(
            'accordion',
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
            'alert',
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
            'badge',
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
            'breadcrumb',
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
            'buttongroup',
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
            'button',
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
            'carousel',
            function () {
                return new Carousel;
            }
        );
    }

    /**
     * Registers the ControlGroup class into the IoC
     */
    private function registerControlGroup()
    {
        $this->app->bind(
            'controlgroup',
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
            'dropdownbutton',
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
        $this->app->bindShared(
            'bootstrapper::form',
            function ($app) {
                $form = new Form(
                    $app['html'],
                    $app['url'],
                    $app['session.store']->getToken()
                );

                return $form->setSessionStore($app['session.store']);
            }
        );
    }

    /**
     * Registers the Icon class into the IoC
     */
    private function registerIcon()
    {
        $this->app->bind(
            'icon',
            function ($app) {
                return new Icon($app['config']);
            }
        );
    }

    /**
     * Registers the Image class into the IoC
     */
    private function registerImage()
    {
        $this->app->bind(
            'image',
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
            'inputgroup',
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
            'label',
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
                return new Helpers($app['config']);
            }
        );
    }

    /**
     * Registers the MediaObject class into the IoC
     */
    private function registerMediaObject()
    {
        $this->app->bind(
            'mediaobject',
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
            'modal',
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
            'navbar',
            function ($app) {
                return new Navbar($app['url']);
            }
        );
    }

    /**
     * Registers the Navigation class into the IoC
     */
    private function registerNavigation()
    {
        $this->app->bind(
            'navigation',
            function ($app) {
                return new Navigation($app['url']);
            }
        );
    }

    /**
     * Registers the Panel class into the IoC
     */
    private function registerPanel()
    {
        $this->app->bind(
            'panel',
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
            'progressbar',
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
            'tabbable',
            function ($app) {
                return new Tabbable($app['navigation']);
            }
        );
    }

    /**
     * Registers the Table class into the IoC
     */
    private function registerTable()
    {
        $this->app->bind(
            'table',
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
            'thumbnail',
            function () {
                return new Thumbnail;
            }
        );
    }
}
