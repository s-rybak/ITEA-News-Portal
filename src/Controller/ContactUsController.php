<?php

namespace App\Controller;

use App\Service\ContactUsServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Contact us page controller
 * @package App\Controller
 *
 * @author Regey R <qwe@qwe.com>
 */

class ContactUsController extends AbstractController {

	private $service;

	public function __construct(ContactUsServiceInterface $service)
	{
		$this->service = $service;
	}

	/**
	 * Contact us page.
	 *
	 * @return Response
	 */
	public function index(): Response
	{

		$form = $this->createFormBuilder()
		             ->add('name', TextType::class,array('label' => 'Name'))
		             ->add('email', EmailType::class,array('label' => 'Email'))
		             ->add('message', TextareaType::class,array('label' => 'Message'))
		             ->add('send', SubmitType::class, array('label' => 'Send message'))
		             ->getForm();

		return $this->render('contact_us/index.html.twig', [
			'page' => $this->service->getData(),
			'form' => $form->createView()
		]);
	}


}