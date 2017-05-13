<?php

class Projects extends Controller{

    public function index(){
        if($this->isLogin()) {
            $_SESSION['active_menu'] = 'projects';
            $this->view('user/projects');
        }
        else header("Location:Login");
    }

    public function project($projectId){
        $this->view('user/project', ['project_id' => $projectId]);
    }

    public function addProject(){
        if ((!empty($_FILES["pdf_file"])) && ($_FILES["pdf_file"] != 0))
        {
            move_uploaded_file($_FILES["pdf_file"]["tmp_name"], '../files/Szkolenie.pdf');
        }

        $model = $this->model('Project');
        $model->addProject(
            $project_details = [
                'subiect' => $_POST['subiect'],
                'date' => $_POST['date'],
                'price' => $_POST['price'],
                'localization' => $_POST['localization'],
                'capacity' => $_POST['capacity'],
                'created_date' => date("Y-m-d"),
                'status' => 1,
            ]
        );
        $this->view('user/projects',['message' => 'Dodano pomyślnie', 'message_type' => 'success']);
    }

    public function editProject($projectId){
        if ((!empty($_FILES["pdf_file"])) && ($_FILES["pdf_file"] != 0))
        {
            move_uploaded_file($_FILES["pdf_file"]["tmp_name"], '../files/Szkolenie.pdf');
        }

        if($projectId) {
            $model = $this->model('Project');
            $model->editProject(
                $project_details = [
                    'id' => $projectId,
                    'subiect' => $_POST['subiect'],
                    'date' => $_POST['date'],
                    'price' => $_POST['price'],
                    'localization' => $_POST['localization'],
                    'capacity' => $_POST['capacity'],
                ]
            );
            $this->index();
        }
    }

    public function closeProject($projectId = ''){
        if($projectId) {
            $model = $this->model('Project');
            $model->closeProject($projectId);
        }
        $this->index();
    }
    
    public function deleteProject($projectId = '')
    {
        if ($projectId) {
            $model = $this->model('Project');
            $model->deleteProject($projectId);
        }
        $this->index();
    }

    /*
     * GET functions
     */
    public function getCurrentProject(){
        $model = $this->model('Project');
        $project = $model->getCurrentProject();
        return $project;
    }

    public function getProjects(){
        $model = $this->model('Project');
        $projects = $model->getProjects();
        return $projects;
    }

    public function getProject($projectId){
        $model = $this->model('Project');
        $project = $model->getProject($projectId);
        return $project;
    }
    public function getStudentsList($projectId){
        $model = $this->model('Student');
        $students = $model->getStudentsList($projectId);
        return $students;
    }
}