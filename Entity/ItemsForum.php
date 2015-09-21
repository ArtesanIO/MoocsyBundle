<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsForum
 *
 * @ORM\Table(name="moocsy_items_forum")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsForumRepository")
 */
class ItemsForum
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
    * @ORM\OneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", inversedBy="itemsForum")
    * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
    */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="forum", type="string", length=255)
     */
    private $forum;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsComments", mappedBy="itemsForum", cascade={"persist", "remove"})
     */

    private $itemsComments;


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
     * @return ItemsForum
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
     * Set forum
     *
     * @param string $forum
     * @return ItemsForum
     */
    public function setForum($forum)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return string
     */
    public function getForum()
    {
        return $this->forum;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemsComments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add itemsComments
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsComments $itemsComments
     * @return ItemsForum
     */
    public function addItemsComment(\ArtesanIO\MoocsyBundle\Entity\ItemsComments $itemsComments)
    {
        $this->itemsComments[] = $itemsComments;

        return $this;
    }

    /**
     * Remove itemsComments
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsComments $itemsComments
     */
    public function removeItemsComment(\ArtesanIO\MoocsyBundle\Entity\ItemsComments $itemsComments)
    {
        $this->itemsComments->removeElement($itemsComments);
    }

    /**
     * Get itemsComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsComments()
    {
        return $this->itemsComments;
    }
}
