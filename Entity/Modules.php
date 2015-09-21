<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Modules
 *
 * @ORM\Table(name="moocsy_modules")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ModulesRepository")
 * @UniqueEntity("module")
 * @UniqueEntity("slug")
 */
class Modules
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Courses", inversedBy="modules")
    * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
    */
    private $courses;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=255)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", mappedBy="modules", cascade={"persist", "remove"})
     */

    private $items;

    public function __construct()
    {
        $this->created = new \Datetime('now');
        $this->updated = new \Datetime('now');
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
     * Set module
     *
     * @param string $module
     * @return Modules
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Modules
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
     * Set position
     *
     * @param integer $position
     * @return Modules
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Modules
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Modules
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
     * Set courses
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Courses $courses
     * @return Modules
     */
    public function setCourses(\ArtesanIO\MoocsyBundle\Entity\Courses $courses = null)
    {
        $this->courses = $courses;

        return $this;
    }

    /**
     * Get courses
     *
     * @return \ArtesanIO\MoocsyBundle\Entity\Courses
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Set creator
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $creator
     * @return Modules
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
     * Set updater
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $updater
     * @return Modules
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
     * Set slug
     *
     * @param string $slug
     * @return Modules
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
     * Add items
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Items $items
     * @return Modules
     */
    public function addItem(\ArtesanIO\MoocsyBundle\Entity\Items $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Items $items
     */
    public function removeItem(\ArtesanIO\MoocsyBundle\Entity\Items $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}
