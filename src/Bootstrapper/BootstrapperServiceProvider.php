<?php
namespace Bootstrapper;

use Illuminate\Support\ServiceProvider;

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
  }

  /**
   * Register assets
   *
   * @return void
   */
  public function boot()
  {
    $this->app['config']->set('basset::collections.bootstrapper', function($collection) {
      $collection->add('packages/patricktalmadge/bootstrapper/css/bootstrap.min.css');
      $collection->add('packages/patricktalmadge/bootstrapper/css/bootstrap-responsive.min.css');

      $collection->add('packages/patricktalmadge/bootstrapper/js/jquery-1.8.3.min.js');
      $collection->add('packages/patricktalmadge/bootstrapper/js/bootstrap.min.js');
    });
  }
}
