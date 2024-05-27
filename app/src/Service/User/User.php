<?php

declare(strict_types=1);

namespace App\Service\User;

class User
{
    public int $id;
    
    public string $email;
    
    public string $password;
    
    public string $roles;
    
    public string $timestamp_register;
    
    public string $timestamp_update;
}
