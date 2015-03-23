<?php namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Dropbox\DropboxAdapter;
use League\Flysystem\Filesystem;
use Dropbox\Client;

class DropboxFilesystemServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        Storage::extend('dropbox', function($app, $config)
        {
            $client = new Client($config["accessToken"], $config["ClientIdentifier"]);
            $adapter = new DropboxAdapter($client);
            $filesystem = new Filesystem($adapter);
            return $filesystem;
        });
	}

}
