<?php
/**
 * /src/App/Controllers/Base.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

// Application entities
use App\Entities\Base as Entity;

// Silex components
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

// Symfony components
use Symfony\Component\HttpFoundation\Response;

// 3rd party components
use JMS\Serializer\SerializationContext;

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
     * @var \App\Application
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
     * @param   null|string|Entity|Entity[] $content
     * @param   integer                     $statusCode
     * @param   null|SerializationContext   $context
     *
     * @return  Response
     */
    protected function makeResponse($content, $statusCode = 200, SerializationContext $context = null)
    {
        if ($content instanceof Entity ||
            (is_array($content) && isset($content[0]) && $content[0] instanceof Entity) ||
            is_array($content)
        ) {
            $content = $this->app['serializer']->serialize($content, 'json', $context);
        }

        // Create new response
        $response = new Response();
        $response->setContent($content);
        $response->setStatusCode($statusCode);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}