<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';


class UserRepository extends Repository
{

    public function getUser(string $email) :?User {

        $stat = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $stat->bindParam(':email', $email, PDO::PARAM_STR);
        $stat->execute();

        $user = $stat->fetch(PDO::FETCH_ASSOC);

        if( $user == false) {
            throw new Exception('Not user!');
        }

        return new User (
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );

    }

}