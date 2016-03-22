<?php
/**
 * /src/App/Controllers/ImageController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controllers;

// Symfony components
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ImageController
 *
 * This handles following route handling on application:
 *  GET /image/show/:hash
 *
 * @mountPoint  /image
 *
 * @category    Controller
 * @package     App\Controllers
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Image extends Rest
{
    /**
     * Service that controller is using.
     *
     * @var \App\Services\Image
     */
    protected $service;

    /**
     * Method to register all routes for current controller.
     *
     * @return void
     */
    public function registerRoutes()
    {
        $this->controllers->get('/show/{hash}', [$this, 'show']);
    }

    /**
     * Method to expose necessary services for controller use.
     *
     * @return  void
     */
    public function exposeServices()
    {
        $this->service = $this->app['service.Image'];
    }

    /**
     * Action method to serve image from database by given hash.
     *
     * @param   string  $hash
     *
     * @return  Response
     */
    public function show($hash)
    {
        // Fetch image object by hash
        $image = $this->service->findOneByHash($hash);

        // Yeah image found
        if ($image instanceof Image) {
            $resource = $image->getData();
            $mime = $image->getMime();
            $filename = $image->getFilename();
        } else { // Oh noes, get 'not-found' image
            $resource = fopen($this->app->getRootDir() . 'resources/images/not-found.png', 'rb');
            $mime = 'image/png';
            $filename = 'not-found.png';
        }

        // Specify used headers
        $headers = [
            'Content-Type'          => $mime,
            'Content-Disposition'   => 'inline; filename="' . $filename . '"',
        ];

        return new Response(stream_get_contents($resource), 200, $headers);
    }
}
