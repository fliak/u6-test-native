<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 12.8.16
 * Time: 7.08
 */

namespace App\Controller;


use App\Auth\Auth;
use App\Http\JsonResponse;
use App\Http\Request;

class AuthController extends AbstractController
{

    public function loginAction(Request $request)   {

        $requestPayload = json_decode($request->getContent(), true);

        if (!array_key_exists('token', $requestPayload))  {
            return new JsonResponse('"token" should be specified', 400);
        }

        if ($this->getAuth()->authorize($requestPayload['token']))  {
            return $this->checkAction($request);
        }
        else    {
            return new JsonResponse('Forbidden', 403);
        }
    }
    
    public function logoutAction(Request $request)   {
        if ($this->getAuth()->logout()) {
            return new JsonResponse('ok');
        }
        else    {
            return new JsonResponse('fail', 500);
        }
    }

    public function checkAction(Request $request)   {
        return new JsonResponse([
            'isAuthorized' => $this->getAuth()->isAuthorized(),
            'isAdmin' => $this->getAuth()->isAdmin()
        ]);
    }

    /**
     * @return Auth
     */
    protected function getAuth()    {
        return $this->getAppBuilder()->getAuth();
    }
}