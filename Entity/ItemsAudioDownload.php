<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemsAudioDownload
 *
 * @ORM\Table(name="moocsy_items_audio_download")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownloadRepository")
 */
class ItemsAudioDownload
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
    * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Items", inversedBy="itemsAudioDown")
    * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
    */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="audio", type="string", length=255)
     */
    private $audio;


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
     * @return ItemsAudioDownload
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
     * Set audio
     *
     * @param string $audio
     * @return ItemsAudioDownload
     */
    public function setAudio($audio)
    {
        $this->audio = $audio;

        return $this;
    }

    /**
     * Get audio
     *
     * @return string
     */
    public function getAudio()
    {
        return $this->audio;
    }
}
