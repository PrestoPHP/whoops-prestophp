<?php

namespace WhoopsPrestoPHP;

use PrestoPHP\Application;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;

class PrestoPHPApplicationHandler extends Handler
{
	private $application;

	public function __construct(Application $application)
	{
		$this->application = $application;
	}

	/**
	 * @inherit
	 */
	public function handle()
	{
		$app = $this->application;
		$errorPageHandler = $app['whoops.error_page_handler'];
		if ($errorPageHandler instanceof PrettyPageHandler) {
			$errorPageHandler->addDataTable('PrestoPHP Application', array(
				'Version'           => $app::VERSION,
				'Charset'           => $app['charset'],
				'Route Class'       => $app['route_class'],
				'Dispatcher Class'  => get_class($app['dispatcher']),
				'Application Class' => get_class($app),
			));
		}
	}
}