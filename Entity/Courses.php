<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Courses
 *
 * @ORM\Table(name="moocsy_courses")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\CoursesRepository")
 * @UniqueEntity("course")
 * @UniqueEntity("slug")
 */
class Courses
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
     * @var string
     *
     * @ORM\Column(name="course", type="string", length=255)
     */
    private $course;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="temporality", type="integer")
     */
    private $temporality;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var datetime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var datetime
     *
     * @ORM\Column(name="published", type="datetime")
     */
    private $published;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="courses")
    * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */

    private $creator;

    /**
     * @var datetime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="courses")
    * @ORM\JoinColumn(name="updater_id", referencedColumnName="id")
    */

    private $updater;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\Modules", mappedBy="courses", cascade={"persist", "remove"})
     */

    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\CoursesUsers", mappedBy="courses", cascade={"persist", "remove"})
     */

    private $coursesUsers;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=50)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="header", type="string", length=255)
     */
    private $header;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\CoursesAttachments", mappedBy="courses", cascade={"persist", "remove"})
     */

    private $attachments;


    public function __construct()
    {
        $this->created = new \Datetime('now');
        //$this->updated = new \Datetime('now');
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
     * Set course
     *
     * @param string $course
     * @return Courses
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Courses
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set temporality
     *
     * @param integer $temporality
     * @return Courses
     */
    public function setTemporality($temporality)
    {
        $this->temporality = $temporality;

        return $this;
    }

    /**
     * Get temporality
     *
     * @return integer
     */
    public function getTemporality()
    {
        return $this->temporality;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Courses
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Courses
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Courses
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set creator
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $creator
     * @return Courses
     */
    public function setCreator(\ArtesanIO\ArtesanusBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Courses
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updater
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $updater
     * @return Courses
     */
    public function setUpdater(\ArtesanIO\ArtesanusBundle\Entity\User $updater = null)
    {
        $this->updater = $updater;

        return $this;
    }

    /**
     * Get updater
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\User
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Add modules
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Modules $modules
     * @return Courses
     */
    public function addModule(\ArtesanIO\MoocsyBundle\Entity\Modules $modules)
    {
        $this->modules[] = $modules;

        return $this;
    }

    /**
     * Remove modules
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Modules $modules
     */
    public function removeModule(\ArtesanIO\MoocsyBundle\Entity\Modules $modules)
    {
        $this->modules->removeElement($modules);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     * @return Courses
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add coursesUsers
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\CoursesUsers $coursesUsers
     * @return Courses
     */
    public function addCoursesUser(\ArtesanIO\MoocsyBundle\Entity\CoursesUsers $coursesUsers)
    {
        $this->coursesUsers[] = $coursesUsers;

        return $this;
    }

    /**
     * Remove coursesUsers
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\CoursesUsers $coursesUsers
     */
    public function removeCoursesUser(\ArtesanIO\MoocsyBundle\Entity\CoursesUsers $coursesUsers)
    {
        $this->coursesUsers->removeElement($coursesUsers);
    }

    /**
     * Get coursesUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoursesUsers()
    {
        return $this->coursesUsers;
    }

    /**
     * Set sku
     *
     * @param string $sku
     * @return Courses
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set header
     *
     * @param string $header
     * @return Courses
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Courses
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add attachments
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\CoursesAttachments $attachments
     * @return Courses
     */
    public function addAttachment(\ArtesanIO\MoocsyBundle\Entity\CoursesAttachments $attachments)
    {
        $this->attachments[] = $attachments;

        return $this;
    }

    /**
     * Remove attachments
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\CoursesAttachments $attachments
     */
    public function removeAttachment(\ArtesanIO\MoocsyBundle\Entity\CoursesAttachments $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}
