<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 12.8.16
 * Time: 7.12
 */

namespace App\Auth;


use App\Session\SessionHandler;

class Auth
{
    /**
     * @var string
     * 
     * secure token md5 hash to match against user input
     */
    protected $tokenHash;

    /**
     * @var SessionHandler
     */
    protected $sessionHandler;

    /**
     * Auth constructor.
     * @param $tokenHash
     * @param $sessionHandler
     */
    public function __construct($tokenHash, $sessionHandler)
    {
        $this->tokenHash = $tokenHash;
        $this->sessionHandler = $sessionHandler;
    }


    public function authorize($token) {
//        var_dump($token, )
        if (strcmp(md5($token), $this->tokenHash) === 0)  {
            //pass
        
            $user = $this->factoryUser(User::ROLE_ADMIN);
            $user->setAuthorizedAt(new \DateTime());
            
            $this->sessionHandler->store('user', $user);
            
            return $user;
        }
        else    {
            return false;
        }
    }
    
    public function logout()    {
        return $this->sessionHandler->destroy();
    }

    /**
     * @param $role
     * @return User
     */
    protected function factoryUser($role)    {
        $user = new User();
        $user->setRole($role);
        
        return $user;
    }

    /**
     * @return User
     */
    public function getCurrentUser()    {
        $user = $this->sessionHandler->fetch('user', null);
        if (!$user) {
            $user = $this->factoryUser(User::ROLE_GUEST);
        }
        
        return $user;
    }

    /**
     * @return bool
     */
    public function isAuthorized()  {
        return (bool) $this->sessionHandler->fetch('user', false);
    }

    /**
     * @return bool
     */
    public function isAdmin()   {
        return $this->getCurrentUser()->getRole() === User::ROLE_ADMIN;
    }

}