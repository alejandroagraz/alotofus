<?php

namespace Alotofus\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseApiController extends FOSRestController
{
    /**
     * Throws exception if the the logged user does not have privileges for this resource
     *
     * @param null $roles The roles
     *
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException when not allowed to access this resource
     */
    protected function checkMinimumRole($roles = null)
    {
        if ($this->getUser() == null && $roles != null) {
            throw new HttpException(403, "Not allowed to access this resource");
        }

        $userRole = $this->getUser()->getRoles();
        if (!in_array($userRole[0], $roles)) {
            throw new HttpException(403, "Not allowed to access this resource");
        }
    }

    /**
     * Throws exception if the the logged user id does not match with given id
     *
     * @param string $id The id of user
     *
     * @return void
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException when not allowed to access this resource
     */
    protected function checkSameId($id)
    {
        if ($id != $this->getUser()->getId()) {
            throw new HttpException(403, "Not allowed to access this resource");
        }
    }

    /**
     * Returns created view by data, groups, status code and format given
     *
     * @param mixed  $data       The data
     * @param null   $groups     The groups
     * @param int    $statusCode The HTTP status code
     * @param string $format     The format of serializer
     *
     * @return View
     */
    protected function createView($data, $groups = null, $statusCode = 200, $format = 'json')
    {
        $view = View::create()
            ->setStatusCode($statusCode)
            ->setFormat($format)
            ->setData($data);
        if ($groups != null) {
            $view->setSerializationContext(SerializationContext::create()->setGroups($groups));
        }

        return $view;
    }

    /**
     * Returns all the errors from form into array
     *
     * @param \Symfony\Component\Form\FormInterface $form The form
     *
     * @return array
     */
    protected function getFormErrors(FormInterface $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getFormErrors($child);
            }
        }

        return $errors;
    }
}
