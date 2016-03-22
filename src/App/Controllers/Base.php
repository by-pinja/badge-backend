<?php
/**
 * /src/App/Controllers/Base.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

// Silex components
use JMS\Serializer\SerializationContext;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Base
 *
 * Abstract base class for all application controllers.
 *
 * @category    Controller
 * @package     App\Controllers
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
abstract class Base implements ControllerProviderInterface, Interfaces\Base
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var ControllerCollection
     */
    protected $controllers;

    /**
     * Returns routes to connect to the given application.
     *
     * @param   Application     $app    An Application instance
     *
     * @return  ControllerCollection    A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        // Store Application and ControllerCollection collection to class context
        $this->app = $app;
        $this->controllers = $app['controllers_factory'];

        // Register current controller routes
        $this->registerRoutes();

        return $this->controllers;
    }

    /**
     * Helper method to make JSON response.
     *
     * @param   null|string|Entity|Entity[]    $data
     * @param   integer                        $statusCode
     * @param   null|SerializationContext      $context
     *
     * @return  Response
     */
    protected function makeResponse($data, $statusCode = 200, SerializationContext $context = null)
    {
        // Create new response
        $response = new Response();
        $response->setContent(
            (empty($data) && is_string($data)) ? '' : $this->app['serializer']->serialize($data, 'json', $context)
        );
        $response->setStatusCode($statusCode);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}