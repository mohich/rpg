<?php
/**
 * Created by PhpStorm.
 * User: Smart
 * Date: 12.12.2016 г.
 * Time: 13:06 ч.
 */

namespace RpgBundle\DTO;


class PlayerRegisterBindingModel
{
  private $username;
  private $password;


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}