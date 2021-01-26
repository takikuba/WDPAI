<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $description;
    private $id;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        string $description = "",
        int $id = null
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->description = $description;
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getDescription(): string {
        return $this->description;
    }

}