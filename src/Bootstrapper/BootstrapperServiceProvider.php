<?php
namespace Bootstrapper;

use Illuminate\Support\ServiceProvider;
use LaravelBook\Laravel4Powerpack\Form as MeidoForm;

// Manually register Basset as we need it now
if (!class_exists('Basset\BassetServiceProvider')) {
  $basset = __DIR__.'/../../../../jasonlewis/basset/src/Basset/BassetServiceProvider.php';
  if (file_exists($basset)) include $basset;
}

class BootstrapperServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->package('patricktalmadge/bootstrapper');

    $this->app['config']->package('patricktalmadge/bootstrapper', __DIR__. '/../config');

    $this->app->singleton('form', function($app) {
      return new MeidoForm($app['url']);
    });
  }

  /**
   * Register assets
   *
   * @return void
   */
  public function boot()
  {
    if (!is_dir($this->app['path.public'].'/packages/patricktalmadge/')) return false;

    $this->app['config']->set('basset::collections.bootstrapper', function($collection) {
      $collection->requireDirectory('packages/patricktalmadge/bootstrapper/css');
      $collection->add('packages/patricktalmadge/bootstrapper/js/jquery-1.9.1.min.js');
      $collection->add('packages/patricktalmadge/bootstrapper/js/bootstrap.min.js');
    });
  }
}
