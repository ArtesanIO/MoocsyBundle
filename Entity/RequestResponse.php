<?php

namespace ArtesanIO\MoocsyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationsRequestResponse
 *
 * @ORM\Table(name="moocsy_request_response")
 * @ORM\Entity(repositoryClass="ArtesanIO\MoocsyBundle\Entity\RequestResponseRepository")
 */
class RequestResponse
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
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Notifications", inversedBy="requestRequest")
    * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
    */

    private $request;

    /**
    * @ORM\ManyToOne(targetEntity="ArtesanIO\MoocsyBundle\Entity\Notifications", inversedBy="requestResponse")
    * @ORM\JoinColumn(name="response_id", referencedColumnName="id")
    */
    private $response;

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
     * Set request
     *
     * @param integer $request
     * @return NotificationsRequestResponse
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return integer
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set response
     *
     * @param integer $response
     * @return NotificationsRequestResponse
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return integer
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return NotificationsRequestResponse
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
