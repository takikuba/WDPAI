<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Project.php';


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
            $project['time']
        );

    }

    public function addProject(Project $project): void {
        $date = new DateTime();
        $stat = $this->database->connect()->prepare('
            insert into projects (title, description, created_at, id_assigned_by, image, kcal, time)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        $assignedById = 1;
        $stat->execute([
            $project->getTitle(),
            $project->getDescription(),
            $date->format('Y-m-d'),
            $assignedById,
            $project->getImage(),
            $project->getKcal(),
            $project->getTime()
        ]);
    }

    public function getProjects() :array {
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
                $project['time']
            );
        }

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

    public function getProjectByUser(int $id): array
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM projects WHERE id_assigned_by = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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