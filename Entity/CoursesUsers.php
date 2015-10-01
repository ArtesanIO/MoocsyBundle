<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoursesUsers
 *
 * @ORM\Table(name="moocsy_courses_users")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\CoursesUsersRepository")
 */
class CoursesUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Courses", inversedBy="coursesUsers")
    * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
    */
    private $courses;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="coursesUsers")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $users;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered", type="datetime")
     */
    private $registered;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="certificate_freedom", type="datetime", nullable=true)
     */
    private $certificateFreedom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="certified", type="datetime", nullable=true)
     */
    private $certified;

    /**
     * @var \string
     *
     * @ORM\Column(name="username_certificate", type="string", nullable=true)
     */
    private $usernameCertificate;

    public function __construct()
    {
        $this->registered = new \Datetime('now');
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set courses
     *
     * @param integer $courses
     * @return CoursesUsers
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;

        return $this;
    }

    /**
     * Get courses
     *
     * @return integer
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set users
     *
     * @param integer $users
     * @return CoursesUsers
     */
    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return integer
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set registered
     *
     * @param \DateTime $registered
     * @return CoursesUsers
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get registered
     *
     * @return \DateTime
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set certificateFreedom
     *
     * @param \DateTime $certificateFreedom
     * @return CoursesUsers
     */
    public function setCertificateFreedom($certificateFreedom)
    {
        $this->certificateFreedom = $certificateFreedom;

        return $this;
    }

    /**
     * Get certificateFreedom
     *
     * @return \DateTime
     */
    public function getCertificateFreedom()
    {
        return $this->certificateFreedom;
    }

    /**
     * Set certified
     *
     * @param \DateTime $certified
     * @return CoursesUsers
     */
    public function setCertified($certified)
    {
        $this->certified = $certified;

        return $this;
    }

    /**
     * Get certified
     *
     * @return \DateTime
     */
    public function getCertified()
    {
        return $this->certified;
    }

    /**
     * Set usernameCertificate
     *
     * @param string $usernameCertificate
     * @return CoursesUsers
     */
    public function setUsernameCertificate($usernameCertificate)
    {
        $this->usernameCertificate = $usernameCertificate;

        return $this;
    }

    /**
     * Get usernameCertificate
     *
     * @return string
     */
    public function getUsernameCertificate()
    {
        return $this->usernameCertificate;
    }
}
