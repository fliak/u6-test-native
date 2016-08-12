<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 12.8.16
 * Time: 7.15
 */

namespace App\Auth;


class User
{
    const ROLE_ADMIN = 'admin';
    
    const ROLE_GUEST = 'guest';
    
    /**
     * @var string
     */
    protected $role = self::ROLE_GUEST;

    /**
     * @var \DateTime
     */
    protected $authorizedAt;
    
    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return \DateTime
     */
    public function getAuthorizedAt()
    {
        return $this->authorizedAt;
    }

    /**
     * @param \DateTime $authorizedAt
     */
    public function setAuthorizedAt($authorizedAt)
    {
        $this->authorizedAt = $authorizedAt;
    }
    
    
 
    

}