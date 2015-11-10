<?php

namespace ArtesanIO\MoocsyBundle\Utils;

use ArtesanIO\ArtesanusBundle\Model\UserManager;
use ArtesanIO\ArtesanusBundle\Utils\Cartero;
use ArtesanIO\ArtesanusBundle\Utils\Encoder;
use ArtesanIO\MoocsyBundle\Model\CoursesManager;
use ArtesanIO\MoocsyBundle\Model\CoursesUsersManager;
use Doctrine\ORM\EntityManager;

class APIxml
{
    private $token;
    private $userManager;
    private $cartero;
    private $twig;
    private $courses;
    private $coursesUsers;

    public function __construct(EntityManager $em, UserManager $userManager, Cartero $cartero, \Twig_Environment $twig, CoursesManager $courses, CoursesUsersManager $coursesUsers)
    {
        $this->token        = "5FZ2Z8QIkA7UTZ4BYkoC==";
        $this->userManager  = $userManager;
        $this->cartero      = $cartero;
        $this->twig         = $twig;
        $this->courses      = $courses;
        $this->coursesUsers = $coursesUsers;
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

            $this->cartero->msn($email, $msn);

        }

        $course = $this->courses->findOneBySKU($sku);

        if($course != null){

            $courseUser = $this->courses->findCourseUser($course, $user);

            if(null === $courseUser){

                $courseUsersManager = $this->coursesUsers;
                $coursesUsers = $courseUsersManager->create();

                $coursesUsers->setCourses($course);
                $coursesUsers->setUsers($user);

                $courseUsersManager->save($coursesUsers);

                $msn = $this->twig->render('MoocsyBundle:API:register-course.html.twig', array('course' => $course));

                $this->cartero->msn($email, $msn);
            }

        }

        return $user->getId();
    }
}

 ?>
