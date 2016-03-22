<?php
/**
 * /src/App/Controllers/BadgeController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

/**
 * Class Badge
 *
 * This handles following route handling on application:
 *  GET /badge/
 *  GET /badge/:id
 *  POST /badge/
 *  PUT /badge/:id
 *  DELETE /badge/:id
 *
 * @mountPoint  /badge
 *
 * @category    Controller
 * @package     App\Controllers
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Badge extends Rest
{
    /**
     * Service that controller is using.
     *
     * @var \App\Services\Author
     */
    protected $service;

    /**
     * Method to expose necessary services for controller use.
     *
     * @return  void
     */
    public function exposeServices()
    {
        $this->service = $this->app['service.Badge'];
    }
}
