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

// Symfony components
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

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
 *      name="user",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="uq_username",
 *              columns={"username"}
 *          ),
 *          @ORM\UniqueConstraint(
 *              name="uq_email",
 *              columns={"email"}
 *          ),
 *      },
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repositories\User"
 *  )
 *
 * @category    Doctrine
 * @package     App\Entities
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class User implements AdvancedUserInterface, JsonSerializable
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
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        if (!is_array($this->roles)) {
            $this->roles = explode(',', $this->roles);
        }

        $roles = $this->roles;

        // Every user must have at least one role, per Silex security docs.
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Getter method for user identifier, this can be username or email.
     *
     * @todo    How to determine which one this is?
     *
     * @return  string
     */
    public function getIdentifier()
    {
        return $this->username;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
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
     * Method to verify given password against hashed one.
     *
     * @param   string  $password
     *
     * @return  bool
     */
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
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

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        // TODO: Implement isAccountNonExpired() method.
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        // TODO: Implement isAccountNonLocked() method.
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        // TODO: Implement isCredentialsNonExpired() method.
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
        return true;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
