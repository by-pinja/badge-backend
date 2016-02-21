<?php
/**
 * /src/App/Services/Badge.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Services;

// Entity components
use App\Entities\Badge as Entity;

/**
 * Class Badge
 *
 * Service class for Badge objects.
 *
 * @category    Services
 * @package     App\Services
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 *
 * @method  Entity[]    find()
 * @method  Entity      findOne($id)
 * @method  Entity      create($data)
 * @method  Entity      update($id, $data)
 * @method  Entity      delete($id)
 */
class Badge extends Rest
{
    /**
     * Name of the repository that current REST API will use.
     *
     * @var string
     */
    public $repositoryName = 'App\Entities\Badge';
}
