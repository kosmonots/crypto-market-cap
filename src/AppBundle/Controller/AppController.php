<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 04/09/2017
 * Time: 13:14
 */

namespace AppBundle\Controller;


use AppBundle\Controller\Api\Pagination\PaginationFactory;
use AppBundle\Entity\AudCrypto;
use AppBundle\Entity\BrlCrypto;
use AppBundle\Entity\CryptoCurrency;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Page;
use AppBundle\Entity\UsdCrypto;
use JMS\Serializer\SerializationContext;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppController extends Controller
{

	/**
	 * @param Request $request
	 * @return Response
	 *
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{

		$currency ='USD';
		$dql   = "SELECT cc FROM AppBundle:CryptoCurrency cc";

		$em    = $this->get('doctrine.orm.entity_manager');
		$entity = $em->createQuery($dql);

		$results = $this->get('knp_paginator')->paginate(
			$entity,
			$request->query->getInt('page', 1),
			$request->query->getInt('limit', 100),
			array('wrap-queries'=>true),
			['defaultSortFieldName' => 'cc.id', 'defaultSortDirection' => 'asc']
		);
		return $this->render('default/index.html.twig', compact('results', 'currency'));
	}

	/**
	 * @param $id
	 * @param $slug
	 * @return Response
	 *
	 * @Route("/crypto/{id}/{slug}", options={"expose"=true}, name="single_currency")
	 */
	public function singleAction($id, $slug)
	{
		$em = $this->getDoctrine()->getManager();
		$crypto = $em->getRepository(CryptoCurrency::class)->findOneBy(['id' => $id]);
		$currency = '';

		return $this->render('default/single.html.twig', compact('crypto', 'currency'));
	}

	/**
	 * @param $id
	 * @param $slug
	 * @return Response
	 *
	 * @Route("/p/{slug}", name="page")
	 */
	public function pageAction($slug)
	{
		$em = $this->getDoctrine()->getManager();
		$page = $em->getRepository(Page::class)->findOneBy(['slug' => $slug]);

		return $this->render('default/page.html.twig', compact('page'));
	}

	/**
	 * Show channel video
	 *
	 * @Route("/search/", name="search")
	 */
	public function searchAction(Request $request)
	{
		$currency ='USD';
		$search = $request->query->get('term');

		$em = $this->getDoctrine()->getManager();
		$items = $em->getRepository('AppBundle:CryptoCurrency')->getSearch($search);


		return $this->render('default/search.html.twig', compact('items', 'form', 'currency', 'search'));

	}

}