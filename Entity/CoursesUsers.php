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
}
