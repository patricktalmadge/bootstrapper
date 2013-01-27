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
  }
}
