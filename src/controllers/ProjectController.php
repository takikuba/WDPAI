<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../repository/ProjectsRepository.php';

class ProjectController extends AppController {

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/upload/';

    private $messages = [];
    private $projectRepository;


    public function __construct() {

        parent::__construct();
        $this->projectRepository = new ProjectsRepository();

    }


    public function addProject()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $recipe = new Project($_POST['title'], $_POST['description'], $_FILES['file']['name']);

            $this->projectRepository->addProject($recipe);

            return $this->render("recipes", ['messages' => $this->messages, 'recipe' => $recipe]);
        }

        $this->render('add_projects', ['messages' => $this->messages]);
    }

    private function validate(array $file): bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'File is too large for destination file system';
            return false;
        }
        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'File extension is not supported!';
            return false;
        }
        return true;
    }
}