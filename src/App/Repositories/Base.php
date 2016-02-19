<?php
/**
 * /src/App/Repositories/Base.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Repositories;

// Application entities
use App\Entities;

// Doctrine components
use Doctrine\ORM\EntityRepository;

/**
 * Class Base
 *
 * @category    Doctrine
 * @package     App\Repositories
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
abstract class Base extends EntityRepository
{
}
