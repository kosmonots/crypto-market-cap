<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 04/11/2017
 * Time: 15:06
 */

namespace AppBundle\Serializer;


use AppBundle\Annotation\Link;
//use AppBundle\Entity\UsdCrypto;
use AppBundle\Entity\UsdCrypto;
use Doctrine\Common\Annotations\Reader;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\JsonSerializationVisitor;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Routing\RouterInterface;

class LinkSerializationSubscriber implements EventSubscriberInterface
{
	private $router;
	/**
	 * @var Reader
	 */
	private $annotationsReader;

	private $expressionLanguage;

	public function __construct(RouterInterface $router, Reader $annotationsReader) {

		$this->router = $router;
		$this->annotationsReader = $annotationsReader;

		$this->expressionLanguage = new ExpressionLanguage();
	}

	public function onPostSerialize(ObjectEvent $event)
	{
		/**
		 * @var JsonSerializationVisitor $visitor
		 */
		$visitor = $event->getVisitor();

		/**
		 * @var UsdCrypto $object
		 */
		$object = $event->getObject();

		$visitor->setData('uri', $this->router->generate(
			'crypto_currency_api_show',
			['name' => $object->getName()]
		));

		/*$object = $event->getObject();
		$annotations = $this->annotationsReader->getClassAnnotations(new \ReflectionObject($object));

		$links = [];

		foreach($annotations as $annotation){
			if($annotation instanceof Link){
				$uri = $this->router->generate(
					$annotation->route,
					$this->resolveParams($annotation->params, $object)
				);

				$links[$annotation->name] = $uri;
			}
		}*/
		//if ($links) {
		//	$visitor->setData('links', $links);
		//}


	}

	public static function getSubscribedEvents()
	{
		return [
			[
				'event'  => 'serializer.post_serialize',
				'method' => 'onPostSerialize',
				'format' => 'json',
				'class'  => UsdCrypto::class
			]
		];
	}


	private function resolveParams(array $params, $object)
	{
		foreach ($params as $key => $param) {
			$params[$key] = $this->expressionLanguage
				->evaluate($param, array('object' => $object));
		}

		return $params;

	}






}