<?php
/**
 * /src/App/Entities/Badge.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Entities;

// Application components
use App\Doctrine\Behaviours as ORMBehaviors;

// Doctrine components
use Doctrine\ORM\Mapping as ORM;

// 3rd party components
use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Badge
 *
 * @SWG\Definition(
 *      title="Badge",
 *      description="Badge data",
 *      type="object",
 *      required={
 *          "title",
 *          "group",
 *      },
 *      example={
 *          "id": 1,
 *          "title": "first person to send brotacon message!",
 *          "description": "Some detailed description",
 *          "icon": "foobar",
 *          "badgeGroup": {
 *              "id": 1,
 *              "name": "Hackday",
 *              "description": "Badges for hackday",
 *              "createdAt": "2016-02-25T18:46:05+00:00",
 *              "createdBy": {
 *                  "id": 1,
 *                  "username": "admin",
 *                  "firstname": "Arnold",
 *                  "surname": "Administrator",
 *                  "email": "arnold@foobar.com",
 *                  "roles": {
 *                      "ROLE_USER",
 *                      "ROLE_ADMIN",
 *                  },
 *                  "createdAt": "2016-02-20T16:32:09+00:00",
 *                  "createdBy": null,
 *                  "updatedAt": null,
 *                  "updatedBy": null,
 *              },
 *              "updatedAt": null,
 *              "updatedBy": null
 *          },
 *          "image": {
 *              "hash": "65c35182-d7f0-11e5-885a-0800273a5c86",
 *              "filename": "test.png",
 *              "mime": "image/png",
 *              "createdAt": "2016-02-23T18:46:05+00:00",
 *              "createdBy": {
 *                  "id": 1,
 *                  "username": "admin",
 *                  "firstname": "Arnold",
 *                  "surname": "Administrator",
 *                  "email": "arnold@foobar.com",
 *                  "roles": {
 *                      "ROLE_USER",
 *                      "ROLE_ADMIN",
 *                  },
 *                  "createdAt": "2016-02-20T16:32:09+00:00",
 *                  "createdBy": null,
 *                  "updatedAt": null,
 *                  "updatedBy": null,
 *              },
 *              "updatedAt": null,
 *              "updatedBy": null
 *          },
 *          "user": {
 *              "id": 2,
 *              "username": "john",
 *              "firstname": "John",
 *              "surname": "Doe",
 *              "email": "john.doe@foobar.com",
 *              "roles": {
 *                  "ROLE_USER"
 *              },
 *              "createdAt": "2016-02-25T18:46:05+00:00",
 *              "createdBy": {
 *                  "id": 1,
 *                  "username": "admin",
 *                  "firstname": "Arnold",
 *                  "surname": "Administrator",
 *                  "email": "arnold@foobar.com",
 *                  "roles": {
 *                      "ROLE_USER",
 *                      "ROLE_ADMIN",
 *                  },
 *                  "createdAt": "2016-02-20T16:32:09+00:00",
 *                  "createdBy": null,
 *                  "updatedAt": null,
 *                  "updatedBy": null,
 *              },
 *              "updatedAt": null,
 *              "updatedBy": null,
 *          },
 *          "createdAt": "2016-02-25T18:46:05+00:00",
 *          "createdBy": {
 *              "id": 1,
 *              "username": "admin",
 *              "firstname": "Arnold",
 *              "surname": "Administrator",
 *              "email": "arnold@foobar.com",
 *              "roles": {
 *                  "ROLE_USER",
 *                  "ROLE_ADMIN",
 *              },
 *              "createdAt": "2016-02-20T16:32:09+00:00",
 *              "createdBy": null,
 *              "updatedAt": null,
 *              "updatedBy": null,
 *          },
 *          "updatedAt": null,
 *          "updatedBy": null,
 *      },
 *  )
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
 *          @ORM\Index(
 *              name="createdBy_id",
 *              columns={"createdBy_id"}
 *          ),
 *          @ORM\Index(
 *              name="updatedBy_id",
 *              columns={"updatedBy_id"}
 *          ),
 *          @ORM\Index(
 *              name="deletedBy_id",
 *              columns={"updatedBy_id"}
 *          ),
 *      },
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repositories\Badge"
 *  )
 *
 * @category    Doctrine
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Badge extends Base
{
    // Traits
    use ORMBehaviors\Blameable;
    use ORMBehaviors\Timestampable;

    /**
     * Badge ID
     *
     * @var integer
     *
     * @SWG\Property()
     * @JMS\Groups({"Default", "Badge", "BadgeId"})
     *
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
     * @JMS\Groups({"Default", "Badge"})
     *
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
     * @var null|string
     *
     * @SWG\Property()
     * @JMS\Groups({"Default", "Badge"})
     *
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
     * @var null|string
     *
     * @SWG\Property()
     * @JMS\Groups({"Default", "Badge"})
     *
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
     * @JMS\Groups({"BadgeGroup", "BadgeGroupId"})
     *
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
     * @var null|\App\Entities\Image
     *
     * @SWG\Property()
     * @JMS\Groups({"Image", "ImageId"})
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\Image")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(
     *          name="image_id",
     *          referencedColumnName="id",
     *          nullable=true
     *      ),
     *  })
     */
    private $image;

    /**
     * User who achieved this badge
     *
     * @var null|\App\Entities\User
     *
     * @SWG\Property()
     * @JMS\Groups({"User", "UserId"})
     *
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
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return null|BadgeGroup
     */
    public function getBadgeGroup()
    {
        return $this->badgeGroup;
    }

    /**
     * @return null|Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return null|User
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
}
