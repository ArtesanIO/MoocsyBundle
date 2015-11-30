<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ItemsFile
 *
 * @ORM\Table(name="moocsy_items_file")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsFileRepository")
 */
class ItemsFile
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
    * @ORM\OneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", inversedBy="itemsFile")
    * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
    */
    private $items;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\Files")
    * @ORM\JoinColumn(name="file_id", referencedColumnName="id")
    */

    private $files;

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
     * Set items
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Items $items
     * @return ItemsFile
     */
    public function setItems(\ArtesanIO\MoocsyBundle\Entity\Items $items = null)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return \ArtesanIO\MoocsyBundle\Entity\Items 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set files
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\Files $files
     * @return ItemsFile
     */
    public function setFiles(\ArtesanIO\ArtesanusBundle\Entity\Files $files = null)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get files
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\Files 
     */
    public function getFiles()
    {
        return $this->files;
    }
}
