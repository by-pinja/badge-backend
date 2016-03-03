<?php
/**
 * /src/App/Controllers/IndexController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

// Symfony components
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexController
 *
 * This handles following route handling on application:
 *  GET /
 *  GET /test
 *
 * @category    Controller
 * @package     App\Controllers
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class IndexController extends Base
{
    /**
     * Method to register all routes for current controller.
     *
     * @return void
     */
    public function registerRoutes()
    {
        $this->app->get('/', [$this, 'index']);
        $this->app->get('/test', [$this, 'test']);
    }

    /**
     * Index action handling, this will just redirect user to API docs.
     *
     * @param   Request $request
     *
     * @return  string
     */
    public function index(Request $request)
    {
        return $this->app->redirect($request->getBasePath() . '/api-docs');
    }

    /**
     * This action is just for easy testing purposes, note that this route is not secured.
     *
     * @return JsonResponse
     */
    public function test()
    {
        // Just put your test code here... and remember to remove it afterwards
        return $this->app->json(['test']);
    }
}
