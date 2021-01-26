<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../repository/ProjectsRepository.php';
require_once __DIR__ . '/../Const.php';

class ProjectController extends AppController
{

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/upload/';

    private $message = [];
    private $projectRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->projectRepository = new ProjectsRepository();
        $this->userRepository = new UserRepository();
    }

    public function profile(){
        $this->requireLogin();

        $user = $this->userRepository->getUser($_SESSION[SESSION_KEY_USER_EMAIL]);
        $projects = $this->projectRepository->getProjectByUser($user);
        $this->render('profile', ['projects' => $projects, 'user'=>$user]);
    }

    public function getUserID(): int{
        return $this->userRepository->getUser($_SESSION[SESSION_KEY_USER_EMAIL])->getId();
    }

    public function projects()
    {
        $this->requireLogin();
        $projects = $this->projectRepository->getProjects();
        $this->render('projects', ['projects' => $projects]);
    }

    public function sortLike(){
        $this->requireLogin();
        $projects = $this->projectRepository->getTopProjects();
        $this->render('projects', ['projects' => $projects]);
    }

    public function sortKcal(){
        $this->requireLogin();
        $projects = $this->projectRepository->getKcalProjects();
        $this->render('projects', ['projects' => $projects]);
    }

    public function sortTime(){
        $this->requireLogin();
        $projects = $this->projectRepository->getTimeProjects();
        $this->render('projects', ['projects' => $projects]);
    }

    public function addProject()
    {
        $this->requireLogin();

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );
            $user = $this->userRepository->getUser($_SESSION[SESSION_KEY_USER_EMAIL]);
            $project = new Project($_POST['title'], $_POST['description'], $_FILES['file']['name'], $_POST['kcal'], $_POST['time'], $_POST['link']);
            $this->projectRepository->addProject($project, $user);

            return $this->render('projects', [
                'messages' => $this->message,
                'projects' => $this->projectRepository->getProjects()
            ]);
        }

        return $this->render('add-project', ['messages' => $this->message]);
    }

    public function removeProject(){
        $this->projectRepository->rmProject($_POST['rm']);
        $this->profile();
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->projectRepository->getProjectByTitle($decoded['search']));
        }
    }

    public function like(int $id) {
        $this->projectRepository->like($id);
        http_response_code(200);
    }

    public function dislike(int $id) {
        $this->projectRepository->dislike($id);
        http_response_code(200);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}