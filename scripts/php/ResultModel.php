<?php 

namespace application;

include 'ApplicationError.php';

class ResultModel 
{
    public $login;
    public $email;
    public $password;
    public $textMesage;
    public $listApplicationError;
    public $hasError;

    function __construct($login, $email, $password)
    {
        $this->setLogin($login);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->listApplicationError = [];
    }
    
    public function addError($textError, $typeError) 
    {
        $this->listApplicationError[] = 
            new ApplicationError($textError, $typeError);
    }
    
    /**
     * @return mixed
     */
    public function getHasError()
    {
        return $this->hasError;
    }
    
    /**
     * @return mixed
     */
    public function getTextMesage()
    {
        return $this->textMesage;
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
     * @param mixed $textMesage
     */
    public function setTextMessage($textMesage)
    {
        $this->textMesage = $textMesage;
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

    /**
     * @param mixed $hasError
     */
    public function setHasError($hasError)
    {
        $this->hasError = $hasError;
    }


}
