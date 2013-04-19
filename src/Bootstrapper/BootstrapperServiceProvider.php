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

    Helpers::setContainer($this->app);
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
      $collection->requireDirectory('packages/patricktalmadge/bootstrapper/js');
    });
  }
}
