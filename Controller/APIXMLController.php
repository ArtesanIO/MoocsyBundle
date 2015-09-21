<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class APIXMLController extends Controller
{
    public function serverAction(Request $request)
    {
        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        $server = new \SoapServer($baseurl.'/APIxml.wsdl');
        $server->setObject($this->get('moocsy.api_xml'));

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

    public function clientAction(Request $request)
    {

        $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        // if($this->container->get('kernel')->getEnvironment() == 'dev'){
        //     $baseurl = $baseurl.'/app_dev.php';
        // }



        $client = new \SoapClient('http://mooc.sy/apis/xml?wsdl');

        $token = "5FZ2Z8QIkA7UTZ4BYkoC==";
        $username = "@SoyDonCristian";
        $email = "cristianangulonova@hotmail.com";
        $sku  = "EABR-K14";

        //$register = $client->registrar($token, $username, $email, $sku);

        //echo $register;

        $api = $this->get('moocsy.api_xml');

        $usuario = $api->registrar($token, $username, $email, $sku);

        echo $usuario;

        return new Response($usuario);
    }
}
