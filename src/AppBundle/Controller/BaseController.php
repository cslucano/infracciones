<?php

namespace AppBundle\Controller;

use JMS\Serializer\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    function serialize($object, $format = 'json')
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('jms_serializer');
        return $serializer->serialize($object, $format);
    }
}