<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsVideo
 *
 * @ORM\Table(name="moocsy_items_video")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsVideoRepository")
 */
class ItemsVideo
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
    * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", inversedBy="itemsVideo")
    * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
    */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255)
     */
    private $video;


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
     * @param integer $items
     * @return ItemsVideo
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return integer
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return ItemsVideo
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }
}
