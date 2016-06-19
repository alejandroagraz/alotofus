<?php

namespace Alotofus\HoonterWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WaitingStartups
 *
 * @ORM\Table(name="waiting_startups")
 * @ORM\Entity
 * //@UniqueEntity("email")//validacion que el campo es unico
 * @ORM\HasLifecycleCallbacks() //metodo para poder crear automaticamente el created y updated
 */
class WaitingStartups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="startup_type", type="string", length=1, nullable=false)
     */
    private $startupType;

    /**
     * @var string
     *
     * @ORM\Column(name="startup_p", type="string", length=1, nullable=false)
     */
    private $startupP;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=true)
     */
    private $registrationDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_id", type="integer", nullable=true)
     */
    private $statusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="invitation_type", type="integer", nullable=true)
     */
    private $invitationType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="confirmation_date", type="datetime", nullable=true)
     */
    private $confirmationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;



 //----------------------> Set and Get <----------------------------------
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setStartupType($startupType)
    {
        $this->startupType = $startupType;
        
        return $this;
    } 


    public function getStartupType()
    {
        return $this->startupType;
    }
 

 
     public function setStartupP($startupP)
    {
        $this->startupP = $startupP;
        
        return $this;
    } 


    public function getStartupP()
    {
        return $this->startupP;
    }


 
     public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    } 


    public function getName()
    {
        return $this->name;
    }
 
 
      public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    } 


    public function getEmail()
    {
        return $this->email;
    }
 
 
       public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
        
        return $this;
    } 


    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }
    
 
       public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
        
        return $this;
    } 


    public function getStatusId()
    {
        return $this->statusId;
    }
 
 
        public function setInvitationType($invitationType)
    {
        $this->invitationType = $invitationType;
        
        return $this;
    } 


    public function getInvitationType()
    {
        return $this->invitationType;
    }
 

    public function setConfirmationDate ($confirmationDate )
    {
        $this->confirmationDate  = $confirmationDate;
        
        return $this;
    }
    
    
    public function getConfirmationDate ()
    {
        return $this->confirmationDate;
    }


    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }



    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }

    public function setRegistrationDateValue()
    {
        $this->registrationDate = new \DateTime();
    }


}
