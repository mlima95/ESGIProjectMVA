<?php
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

class OpenApiFactory implements OpenApiFactoryInterface
{
    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);
        $pathItem = $openApi->getPaths()->getPath('/api/stored_videos');
        $operation = $pathItem->getGet();

        $openApi->getPaths()->addPath('/api/stored_videos', $pathItem->withGet(
            $operation->withParameters(array_merge(
                $operation->getParameters(),
                [new Model\Parameter('status', 'query', 'Status of Storedvideo', true)]
            ))
        ));

        $openApi = $openApi->withInfo((new Model\Info('Status', 'v1', 'Status of Storedvideo'))->withExtensionProperty('info-key', 'Int status'));

        return $openApi;
    }
}