<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Infraccion;
use AppBundle\Entity\InfraccionRepository;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class InfraccionController extends FOSRestController
{
    public function getInfraccionAction(Request $request)
    {
        $desde = $request->query->get('desde', 16);
        $hasta = $request->query->get('hasta', 16.5);

        /** @var InfraccionRepository $repo */
        $repo = $this->getDoctrine()->getRepository(Infraccion::class);
        $data = $repo->getByWindow($desde, $hasta);

        $view = $this->view($data, 200)
            ->setTemplate("AppBundle:Infraccion:getInfraccion.html.twig")
            ->setTemplateVar('infracciones')
        ;

        return $this->handleView($view);
    }
}