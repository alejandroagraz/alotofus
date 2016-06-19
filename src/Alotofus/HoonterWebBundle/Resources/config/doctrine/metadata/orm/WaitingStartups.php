<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * WaitingStartups
 *
 * @ORM\Table(name="waiting_startups")
 * @ORM\Entity
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


}
