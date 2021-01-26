<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_users_details = ud.id WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['description'],
            $user['id']
        );
    }

    public function getId(string $email){
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email; 
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (name, surname)
            VALUES (?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_users_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    public function getUsers() :array{
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_users_details = ud.id
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user){
            $result[] = new User(
                $user['email'],
                $user['password'],
                $user['name'],
                $user['surname'],
                $user['description'],
                $user['id']
            );
        }

        return $result;

    }

    public function rmUser($email){

        $stmt = $this->database->connect()->prepare('
            DELETE FROM users WHERE "email" = :email;
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

    }

}