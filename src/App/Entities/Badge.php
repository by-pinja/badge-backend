<?php
/**
 * /src/App/Entities/Badge.php
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

/**
 * Class Badge
 *
 * @SWG\Definition(
 *      title="Badge",
 *      description="Badge data as in JSON object",
 *      type="object",
 *      required={
 *          "title",
 *          "group",
 *      },
 *      example={
 *          "id": 1,
 *          "title": "first person to send brotacon message!",
 *      },
 * )
 *
 * @ORM\Table(
 *      name="badge",
 *      indexes={
 *          @ORM\Index(
 *              name="fk_badge_badge_group_id",
 *              columns={"badge_group_id"}
 *          ),
 *          @ORM\Index(
 *              name="fk_badge_image_id",
 *              columns={"image_id"}
 *          ),
 *          @ORM\Index(
 *              name="fk_badge_user_id",
 *              columns={"user_id"}
 *          ),
 *      },
 *  )
 * @ORM\Entity
 *
 * @category    Core
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Badge implements JsonSerializable
{
    /**
     * Badge ID
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
     * Title of the badge
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="title",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $title;

    /**
     * Description of the badge
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
     * Icon definition for the badge, [optional]
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="icon",
     *      type="string",
     *      length=255,
     *      nullable=true,
     *  )
     */
    private $icon;

    /**
     * Badge group.
     *
     * @var \App\Entities\BadgeGroup
     *
     * @SWG\Property()
     * @ORM\ManyToOne(targetEntity="App\Entities\BadgeGroup")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(
     *          name="badge_group_id",
     *          referencedColumnName="id",
     *      ),
     *  })
     */
    private $badgeGroup;

    /**
     * Image for the badge, [optional]
     *
     * @var \App\Entities\Image
     *
     * @SWG\Property()
     * @ORM\ManyToOne(targetEntity="App\Entities\Image")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(
     *          name="image_id",
     *          referencedColumnName="id",
     *      ),
     *  })
     */
    private $image;

    /**
     * User who achieved this badge
     *
     * @var \App\Entities\User
     *
     * @SWG\Property()
     * @ORM\ManyToOne(targetEntity="App\Entities\User")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(
     *          name="user_id",
     *          referencedColumnName="id",
     *      ),
     *  })
     */
    private $user;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return BadgeGroup
     */
    public function getBadgeGroup()
    {
        return $this->badgeGroup;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $title
     *
     * @return Badge
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return Badge
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return Badge
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param BadgeGroup $badgeGroup
     *
     * @return Badge
     */
    public function setBadgeGroup($badgeGroup)
    {
        $this->badgeGroup = $badgeGroup;

        return $this;
    }

    /**
     * @param Image $image
     *
     * @return Badge
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Badge
     */
    public function setUser($user)
    {
        $this->user = $user;

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
            'title'         => $this->getTitle(),
            'description'   => $this->getDescription(),
            'icon'          => $this->getIcon(),
            'badgeGroup'    => $this->getBadgeGroup(),
            'image'         => $this->getImage(),
            'user'          => $this->getUser(),
        ];
    }
}
