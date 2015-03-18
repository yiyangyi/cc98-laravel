<?php namespace App\Providers;

use App\Services\Markdown;
use Illuminate\Support\ServiceProvider;

class MarkdownSeriveProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('Services\Markdown', function ($app)
        {
            return new Markdown;
        });
	}

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Services\Markdown'];
    }
}
