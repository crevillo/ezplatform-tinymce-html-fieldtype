<?php

namespace Crevillo\EzTinyMCEHtmlBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use eZ\Bundle\EzPublishCoreBundle\Imagine\Cache\AliasGeneratorDecorator;
use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\Core\FieldType\Image\Value as ImageValue;
use eZ\Publish\Core\IO\IOService;
use eZ\Publish\Core\IO\Values\BinaryFileCreateStruct;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    private $contentTypeService;

    private $contentService;

    private $locationService;

    private $IOService;

    private $variationHandler;

    private $configResolver;

    public function __construct(
        ContentTypeService $contentTypeService,
        ContentService $contentService,
        LocationService $locationService,
        IOService $IOService,
        AliasGeneratorDecorator $aliasGeneratorDecorator,
        ConfigResolverInterface $configResolver
    ) {
        $this->contentTypeService = $contentTypeService;
        $this->contentService = $contentService;
        $this->locationService = $locationService;
        $this->IOService = $IOService;
        $this->variationHandler = $aliasGeneratorDecorator;
        $this->configResolver = $configResolver;
    }

    public function uploadImageAction(Request $request)
    {
        $file = reset($request->files);
        $lang = current($this->configResolver->getParameter('languages'));
        $imagesParentLocationId = $this->getParameter('tiny_mce.images_parent_location_id');

        $contentType = $this->contentTypeService->loadContentTypeByIdentifier("image");
        $contentCreateStruct = $this->contentService->newContentCreateStruct($contentType, $lang);

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $file['file'];
        $imageName = $uploadedFile->getClientOriginalName();

        $contentCreateStruct->setField( 'name', $imageName);

        // set image file field
        $value = new ImageValue(
            array(
                'inputUri' => $uploadedFile->getRealPath(),
                'fileSize' => $uploadedFile->getSize(),
                'fileName' =>  $imageName,
                'alternativeText' => $imageName
            )
        );

        $contentCreateStruct->setField('image', $value);

        $draft = $this->contentService->createContent(
            $contentCreateStruct,
            array(
                $this->locationService->newLocationCreateStruct($imagesParentLocationId)
            )
        );
        $content = $this->contentService->publishVersion($draft->versionInfo);

        return new JsonResponse([
            'location' => $this->variationHandler->getVariation(
                $content->getField('image'),
                $content->getVersionInfo(),
                'original'
            )->uri
        ]);
    }
}
