<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Project.php';


class ProjectsRepository extends Repository
{

    public function getProject(int $id) :?Project {

        $stat = $this->database->connect()->prepare('
            SELECT * FROM projects WHERE id = :id
        ');
        $stat->bindParam(':id', $id, PDO::PARAM_INT);
        $stat->execute();

        $project = $stat->fetch(PDO::FETCH_ASSOC);

        if( $project == false) {
            throw new Exception('Not user!');
        }

        return new Project(
            $project['title'],
            $project['description'],
            $project['image']
        );

    }

    public function addProject(Project $project): void {
        $date = new DateTime();
        $stat = $this->database->connect()->prepare('
            insert into projects (title, description, created_at, id_assigned_by, image)
            VALUES (?, ?, ?, ?, ?)
        ');

        $assignedById = 1;
        $stat->execute([
            $project->getTitle(),
            $project->getDescription(),
            $date->format('Y-m-d'),
            $assignedById,
            $project->getImage(),
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
                $project['image']
            );
        }

        return $result;

    }

}