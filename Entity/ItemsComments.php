<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsComments
 *
 * @ORM\Table(name="moocsy_forum_comments")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsCommentsRepository")
 */
class ItemsComments
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="ItemsComments")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */

    private $usuarios;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsForum", inversedBy="itemsComments")
    * @ORM\JoinColumn(name="item_forum_id", referencedColumnName="id")
    */
    private $itemsForum;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

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
     * Set comment
     *
     * @param string $comment
     * @return ItemsComments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set usuarios
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $usuarios
     * @return ItemsComments
     */
    public function setUsuarios(\ArtesanIO\ArtesanusBundle\Entity\User $usuarios = null)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\User
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set itemsForum
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum
     * @return ItemsComments
     */
    public function setItemsForum(\ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum = null)
    {
        $this->itemsForum = $itemsForum;

        return $this;
    }

    /**
     * Get itemsForum
     *
     * @return \ArtesanIO\MoocsyBundle\Entity\ItemsForum
     */
    public function getItemsForum()
    {
        return $this->itemsForum;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ItemsComments
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
}
