<?php

class Student extends Model{
    
    function __construct()
    {
        parent::__construct('students');
    }

    public function addStudent($student){
        $this->set('name',  $student['imie']);
        $this->set('surname', $student['nazwisko']);
        $this->set('brand', $student['firma']);
        $this->set('nip', $student['nip']);
        $this->set('email', $student['email']);
        $this->set('telephone', $student['tel']);
        $this->set('id_project', $student['id_project']);
        $this->set('register_at', $student['register_at']);
        $this->save();
    }

    public function editStudent($student){
        $this->load('id', $student['id']);
        $this->set('name',  $student['name']);
        $this->set('surname', $student['surname']);
        $this->set('brand', $student['brand']);
        $this->set('nip', $student['nip']);
        $this->set('email', $student['email']);
        $this->set('telephone', $student['tel']);
        $this->save();
    }

    public function deleteStudent($studentId){
        $this->load('id', $studentId);
        $this->delete();
        //$this->close();
    }
    

    public function getStudents($projectId){
        $students = $this->getAll('id', 'id_project', $projectId);
        return $students;
    }
    public function getStudentsList($projectId){
        $students = $this->getAll('id,name,surname,brand,nip,telephone,email,id_project,register_at', 'id_project', $projectId);
        return $students;
    }


    public function getStudent($studentId){
        $student = $this->getAll('id,name,surname,brand,nip,telephone,email,id_project,register_at', 'id', $studentId);
        return $student;
    }



    /*
     * Checking functions
     */

}