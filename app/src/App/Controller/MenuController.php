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
use App\Model\MenuModel;

class MenuController extends AbstractController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)   {

        /**
         * @var MenuModel $menuModel
         */
        $menuModel = $this->getAppBuilder()->getModel('menu');
        
        $tree = $menuModel->getTree();
        

        return new JsonResponse($tree);
        
        
    }

}