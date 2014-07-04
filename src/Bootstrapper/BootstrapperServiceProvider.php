<?php

namespace Bootstrapper;

use Illuminate\Support\ServiceProvider;

class BootstrapperServiceProvider extends ServiceProvider
{
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

    private function registerAccordion()
    {
        $this->app->bind('accordion', function() {
            return new Accordion();
        });
    }

    private function registerAlert()
    {
        $this->app->bind('alert', function() {
            return new Alert();
        });
    }

    public function registerBadge()
    {
        $this->app->bind('badge', function () {
            return new Badge;
        });
    }

    public function registerBreadcrumb()
    {
        $this->app->bind('breadcrumb', function () {
            return new Breadcrumb;
        });
    }

    public function registerButtonGroup()
    {
        $this->app->bind('buttonGroup', function () {
            return new ButtonGroup;
        });
    }

    public function registerButton()
    {
        $this->app->bind('button', function () {
            return new Button;
        });
    }

    public function registerCarousel()
    {
        $this->app->bind('carousel', function () {
            return new Carousel;
        });
    }

    public function registerControlGroup()
    {
        $this->app->bind('controlGroup', function () {
            return new ControlGroup;
        });
    }

    public function registerDropdownButton()
    {
        $this->app->bind('dropdownButton', function () {
            return new DropdownButton;
        });
    }

    public function registerFormBuilder()
    {
        $this->app->bindShared('form', function ($app) {
            $form = new Form($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

    public function registerIcon()
    {
        $this->app->bind('icon', function ($app) {
            return new Icon($app->make('config'));
        });
    }

    public function registerImage()
    {
        $this->app->bind('image', function () {
            return new Image;
        });
    }

    public function registerInputGroup()
    {
        $this->app->bind('inputGroup', function () {
            return new InputGroup;
        });
    }

    public function registerLabel()
    {
        $this->app->bind('label', function () {
            return new Label;
        });
    }

    public function registerMediaObject()
    {
        $this->app->bind('mediaObject', function () {
            return new MediaObject;
        });
    }

    public function registerModal()
    {
        $this->app->bind('modal', function () {
            return new Modal;
        });
    }

    public function registerNavbar()
    {
        $this->app->bind('navbar', function ($app) {
            return new Navbar($app['url']);
        });
    }

    public function registerNavigation()
    {
        $this->app->bind('navigation', function ($app) {
            return new Navigation($app['url']);
        });
    }

    public function registerPanel()
    {
        $this->app->bind('panel', function () {
            return new Panel;
        });
    }

    public function registerProgressBar()
    {
        $this->app->bind('progressBar', function () {
            return new ProgressBar;
        });
    }

    public function registerTabbable()
    {
        $this->app->bind('tabbable', function ($app) {
            return new Tabbable($app['navigation']);
        });
    }

    public function registerTable()
    {
        $this->app->bind('table', function () {
            return new Table;
        });
    }

    public function registerThumbnail()
    {
        $this->app->bind('thumbnail', function () {
            return new Thumbnail;
        });
    }
}