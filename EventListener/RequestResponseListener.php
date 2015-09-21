<?php

namespace ArtesanIO\MoocsyBundle\EventListener;

use ArtesanIO\MoocsyBundle\Event\RequestResponseEvent;
use ArtesanIO\MoocsyBundle\Event\MoocsyEvents;
use ArtesanIO\ArtesanusBundle\Utils\Cartero;

class RequestResponseListener
{
    protected $cartero;
    protected $twig;

    public function __construct(Cartero $cartero, \Twig_Environment $twig)
    {
        $this->cartero = $cartero;
        $this->twig = $twig;
    }
    public function onRequestResponse(RequestResponseEvent $event)
    {
        $requesResponse = $event->getRequestResponse();

        $request = $requesResponse->getRequest();
        $response = $requesResponse->getResponse();

        $msn = $this->twig->render('MoocsyBundle:Notifications:mail-answer.html.twig', array(
            'request'  => $request,
            'response' => $response
        ));

        $this->cartero->msn('cristianangulonova@gmail.com', $msn,'Desde el Listener');

    }

    public static function getSubscribedEvents()
    {
        return array(
            MoocsyEvents::MOOCSY_REQUEST_RESPONSE => 'onRequestResponse',
        );
    }
}

?>
