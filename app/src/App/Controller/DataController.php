<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 21.29
 */

namespace App\Controller;


use App\Http\JsonResponse;
use App\Http\Request;
use App\Http\Response;
use App\Model\DataModel;
use App\Model\MenuModel;

class DataController extends AbstractController
{

    /**
     * @return DataModel
     */
    protected function getModel()   {
        return $this->getAppBuilder()->getModel('data');
    }
    
    
    protected function getAuth()    {
        return $this->getAppBuilder()->getAuth();
    }
    
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAction(Request $request)   {

        
        $data = $this->getModel()->getLastElement();

        if ($data === false)    {
            return new JsonResponse($data, 404);
        }

        return new JsonResponse($data);
    }
    
    public function postAction(Request $request)    {
        if (!$this->getAuth()->isAdmin())    {
            return new JsonResponse('Forbidden', 403);
        }
        
        $requestPayload = json_decode($request->getContent(), true);

        $data = $requestPayload['data'];
        $data = htmlentities($data);
        
        $data = nl2br($data);


        $ret = $this->getModel()->addElement($data);
        
        if ($ret)   {
            return new JsonResponse('ok');
        }
        else    {
            return new JsonResponse('fail', 500);
        }
        
        
    }

}