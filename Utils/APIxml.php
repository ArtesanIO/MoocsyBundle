<?php

namespace ArtesanIO\MoocsyBundle\Utils;

use ArtesanIO\ArtesanusBundle\Model\UserManager;
use ArtesanIO\ArtesanusBundle\Utils\Cartero;
use ArtesanIO\ArtesanusBundle\Utils\Encoder;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\ACL\Usuarios;
use AppBundle\Entity\Admin\Cursos\CursoUsuarios;

class APIxml
{
    private $token;
    private $userManager;
    private $cartero;
    private $twig;

    public function __construct(EntityManager $em, UserManager $userManager, Cartero $cartero, \Twig_Environment $twig)
    {
        $this->token       = "5FZ2Z8QIkA7UTZ4BYkoC==";
        $this->userManager = $userManager;
        $this->cartero     = $cartero;
        $this->twig        = $twig;
    }

    public function login($token)
    {
        if($this->token == $token){
            return true;
        }

        return false;
    }

    public function registrar($token, $username = null, $email, $sku = null)
    {
        if($this->login($token) == false){
            return 'Incorrect token';
        }

        $user = $this->userManager->findOneByEmail($email);

        if($user == null){
            $user = $this->userManager->create();

            $rand = md5(rand(0,99999));

            if($username == null){
                $username = $email;
            }

            $user->setPassword($rand);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setName($email);
            $user->setEnabled(1);
            $user->setRoles(array('ROLE_REGISTERED'));

            $this->userManager->save($user);

            $msn = $this->twig->render('MoocsyBundle:API:register.html.twig', array('user' => $user, 'password' => $rand));

            $this->cartero->msn('cristianangulonova@gmail.com', $msn);

        }

        $msn = $this->twig->render('MoocsyBundle:API:register-course.html.twig');

        $this->cartero->msn('cristianangulonova@gmail.com', $msn);

        echo $user->getId();
        return 'Siga usted';
    }
}

 ?>
