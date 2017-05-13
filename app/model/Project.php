<?php

class Project extends Model{
    
    function __construct()
    {
        parent::__construct('projects');
    }

    public function addProject($project){
        $this->set('subiect',  $project['subiect']);
        $this->set('date', $project['date']);
        $this->set('price', $project['price']);
        $this->set('localization', $project['localization']);
        $this->set('capacity', $project['capacity']);
        $this->set('created_date', date("Y-m-d"));
        $this->set('status', 1);
        $this->save();
    }

    public function editProject($project){
        $this->load('id', $project['id']);
        $this->set('subiect',  $project['subiect']);
        $this->set('date', $project['date']);
        $this->set('price', $project['price']);
        $this->set('localization', $project['localization']);
        $this->set('capacity', $project['capacity']);
        $this->save();
    }

    public function getCurrentProject(){
        $this->load('status', '1');
        $info = [
            'id' => $this->get('id'),
            'subiect' => $this->get('subiect'),
            'capacity' => $this->get('capacity'),
        ];
        return $info;
    }

    public function closeProject($projectId){
        $this->load('id', $projectId);
        $this->set('close_date', date("Y-m-d"));
        $this->set('status', 0);
        $this->save();
        //$this->close();
    }

    public function deleteProject($projectId){
        $this->load('id', $projectId);
        $this->delete();
        //$this->close();
    }

    public function getProjects(){
        $projects = $this->getAll('id,subiect,date,price,localization,capacity,created_date,close_date,status');
        return $projects;
    }

    public function getProject($projectId){
        $project = $this->getAll('id,subiect,date,price,localization,capacity,created_date,close_date,status', 'id', $projectId);
        return $project;
    }

    public function getAttribute($projectId, $attribute){
        $this->load('id', $projectId);
        return $this->get($attribute);
    }

    public function getCapacity($projectId){
        $this->load('id', $projectId);
        return $this->get('capacity');
    }

    /*
     * Checking functions
     */
    public function testmodel(){
        $this->load2($attributes = ['performer' => 7, 'brand_name' => 'Prager']);
        $this->show();
    }
}