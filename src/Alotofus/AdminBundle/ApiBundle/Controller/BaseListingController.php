<?php
namespace Alotofus\ApiBundle\Controller;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseListingController extends BaseApiController
{
    /**
     * @param $resource
     *
     * @return mixed
     */
    protected function generateDummyTranslation($resource)
    {
        $resource->setName('');
        $em = $this->getDoctrine()->getManager();
        $em->persist($resource);
        $em->flush();

        return $resource;
    }

    /**
     * Checks if posted translations are valid
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return \FOS\RestBundle\View\View                             if invalid
     * @return \FOS\RestBundle\View\View                             if valid
     */
    protected function checkTranslations()
    {
        $trans = $this->getRequest()->get('translations');

        if (sizeof($trans) == 0 || !isset($trans['en']) || $trans['en'] == '') {
            throw new HttpException(400, 'No english translation found');
        }
    }

    /**
     * @param $resource
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function saveTranslations($resource)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        //Save translations
        foreach ($request->get('translations') as $lang => $trans) {
            if ($trans != "") {
                //Avoid saving empty strings
                $repository->translate($resource, 'name', $lang, $trans);
            }
        }
        $em->flush();

        return $this->generateResource($resource);
    }

    /**
     * @param $resource
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function generateResource($resource)
    {
        $repository = $this->getDoctrine()->getManager()
            ->getRepository('Gedmo\Translatable\Entity\Translation');

        $translations = $repository->findTranslations($resource);

        $view = $this->createView(
            array(
                'id' => $resource->getId(),
                'name' => $resource->getName(),
                'translations' => $translations
            )
        );

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
