<?php

namespace Sonata\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController;
use Sonata\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SecurityFOSUser2Controller.
 */
class SecurityFOSUser2Controller extends SecurityController
{
    /**
     * {@inheritdoc}
     */
    public function loginAction(Request $request)
    {
        $token = $this->container->get('security.context')->getToken();

        if ($token && $token->getUser() instanceof UserInterface) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        return parent::loginAction($request);
    }
}
