<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\AudCrypto;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Import;
use AppBundle\Services\CryptoImport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Channel controller.
 * @Route("admin")
 */

class ImportController extends Controller
{
	/**
	 *
	 * @Route("/import/currency", name="import_currency")
	 * @param Request $request
	 * @param CryptoImport $cryptoImport
	 * @return Response
	 */
    public function importCurrencyAction(Request $request, CryptoImport $cryptoImport)
    {
		$id = $request->query->get('id');

		$em = $this->getDoctrine()->getManager();
		$currency = $em->getRepository(Currency::class)->findOneBy(['id' => $id]);

		$cryptoImport->importCryptoCurrencies($currency->getName());


		return $this->redirectToRoute('easyadmin', [
			'action' => 'list',
			'entity' => $request->query->get('entity'),
			'id' => $id
		]);
    }
}
