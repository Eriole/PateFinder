<?php

class Player
{

    protected string $username;
    protected string $mail;
    protected string $password;


    public function __construct(?array $form = [])
    {
        $this->username = trim(($form['username']));
        $this->password = trim($form['password']);
        $this->mail = trim($form['email']);
    }

    public function validate()
    {
        $errors = [];
        
        if (empty($this->username)) {
            $errors['username'] = true;
        }

        if (!filter_var(value: $this->mail, filter: FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = true;
        }

        if (empty($this->password)) {
            $errors['password'] = true;
        }
        return $errors;
    }

    // GET AND SET
    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

}