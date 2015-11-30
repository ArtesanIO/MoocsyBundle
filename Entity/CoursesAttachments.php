<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CoursesAttachments
 *
 * @ORM\Table(name="moocsy_courses_attachment")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\CoursesAttachmentsRepository")
 */
class CoursesAttachments
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Courses", inversedBy="attachments")
    * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
    */

    private $courses;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment", type="string", length=255)
     */
    private $attachment;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Files")
    * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
    */

    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->created = new \Datetime('now');
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
     * Set attachment
     *
     * @param string $attachment
     * @return CoursesAttachments
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }

    /**
     * Get attachment
     *
     * @return string 
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return CoursesAttachments
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
     * Set courses
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Courses $courses
     * @return CoursesAttachments
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
     * Set file
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Files $file
     * @return CoursesAttachments
     */
    public function setFile(\ArtesanIO\ArtesanusBundle\Entity\Files $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\Files 
     */
    public function getFile()
    {
        return $this->file;
    }
}
