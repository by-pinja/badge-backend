<?php
/**
 * /src/App/Entities/Base.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Entities;

// Doctrine components
use Doctrine\ORM\Mapping as ORM;

// 3rd party components
use Swagger\Annotations as SWG;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Class Base
 *
 * Abstract base class to all application entities.
 *
 * @category    Doctrine
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
abstract class Base
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * Created at datetime.
     *
     * @var \DateTime
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="createdAt",
     *      type="datetime",
     *      nullable=true,
     *  )
     */
    protected $createdAt;

    /**
     * Updated at datetime.
     *
     * @var \DateTime
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="updatedAt",
     *      type="datetime",
     *      nullable=true,
     *  )
     */
    protected $updatedAt;

    /**
     * Getter method for 'createdAt' attribute for JSON output.
     *
     * @return string
     */
    public function getCreatedAtJson()
    {
        return $this->formatDatetime($this->getCreatedAt());
    }

    /**
     * Getter method for 'updatedAt' attribute for JSON output.
     *
     * @return string
     */
    public function getUpdatedAtJson()
    {
        return $this->formatDatetime($this->getUpdatedAt());
    }

    /**
     * Helper method to format given \DateTime object to RFC3339 format.
     *
     * @see https://www.ietf.org/rfc/rfc3339.txt
     *
     * @param   \DateTime|null  $dateTime
     *
     * @return  null|string
     */
    protected function formatDatetime(\DateTime $dateTime = null)
    {
        return is_null($dateTime) ? null : $dateTime->format(\DATE_RFC3339);
    }
}
