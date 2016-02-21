<?php
/**
 * /src/App/Controllers/BadgeController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

// Application components
use App\Services\Badge as BadgeService;

/**
 * Class BadgeController
 *
 * This handles following route handling on application:
 *  GET /badge/
 *  GET /badge/:id
 *  POST /badge/
 *  PUT /badge/:id
 *  DELETE /badge/:id
 *
 * @category    Controller
 * @package     App\Controllers
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class BadgeController extends Rest
{
    /**
     * Service that controller is using.
     *
     * @var BadgeService
     */
    protected $service;

    /**
     * Method to register all routes for current controller.
     *
     * @return void
     */
    public function registerRoutes()
    {
        $this->controllers->get('/', [$this, 'find']);
        $this->controllers->get('/{id}', [$this, 'findOne']);
        $this->controllers->post('/', [$this, 'create']);
        $this->controllers->put('/{id}', [$this, 'update']);
        $this->controllers->delete('/{id}', [$this, 'delete']);
    }

    /**
     * Method to expose necessary services for controller use.
     *
     * @return  void
     */
    public function exposeServices()
    {
        $this->service = $this->app['badge.service'];
    }
}
