<?php 

namespace application;

class ResultModel 
{
    public $login;
    public $email;
    public $password;
    public $error;
    
    function __construct($login, $email, $password)
    {
        $this->setLogin($login);
        $this->setEmail($email);
        $this->setPassword($password);
    }
    
    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    
    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }
    
    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}

?>