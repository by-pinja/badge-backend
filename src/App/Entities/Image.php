<?php
/**
 * /src/App/Entities/Image.php
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
 * Class Image
 *
 * @SWG\Definition(
 *      title="Image",
 *      description="Image object that are attached to badges, and/or something else...",
 *      type="object",
 *      required={
 *          "filename",
 *          "mime",
 *          "data",
 *      },
 *      example={
 *          "hash": "65c35182-d7f0-11e5-885a-0800273a5c86",
 *          "filename": "test.png",
 *          "mime": "image/png",
 *          "createdAt": "2016-02-23T18:46:05+00:00",
 *          "createdBy": {
 *              "id": 1,
 *              "username": "admin",
 *              "firstname": "Arnold",
 *              "surname": "Administrator",
 *              "email": "arnold@foobar.com",
 *              "roles": {
 *                  "ROLE_ADMIN",
 *                  "ROLE_USER"
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
 *      name="image",
 *      indexes={
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
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="uq_hash",
 *              columns={"hash"}
 *          ),
 *      },
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repositories\Image"
 *  )
 *
 * @category    Doctrine
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Image extends Base implements JsonSerializable
{
    use ORMBehaviors\Blameable\Blameable;
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * Image id
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
     * UUID V4 hash for image
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="hash",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $hash;

    /**
     * Original filename of the image
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="filename",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $filename;

    /**
     * Mime type of the image
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="mime",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $mime;

    /**
     * Actual image data as in base64 encoded
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="data",
     *      type="blob",
     *      length=65535,
     *      nullable=false,
     *  )
     */
    private $data;

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
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @return \Resource
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $hash
     *
     * @return Image
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @param string $filename
     *
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @param string $mime
     *
     * @return Image
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * @param \Resource $data
     *
     * @return Image
     */
    public function setData($data)
    {
        $this->data = $data;

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
            'hash'      => $this->getHash(),
            'filename'  => $this->getFilename(),
            'mime'      => $this->getMime(),
            'createdAt' => $this->getCreatedAtJson(),
            'createdBy' => $this->getCreatedBy(),
            'updatedAt' => $this->getUpdatedAtJson(),
            'updatedBy' => $this->getUpdatedBy(),
        ];
    }
}
