<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../Const.php';


class ProjectsRepository extends Repository
{

    public function getProject(int $id) :?Project {

        $stat = $this->database->connect()->prepare('
            SELECT * FROM public.projects WHERE id = :id
        ');
        $stat->bindParam(':id', $id, PDO::PARAM_INT);
        $stat->execute();

        $project = $stat->fetch(PDO::FETCH_ASSOC);

        if( $project == false) {
            return null;
        }

        return new Project(
            $project['title'],
            $project['description'],
            $project['image'],
            $project['kcal'],
            $project['time'],
            $project['link']
        );

    }

    public function addProject(Project $project, User $user): void {

        $date = new DateTime();
        $stat = $this->database->connect()->prepare('
            insert into projects (title, description, created_at, image, kcal, time, link, id_assigned_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stat->execute([
            $project->getTitle(),
            $project->getDescription(),
            $date->format('Y-m-d'),
            $project->getImage(),
            $project->getKcal(),
            $project->getTime(),
            $project->getLink(),
            $user->getId()
        ]);

    }

    public function getProjects() : array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            Select * from projects;
        ');
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project){
            $result[] = new Project(
                $project['title'],
                $project['description'],
                $project['image'],
                $project['kcal'],
                $project['time'],
                $projects['link'],
                $project['like'],
                $project['dislike']
            );
        }

        return $result;

    }

    public function getTopProjects() : array{
        $result = $this->getProjects();

        usort($result, function($a, $b){
            return $b->getLike() - $a->getLike();
        });

        return $result;
    }

    public function getKcalProjects() : array{
        $result = $this->getProjects();

        usort($result, function($a, $b){
            return $b->getKcal() - $a->getKcal();
        });

        return $result;
    }

    public function getTimeProjects() : array{
        $result = $this->getProjects();

        usort($result, function($a, $b){
            return $b->getTime() - $a->getTime();
        });

        return $result;
    }

    public function getProjectByTitle(string $searchString): array
    {
        $searchString = '%' . strtolower($searchString) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM projects WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getProjectByUser(User $user): array {
        $result = [];
        $id = $user->getId();

        $stmt = $this->database->connect()->prepare('
            Select * from projects WHERE id_assigned_by = :id;
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($projects as $project){
            $result[] = new Project(
                $project['title'],
                $project['description'],
                $project['image'],
                $project['kcal'],
                $project['time'],
                $project['like'],
                $project['dislike']
            );
        }

        return $result;
    }

    public function rmProject($title){

        $stmt = $this->database->connect()->prepare('
            DELETE FROM projects WHERE "title" = :title;
        ');
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();

    }

    public function like(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET "like" = "like" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function dislike(int $id) {
        $stmt = $this->database->connect()->prepare('
            UPDATE projects SET dislike = dislike + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}