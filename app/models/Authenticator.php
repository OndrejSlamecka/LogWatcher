<?php

use Nette\Security as NS;

class Authenticator extends Nette\Object implements NS\IAuthenticator
{

    /** @var string */
    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Performs an authentication
     * @param  array
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;

        if ($password !== $this->password) {
            throw new NS\AuthenticationException("Invalid password.", self::INVALID_CREDENTIAL);
        }
        return new NS\Identity('admin');
    }

}
