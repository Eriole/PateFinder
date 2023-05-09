<?php

class Player
{

    protected string $player_username = '';
    protected string $player_mail = '';
    protected string $player_password = '';
    protected int $player_id = 0;


    public function __construct(?array $form = [])
    {
        if (isset($form['username'])) {
            $this->player_username = trim(($form['username']));
        }
        if (isset($form['password'])) {
            $this->player_password = trim($form['password']);
        }
        if (isset($form['email'])) {
            $this->player_mail = ($form['email']);
        }

    }

    public function validate(bool $isCreate = true) :array
    {
        $errors = [];

        if (empty($this->player_username)) {
            $errors['username'] = true;
        }

        if ($isCreate && !filter_var(value: $this->player_mail, filter: FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = true;
        }

        if (empty($this->player_password)) {
            $errors['password'] = true;
        }
        return $errors;
    }

    // GET AND SET
    public function getUsername(): string
    {
        return $this->player_username;
    }

    public function setUsername(string $username): self
    {
        $this->player_username = $username;
        return $this;
    }

    public function getMail(): string
    {
        return $this->player_mail;
    }

    public function setMail(string $mail): self
    {
        $this->player_mail = $mail;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->player_password;
    }

    public function setPassword(string $password): self
    {
        $this->player_password = $password;
        return $this;
    }

	public function getId(): int {
		return $this->player_id;
	}
	
	public function setId(int $id): self {
		$this->player_id = $id;
		return $this;
	}
}