<?php
/**
 * /src/App/Entities/User.php
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
 * User
 *
 * @SWG\Definition(
 *      title="User",
 *      description="User data",
 *      type="object",
 *      required={
 *          "username",
 *          "firstname",
 *          "surname",
 *          "email",
 *      },
 *      example={
 *          "id": 1,
 *          "username": "admin",
 *          "firstname": "Arnold",
 *          "surname": "Administrator",
 *          "email": "arnold@foobar.com",
 *      },
 *  )
 *
 * @ORM\Table(
 *      name="user"
 *  )
 * @ORM\Entity
 */
class User implements JsonSerializable
{
    /**
     * User id
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
     * Username
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="username",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $username;

    /**
     * Firstname of the user
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="firstname",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $firstname;

    /**
     * Surname of the user
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="surname",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $surname;

    /**
     * Email address of the user
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="email",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(
     *      name="password",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $password;

    /**
     * User roles
     *
     * @var string
     *
     * @SWG\Property()
     * @ORM\Column(
     *      name="roles",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $roles;

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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

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
            'id'        => $this->getId(),
            'username'  => $this->getUsername(),
            'firstname' => $this->getFirstname(),
            'surname'   => $this->getSurname(),
            'email'     => $this->getEmail(),
            'roles'     => $this->getRoles(),
        ];
    }
}
