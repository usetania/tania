<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        // dashboard
        if ('' === $trimmedPathinfo) {
            if ('GET' !== $canonicalMethod) {
                $allow[] = 'GET';
                goto not_dashboard;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'dashboard');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DashboardController::indexAction',  '_route' => 'dashboard',);
        }
        not_dashboard:

        if (0 === strpos($pathinfo, '/farms')) {
            // fields
            if (preg_match('#^/farms(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_fields;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fields')), array (  '_controller' => 'AppBundle\\Controller\\FieldController::indexAction',  'trailingSlash' => '/',));
            }
            not_fields:

            // fields_create
            if (0 === strpos($pathinfo, '/farms/create') && preg_match('#^/farms/create(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fields_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fields_create')), array (  '_controller' => 'AppBundle\\Controller\\FieldController::createAction',  'trailingSlash' => '/',));
            }
            not_fields_create:

            // fields_show
            if (preg_match('#^/farms/(?P<id>\\d+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fields_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fields_show')), array (  '_controller' => 'AppBundle\\Controller\\FieldController::showAction',  'trailingSlash' => '/',));
            }
            not_fields_show:

        }

        elseif (0 === strpos($pathinfo, '/areas')) {
            // areas
            if (preg_match('#^/areas(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_areas;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'areas')), array (  '_controller' => 'AppBundle\\Controller\\AreaController::indexAction',  'trailingSlash' => '/',));
            }
            not_areas:

            // areas_show
            if (preg_match('#^/areas/(?P<id>\\d+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_areas_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'areas_show')), array (  '_controller' => 'AppBundle\\Controller\\AreaController::showAction',  'trailingSlash' => '/',));
            }
            not_areas_show:

            // areas_create
            if (0 === strpos($pathinfo, '/areas/create') && preg_match('#^/areas/create(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_areas_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'areas_create')), array (  '_controller' => 'AppBundle\\Controller\\AreaController::createAction',  'trailingSlash' => '/',));
            }
            not_areas_create:

            // areas_edit
            if (preg_match('#^/areas/(?P<id>\\d+)/edit(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_areas_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'areas_edit')), array (  '_controller' => 'AppBundle\\Controller\\AreaController::editAction',  'trailingSlash' => '/',));
            }
            not_areas_edit:

        }

        elseif (0 === strpos($pathinfo, '/re')) {
            if (0 === strpos($pathinfo, '/reservoirs')) {
                // reservoirs
                if (preg_match('#^/reservoirs(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                    if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                        $allow = array_merge($allow, array('GET', 'POST'));
                        goto not_reservoirs;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservoirs')), array (  '_controller' => 'AppBundle\\Controller\\ReservoirController::indexAction',  'trailingSlash' => '/',));
                }
                not_reservoirs:

                // reservoirs_show
                if (preg_match('#^/reservoirs/(?P<id>\\d+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                    if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                        $allow = array_merge($allow, array('GET', 'POST'));
                        goto not_reservoirs_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'reservoirs_show')), array (  '_controller' => 'AppBundle\\Controller\\ReservoirController::showAction',  'trailingSlash' => '/',));
                }
                not_reservoirs_show:

            }

            elseif (0 === strpos($pathinfo, '/resetting')) {
                // fos_user_resetting_request
                if ('/resetting/request' === $pathinfo) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_fos_user_resetting_request;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                }
                not_fos_user_resetting_request:

                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                        $allow = array_merge($allow, array('GET', 'POST'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                }
                not_fos_user_resetting_reset:

                // fos_user_resetting_send_email
                if ('/resetting/send-email' === $pathinfo) {
                    if ('POST' !== $canonicalMethod) {
                        $allow[] = 'POST';
                        goto not_fos_user_resetting_send_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                }
                not_fos_user_resetting_send_email:

                // fos_user_resetting_check_email
                if ('/resetting/check-email' === $pathinfo) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_fos_user_resetting_check_email;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                }
                not_fos_user_resetting_check_email:

            }

            elseif (0 === strpos($pathinfo, '/register')) {
                // fos_user_registration_register
                if ('/register' === $trimmedPathinfo) {
                    if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                        $allow = array_merge($allow, array('GET', 'POST'));
                        goto not_fos_user_registration_register;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                }
                not_fos_user_registration_register:

                // fos_user_registration_check_email
                if ('/register/check-email' === $pathinfo) {
                    if ('GET' !== $canonicalMethod) {
                        $allow[] = 'GET';
                        goto not_fos_user_registration_check_email;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if ('GET' !== $canonicalMethod) {
                            $allow[] = 'GET';
                            goto not_fos_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::confirmAction',));
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ('/register/confirmed' === $pathinfo) {
                        if ('GET' !== $canonicalMethod) {
                            $allow[] = 'GET';
                            goto not_fos_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    }
                    not_fos_user_registration_confirmed:

                }

            }

        }

        // inventories
        if (0 === strpos($pathinfo, '/inventories') && preg_match('#^/inventories(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
            if ('GET' !== $canonicalMethod) {
                $allow[] = 'GET';
                goto not_inventories;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'inventories')), array (  '_controller' => 'AppBundle\\Controller\\InventoryController::indexAction',  'trailingSlash' => '/',));
        }
        not_inventories:

        if (0 === strpos($pathinfo, '/seeds')) {
            // seeds_create
            if (0 === strpos($pathinfo, '/seeds/create') && preg_match('#^/seeds/create(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_seeds_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'seeds_create')), array (  '_controller' => 'AppBundle\\Controller\\InventoryController::seedCreateAction',  'trailingSlash' => '/',));
            }
            not_seeds_create:

            // seeds_show
            if (preg_match('#^/seeds/(?P<id>[^/]+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_seeds_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'seeds_show')), array (  '_controller' => 'AppBundle\\Controller\\InventoryController::seedEditAction',  'trailingSlash' => '/',));
            }
            not_seeds_show:

        }

        elseif (0 === strpos($pathinfo, '/tasks')) {
            // tasks
            if (preg_match('#^/tasks(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_tasks;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tasks')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::indexAction',  'trailingSlash' => '/',));
            }
            not_tasks:

            // tasks_create
            if (0 === strpos($pathinfo, '/tasks/create') && preg_match('#^/tasks/create(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_tasks_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tasks_create')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::createAction',  'trailingSlash' => '/',));
            }
            not_tasks_create:

            // tasks_show
            if (preg_match('#^/tasks/(?P<id>\\d+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_tasks_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tasks_show')), array (  '_controller' => 'AppBundle\\Controller\\TaskController::showAction',  'trailingSlash' => '/',));
            }
            not_tasks_show:

        }

        elseif (0 === strpos($pathinfo, '/plants')) {
            // plants
            if (preg_match('#^/plants(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_plants;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'plants')), array (  '_controller' => 'AppBundle\\Controller\\PlantController::indexAction',  'trailingSlash' => '/',));
            }
            not_plants:

            // plants_create
            if (0 === strpos($pathinfo, '/plants/create') && preg_match('#^/plants/create(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_plants_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'plants_create')), array (  '_controller' => 'AppBundle\\Controller\\PlantController::createAction',  'trailingSlash' => '/',));
            }
            not_plants_create:

            // plants_show
            if (preg_match('#^/plants/(?P<id>\\d+)(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_plants_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'plants_show')), array (  '_controller' => 'AppBundle\\Controller\\PlantController::showAction',  'trailingSlash' => '/',));
            }
            not_plants_show:

            // plants_harvest
            if (preg_match('#^/plants/(?P<id>\\d+)/harvest(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_plants_harvest;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'plants_harvest')), array (  '_controller' => 'AppBundle\\Controller\\PlantController::harvestAction',  'trailingSlash' => '/',));
            }
            not_plants_harvest:

            // plants_edit
            if (preg_match('#^/plants/(?P<id>\\d+)/edit(?:(?P<trailingSlash>[/]{0,1}))?$#s', $pathinfo, $matches)) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_plants_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'plants_edit')), array (  '_controller' => 'AppBundle\\Controller\\PlantController::editAction',  'trailingSlash' => '/',));
            }
            not_plants_edit:

        }

        elseif (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if ('/profile' === $trimmedPathinfo) {
                if ('GET' !== $canonicalMethod) {
                    $allow[] = 'GET';
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ('/profile/edit' === $pathinfo) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_profile_edit;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
            }
            not_fos_user_profile_edit:

            // fos_user_change_password
            if ('/profile/change-password' === $pathinfo) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_change_password;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
            }
            not_fos_user_change_password:

        }

        elseif (0 === strpos($pathinfo, '/login')) {
            // fos_user_security_login
            if ('/login' === $pathinfo) {
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_security_login;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
            }
            not_fos_user_security_login:

            // fos_user_security_check
            if ('/login_check' === $pathinfo) {
                if ('POST' !== $canonicalMethod) {
                    $allow[] = 'POST';
                    goto not_fos_user_security_check;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
            }
            not_fos_user_security_check:

        }

        // fos_user_security_logout
        if ('/logout' === $pathinfo) {
            if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                $allow = array_merge($allow, array('GET', 'POST'));
                goto not_fos_user_security_logout;
            }

            return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
        }
        not_fos_user_security_logout:

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
