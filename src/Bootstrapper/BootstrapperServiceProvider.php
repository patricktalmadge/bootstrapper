<?php
namespace Bootstrapper;

use Illuminate\Support\ServiceProvider;

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

  }
}
