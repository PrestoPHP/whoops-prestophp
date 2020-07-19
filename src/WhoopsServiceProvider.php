<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace WhoopsPrestoPHP;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use PrestoPHP\Application;
use PrestoPHP\Api\EventListenerProviderInterface;
use PrestoPHP\ExceptionListenerWrapper;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use WhoopsPimple\WhoopsServiceProvider as PimpleWhoopsServiceProvider;
use WhoopsPrestoPHP\PrestoPHPApplicationHandler;
use WhoopsPrestoPHP\RequestHandler;

class WhoopsServiceProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
	public function register(Container $container)
	{
		$container->register(new PimpleWhoopsServiceProvider);
		$container['whoops']->pushHandler(new RequestHandler($container));
		if ($container instanceof Application) {
			$container['whoops']->pushHandler(new PrestoPHPApplicationHandler($container));
		}
	}

	public function subscribe(Container $container, EventDispatcherInterface $dispatcher)
	{
		if ($container instanceof Application) {
			$dispatcher->addListener(
				KernelEvents::EXCEPTION,
				new ExceptionListenerWrapper($container, $container['whoops.exception_handler']),
				-1
			);
		}
	}
}
