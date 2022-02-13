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
        $paths = $openApi->getPaths();
        /****************** StoredVideo ********************/
        // Add Get collection
        $storedVideoGetColPath = $paths->getPath('/api/stored_videos');
        $storedVideoGetColOperation = $storedVideoGetColPath->getGet();
        $openApi->getPaths()->addPath('/api/stored_videos', $storedVideoGetColPath->withGet(
            $storedVideoGetColOperation->withParameters(array_merge(
                $storedVideoGetColOperation->getParameters(),
                [new Model\Parameter('status', 'query', 'Status of Storedvideo', true)]
            ))
        ));
        $openApi = $openApi->withInfo((new Model\Info('Status', 'v1', 'Status of Storedvideo'))->withExtensionProperty('info-key', 'Int status'));

        $searchThemeGetColPath = $paths->getPath('/api/search_themes');
        $searchVideoGetColOperation = $searchThemeGetColPath->getGet();
        $openApi->getPaths()->addPath('/api/search_themes', $searchThemeGetColPath->withGet(
            $searchVideoGetColOperation->withParameters(array_merge(
                $searchVideoGetColOperation->getParameters(),
                [new Model\Parameter('keyword', 'query', 'Keyword of SearchThemes', true)]
            ))
        ));
        $openApi = $openApi->withInfo((new Model\Info('keyword', 'v1', 'Keyword of SearchThemes'))->withExtensionProperty('info-key', 'String keyword'));

        // Hide hidden item
        foreach ($openApi->getPaths()->getPaths() as $key => $path) {
            if ($path->getGet() && $path->getGet()->getSummary() === 'hidden') {
                $openApi->getPaths()->addPath($key, $path->withGet(null));
            }
        }
        return $openApi;
    }
}