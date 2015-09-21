<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notifications
 *
 * @ORM\Table(name="moocsy_notifications")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\NotificationsRepository")
 */
class Notifications
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\ArtesanusBundle\Entity\User", inversedBy="notificationsRequest")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $users;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var boolean
     *
     * @ORM\Column(name="state", type="boolean")
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="requestResponse", type="integer")
     */
    private $requestResponse;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\RequestResponse", mappedBy="request")
     */

    private $requestRequest;

    /**
     * @ORM\OneToMany(targetEntity="ArtesanIO\MoocsyBundle\Entity\RequestResponse", mappedBy="responseResponse")
     */

    private $responseResponse;

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
     * Set users
     *
     * @param integer $users
     * @return Notifications
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
     * Set userResponse
     *
     * @param integer $userResponse
     * @return Notifications
     */
    public function setUserResponse($userResponse)
    {
        $this->userResponse = $userResponse;

        return $this;
    }

    /**
     * Get userResponse
     *
     * @return integer
     */
    public function getUserResponse()
    {
        return $this->userResponse;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Notifications
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Notifications
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
     * Set responded
     *
     * @param \DateTime $responded
     * @return Notifications
     */
    public function setResponded($responded)
    {
        $this->responded = $responded;

        return $this;
    }

    /**
     * Get responded
     *
     * @return \DateTime
     */
    public function getResponded()
    {
        return $this->responded;
    }

    /**
     * Set state
     *
     * @param boolean $state
     * @return Notifications
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return boolean
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set userRequest
     *
     * @param \ArtesanIO\ArtesanusBundle\Entity\User $userRequest
     * @return Notifications
     */
    public function setUserRequest(\ArtesanIO\ArtesanusBundle\Entity\User $userRequest = null)
    {
        $this->userRequest = $userRequest;

        return $this;
    }

    /**
     * Get userRequest
     *
     * @return \ArtesanIO\ArtesanusBundle\Entity\User
     */
    public function getUserRequest()
    {
        return $this->userRequest;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notifications = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created = new \Datetime('now');
        $this->state = 0;
    }

    /**
     * Set response
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Notifications $response
     * @return Notifications
     */
    public function setResponse(\ArtesanIO\MoocsyBundle\Entity\Notifications $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return \ArtesanIO\MoocsyBundle\Entity\Notifications
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Add notifications
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Notifications $notifications
     * @return Notifications
     */
    public function addNotification(\ArtesanIO\MoocsyBundle\Entity\Notifications $notifications)
    {
        $this->notifications[] = $notifications;

        return $this;
    }

    /**
     * Remove notifications
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\Notifications $notifications
     */
    public function removeNotification(\ArtesanIO\MoocsyBundle\Entity\Notifications $notifications)
    {
        $this->notifications->removeElement($notifications);
    }

    /**
     * Get notifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Set requestResponse
     *
     * @param integer $requestResponse
     * @return Notifications
     */
    public function setRequestResponse($requestResponse)
    {
        $this->requestResponse = $requestResponse;

        return $this;
    }

    /**
     * Get requestResponse
     *
     * @return integer
     */
    public function getRequestResponse()
    {
        return $this->requestResponse;
    }

    /**
     * Add requestRequest
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\RequestResponse $requestRequest
     * @return Notifications
     */
    public function addRequestRequest(\ArtesanIO\MoocsyBundle\Entity\RequestResponse $requestRequest)
    {
        $this->requestRequest[] = $requestRequest;

        return $this;
    }

    /**
     * Remove requestRequest
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\RequestResponse $requestRequest
     */
    public function removeRequestRequest(\ArtesanIO\MoocsyBundle\Entity\RequestResponse $requestRequest)
    {
        $this->requestRequest->removeElement($requestRequest);
    }

    /**
     * Get requestRequest
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequestRequest()
    {
        return $this->requestRequest;
    }

    /**
     * Add responseResponse
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\RequestResponse $responseResponse
     * @return Notifications
     */
    public function addResponseResponse(\ArtesanIO\MoocsyBundle\Entity\RequestResponse $responseResponse)
    {
        $this->responseResponse[] = $responseResponse;

        return $this;
    }

    /**
     * Remove responseResponse
     *
     * @param \ArtesanIO\MoocsyBundle\Entity\RequestResponse $responseResponse
     */
    public function removeResponseResponse(\ArtesanIO\MoocsyBundle\Entity\RequestResponse $responseResponse)
    {
        $this->responseResponse->removeElement($responseResponse);
    }

    /**
     * Get responseResponse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResponseResponse()
    {
        return $this->responseResponse;
    }
}
