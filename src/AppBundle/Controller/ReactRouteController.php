<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Channel controller.
 * @Route("currency")
 */

class ReactRouteController extends Controller
{
    /**
     * Lists all channel entities.
     *
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     */
    public function indexAction()
    {
		return $this->render('default/index.html.twig', compact('aud_result'));
    }

	/**
	 * Lists all channel entities.
	 *
	 * @Route("/{currency}", name="route_currency")
	 * @Method("GET")
	 */
	public function index2Action()
	{

		return $this->render('default/index.html.twig', compact('aud_result'));
	}
}
