<?php

namespace ArtesanIO\MoocsyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotificationsController extends Controller
{
    public function notificationsAction(Request $request)
    {
        $notificationsManager = $this->get('moocsy.notifications_manager');
        $notificationsUnanswered = $notificationsManager->findNotificationsUnanswered();
        $notificationsAnswered = $notificationsManager->findNotificationsAnswered();

        return $this->render('MoocsyBundle:Notifications:notifications.html.twig', array(
            'notifications_unanswered' => $notificationsUnanswered,
            'notifications_answered' => $notificationsAnswered
        ));
    }

    public function answerAction($id, Request $request)
    {
        $notificationsManager = $this->get('moocsy.notifications_manager');

        $notification = $notificationsManager->find($id);

        $notifications = $notificationsManager->create();

        $notificationsForm = $this->createForm('moocsy_notifications_type', $notifications)->handleRequest($request);

        if($notificationsForm->isValid()){

            $notifications->setRequestResponse(2);
            $notification->setState(1);

            $notificationsManager->save($notifications);

            $requesResponseManager = $this->get('moocsy.request_response_manager');
            $requestResponse = $requesResponseManager->create();
            $requestResponse->setRequest($notification);
            $requestResponse->setResponse($notifications);

            $requesResponseManager->save($requestResponse);

            $this->get('artesanus.flashers')->add('info','Mensaje creado. Se ha notificado a '.$notification->getUsers()->getName());

            return $this->redirect($this->generateUrl('moocsy_admin_notifications_answer', array('id' => $notification->getId())));
        }

        return $this->render('MoocsyBundle:Notifications:answered.html.twig', array(
            'notification' => $notification,
            'notifications_form' => $notificationsForm->createView()
        ));
    }
}
