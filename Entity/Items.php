<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="moocsy_items")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\ItemsRepository")
 */
class Items
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Modules", inversedBy="items")
    * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
    */
    private $modules;

    /**
     * @var string
     *
     * @ORM\Column(name="items_type", type="string", length=255)
     */
    private $itemsType;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255)
     */
    private $item;

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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="items")
    * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
    */
    private $creator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="items")
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
     * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsAudio", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsAudio;

    /**
     * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsAudioDown;

    /**
     * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsFile", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsFile;

    /**
     * @ORM\OneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsForum", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsForum;

    /**
     * @ORM\OneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsQuiz", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsQuiz;

    /**
     * @ORM\oneToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\ItemsVideo", mappedBy="items", cascade={"persist", "remove"})
     */
    private $itemsVideo;

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
     * Set modules
     *
     * @param integer $modules
     * @return Items
     */
    public function setModules($modules)
    {
        $this->modules = $modules;

        return $this;
    }

    /**
     * Get modules
     *
     * @return integer
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Set itemsType
     *
     * @param integer $itemsType
     * @return Items
     */
    public function setItemsType($itemsType)
    {
        $this->itemsType = $itemsType;

        return $this;
    }

    /**
     * Get itemsType
     *
     * @return integer
     */
    public function getItemsType()
    {
        return $this->itemsType;
    }

    /**
     * Set item
     *
     * @param string $item
     * @return Items
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Items
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
     * Set created
     *
     * @param \DateTime $created
     * @return Items
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
     * @param integer $creator
     * @return Items
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return integer
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Items
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
     * @param integer $updater
     * @return Items
     */
    public function setUpdater($updater)
    {
        $this->updater = $updater;

        return $this;
    }

    /**
     * Get updater
     *
     * @return integer
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Items
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
     * Set multimedia
     *
     * @param string $multimedia
     * @return Items
     */
    public function setMultimedia($multimedia)
    {
        $this->multimedia = $multimedia;

        return $this;
    }

    /**
     * Get multimedia
     *
     * @return string
     */
    public function getMultimedia()
    {
        return $this->multimedia;
    }

    /**
     * Add itemsVideo
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo
     * @return Items
     */
    public function addItemsVideo(\ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo)
    {
        $this->itemsVideo[] = $itemsVideo;

        return $this;
    }

    /**
     * Remove itemsVideo
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo
     */
    public function removeItemsVideo(\ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo)
    {
        $this->itemsVideo->removeElement($itemsVideo);
    }

    /**
     * Get itemsVideo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsVideo()
    {
        return $this->itemsVideo;
    }

    /**
     * Add itemsAudio
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio
     * @return Items
     */
    public function addItemsAudio(\ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio)
    {
        $this->itemsAudio[] = $itemsAudio;

        return $this;
    }

    /**
     * Remove itemsAudio
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio
     */
    public function removeItemsAudio(\ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio)
    {
        $this->itemsAudio->removeElement($itemsAudio);
    }

    /**
     * Get itemsAudio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsAudio()
    {
        return $this->itemsAudio;
    }

    /**
     * Add itemsAudioDown
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown
     * @return Items
     */
    public function addItemsAudioDown(\ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown)
    {
        $this->itemsAudioDown[] = $itemsAudioDown;

        return $this;
    }

    /**
     * Remove itemsAudioDown
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown
     */
    public function removeItemsAudioDown(\ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown)
    {
        $this->itemsAudioDown->removeElement($itemsAudioDown);
    }

    /**
     * Get itemsAudioDown
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsAudioDown()
    {
        return $this->itemsAudioDown;
    }

    /**
     * Add itemsFile
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile
     * @return Items
     */
    public function addItemsFile(\ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile)
    {
        $this->itemsFile[] = $itemsFile;

        return $this;
    }

    /**
     * Remove itemsFile
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile
     */
    public function removeItemsFile(\ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile)
    {
        $this->itemsFile->removeElement($itemsFile);
    }

    /**
     * Get itemsFile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsFile()
    {
        return $this->itemsFile;
    }

    /**
     * Add itemsForum
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum
     * @return Items
     */
    public function addItemsForum(\ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum)
    {
        $this->itemsForum[] = $itemsForum;

        return $this;
    }

    /**
     * Remove itemsForum
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum
     */
    public function removeItemsForum(\ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum)
    {
        $this->itemsForum->removeElement($itemsForum);
    }

    /**
     * Get itemsForum
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsForum()
    {
        return $this->itemsForum;
    }

    /**
     * Add itemsQuiz
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz
     * @return Items
     */
    public function addItemsQuiz(\ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz)
    {
        $this->itemsQuiz[] = $itemsQuiz;

        return $this;
    }

    /**
     * Remove itemsQuiz
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz
     */
    public function removeItemsQuiz(\ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz)
    {
        $this->itemsQuiz->removeElement($itemsQuiz);
    }

    /**
     * Get itemsQuiz
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemsQuiz()
    {
        return $this->itemsQuiz;
    }

    public function aliasRouteType()
    {
        return 'moocsy_front_'.$this->itemsType;
    }

    /**
     * Set itemsAudio
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio
     * @return Items
     */
    public function setItemsAudio(\ArtesanIO\MoocsyBundle\Entity\ItemsAudio $itemsAudio = null)
    {
        $this->itemsAudio = $itemsAudio;

        return $this;
    }

    /**
     * Set itemsAudioDown
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown
     * @return Items
     */
    public function setItemsAudioDown(\ArtesanIO\MoocsyBundle\Entity\ItemsAudioDownload $itemsAudioDown = null)
    {
        $this->itemsAudioDown = $itemsAudioDown;

        return $this;
    }

    /**
     * Set itemsFile
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile
     * @return Items
     */
    public function setItemsFile(\ArtesanIO\MoocsyBundle\Entity\ItemsFile $itemsFile = null)
    {
        $this->itemsFile = $itemsFile;

        return $this;
    }

    /**
     * Set itemsVideo
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo
     * @return Items
     */
    public function setItemsVideo(\ArtesanIO\MoocsyBundle\Entity\ItemsVideo $itemsVideo = null)
    {
        $this->itemsVideo = $itemsVideo;

        return $this;
    }

    /**
     * Set itemsForum
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum
     * @return Items
     */
    public function setItemsForum(\ArtesanIO\MoocsyBundle\Entity\ItemsForum $itemsForum = null)
    {
        $this->itemsForum = $itemsForum;

        return $this;
    }

    /**
     * Set itemsQuiz
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz
     * @return Items
     */
    public function setItemsQuiz(\ArtesanIO\MoocsyBundle\Entity\ItemsQuiz $itemsQuiz = null)
    {
        $this->itemsQuiz = $itemsQuiz;

        return $this;
    }
}
