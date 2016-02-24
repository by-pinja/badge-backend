<?php
/**
 * /src/App/Entities/BadgeGroup.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Entities;

// Native components
use JsonSerializable;

// Doctrine components
use Doctrine\ORM\Mapping as ORM;

// 3rd party components
use Swagger\Annotations as SWG;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Class BadgeGroup
 *
 * @SWG\Definition(
 *      title="BadgeGroup",
 *      description="Badge group data",
 *      type="object",
 *      required={
 *          "name",
 *      },
 *      example={
 *          "id": 1,
 *          "name": "1st Hackday 2016",
 *          "description": "First hackday for the new year - good luck everyone!",
 *      },
 *  )
 *
 * @ORM\Table(
 *      name="badge_group"
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repositories\BadgeGroup"
 *  )
 *
 * @category    Doctrine
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class BadgeGroup extends Base implements JsonSerializable
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * Badge group id
     *
     * @var integer
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="id",
     *      type="integer",
     *      nullable=false,
     *  )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Badge group name
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="name",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $name;

    /**
     * Description of the badge group
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="description",
     *      type="text",
     *      length=65535,
     *      nullable=true,
     *  )
     */
    private $description;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $name
     *
     * @return BadgeGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return BadgeGroup
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return  array   data which can be serialized by json_encode, which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return [
            'id'            => $this->getId(),
            'name'          => $this->getName(),
            'description'   => $this->getDescription(),
            'createdAt'     => $this->getCreatedAtJson(),
            'updatedAt'     => $this->getUpdatedAtJson(),
        ];
    }
}
