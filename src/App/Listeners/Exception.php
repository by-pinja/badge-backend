<?php
/**
 * /src/App/Listeners/Exception.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Listeners;

// Symfony components
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

// 3rd party components
use Monolog\Logger;

/**
 * Class Exception
 *
 * @category    Listeners
 * @package     App\Listeners
 * @author      TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Exception
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var GetResponseForExceptionEvent
     */
    private $event;

    /**
     * ExceptionLogger constructor.
     *
     * @param   Logger                          $logger
     * @param   GetResponseForExceptionEvent    $event
     */
    public function __construct(Logger $logger, GetResponseForExceptionEvent $event)
    {
        $this->logger = $logger;
        $this->event = $event;

        $this->process();
    }

    /**
     * Method to process and log kernel.exception events.
     */
    protected function process()
    {
        // Get exception object
        $exception = $this->event->getException();

        // Log exception
        $this->logger->error((string)$exception);

        if ($exception instanceof AuthenticationException ||
            $exception instanceof AccessDeniedException ||
            $exception instanceof AuthenticationCredentialsNotFoundException ||
            $exception->getPrevious() instanceof AuthenticationException ||
            $exception->getPrevious() instanceof AccessDeniedException ||
            $exception->getPrevious() instanceof AuthenticationCredentialsNotFoundException
        ) {
            $responseData = [
                'status'    => method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 401,
                'message'   => $exception->getMessage(),
                'code'      => $exception->getCode(),
            ];

            $response = new JsonResponse();
            $response->setData($responseData);
            $response->setStatusCode($responseData['status']);

            $this->event->setResponse($response);
        }
    }
}
