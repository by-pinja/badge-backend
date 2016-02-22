<?php
/**
 * /src/App/Services/Image.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Services;

// Entity components
use App\Entities\Image as Entity;

/**
 * Class Image
 *
 * Service class for Image objects.
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
class Image extends Rest
{
    /**
     * Name of the repository that current REST API will use.
     *
     * @var string
     */
    public $repositoryName = 'App\Entities\Image';

    /**
     * Service method to return single Image entity by given hash.
     *
     * @param   string  $hash
     *
     * @return  null|Entity
     */
    public function findOneByHash($hash)
    {
        return $this->getRepository()->findOneBy(['hash' => $hash]);
    }
}
