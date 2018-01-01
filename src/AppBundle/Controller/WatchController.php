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
use AppBundle\Entity\UsdCrypto;
use AppBundle\Entity\User;
use JMS\Serializer\SerializationContext;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Channel controller.
 * @Route("watch")
 */

class WatchController extends Controller
{
    /**
	 * @Security("is_granted('ROLE_USER')")
     * @return Response
     * @param UserInterface|User $user
     * @Route("/{id}/{slug}/{currency}", name="watch")
     */
	public function indexAction(Request $request,UserInterface $user,  $id, $slug, $currency)
	{

		$em = $this->getDoctrine()->getManager();
		$crypto = $em->getRepository(CryptoCurrency::class)->findOneBy(['id'=> $id, 'slug'=> $slug]);
		$crypto->addUser($user);
		$em->persist($crypto);
		$em->flush();

		return new Response('kjhk');

		//return $this->render('default/index.html.twig', compact('results', 'currency'));
	}


}