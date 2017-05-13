<?php

class Students extends Controller{

    public function index(){
        if($this->isLogin()) {
            $_SESSION['active_menu'] = 'students';
            $this->view('user/students');
        }
        else header("Location:Login");
    }

    public function student($studentId){
        $this->view('user/student', ['student_id' => $studentId]);
    }


    public function addStudent(){
        $model = $this->model('Project');
        $capacity = $model->getAttribute($_POST['szkolenie'],'capacity');
        $price = $model->getAttribute($_POST['szkolenie'],'price');
        unset($model);

        $model = $this->model('Student');
        $students = $model->getStudents($_POST['szkolenie']);
        if($students->num_rows < $capacity) {
            $model->addStudent([
                'imie' => $_POST['imie'],
                'nazwisko' => $_POST['nazwisko'],
                'firma' => $_POST['firma'],
                'nip' => $_POST['nip'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
                'id_project' => $_POST['szkolenie'],
                'register_at' => date('Y-m-d H:i:s'),
            ]);

            $this->sendRegisterMail($_POST['email'], $price);

            header("Location: ../../dziekujemy.html");
        }else{
            header("Location: ../../brakmiejsc.html");
        }
    }

    public function editStudent($studentId){
        $model = $this->model('Student');
        $model->editStudent(
            $student_details = [
                'id' => $studentId,
                'name' => $_POST['name'],
                'surname' => $_POST['surname'],
                'brand' => $_POST['brand'],
                'nip' => $_POST['nip'],
                'email' => $_POST['email'],
                'tel' => $_POST['tel'],
            ]
        );
        $this->index();
    }

    public function deleteStudent($studentId = ''){
        if ($studentId) {
            $model = $this->model('Student');
            $model->deleteStudent($studentId);
        }
        $this->index();
    }

    public function toCsv($projectId){
        $students = $this->getStudentsList($projectId);
        //headers in csv
        $csv_string = "Imie;Nazwisko;Firma;NIP;Telefon;Email\n";
        foreach ($students as $student){
            $csv_string .= $student['name'] . ";";
            $csv_string .= $student['surname'] . ";";
            $csv_string .= $student['brand'] . ";";
            $csv_string .= $student['nip'] . ";";
            $csv_string .= $student['telephone'] . ";";
            $csv_string .= $student['email'];
            $csv_string .= "\n";
        }
        header('Content-type: text/plain; charset=utf-8');
        header("Content-Disposition: attachment; filename=ListaUczestnikow.csv");
        echo $csv_string;
    }

    /*
     * GET functions
     */

    public function getStudentsList($projectId){
        $model = $this->model('Student');
        $students = $model->getStudentsList($projectId);
        return $students;
    }

    public function getStudents(){
        $model = $this->model('Student');
        $students = $model->getStudents();
        return $students;
    }

    public function getStudent($studentId){
        $model = $this->model('Student');
        $student = $model->getStudent($studentId);
        return $student;
    }

    public function getCurrentProject(){
        $model = $this->model('Project');
        $project = $model->getCurrentProject();
        return $project;
    }

    public function sendRegisterMail($email_address, $course_price){
        $message = 'Dziękujemy za wstępną rejestrację. Aby potwierdzić swój udział należy w ciągu 72h od momentu wypełnienia formularza dokonać płatności na konto organizatora w kwocie: '.$course_price.'<br>';
        $message .= '<br>K14 Kamil Rusjan<br>';
        $message .= 'Ul. Leona Kruczkowskiego 14/8<br>';
        $message .= '00-386 Warszawa<br>';
        $message .= '<br>Detusche Bank Polska: 13 1910 1048 2211 5723 1060 0001<br>';
        $message .= '<br>Tytułem: Uczestnictwo w szkoleniu D-Link<br>';
        $message .= '<br>Prosimy o zapoznanie się z informacjami przesłanymi w załączniku. Jeżeli rezygnują Państwo z uczestnictwa, prosimy o przesłanie takiej informacji w najszybszym możliwym terminie na adres wioletta.wlodarczyk@dlink.com.<br>';
        $message .= '<br>Pozdrawiamy<br>D-Link Polska';

        $this->mailer_init();
        $email = new PHPMailer();
        $email->From      = 'rejestracja@akademiadlink.pl';
        $email->FromName  = 'D-Link Polska';
        $email->CharSet = 'UTF-8';
        $email->Subject   = 'Rejestracja na szkolenie D-link';
        $email->Body      = $message;
        $email->IsHTML(true);
        $email->AddAddress( $email_address );

        $file_to_attach = '../files/Szkolenie.pdf';
        $email->AddAttachment( $file_to_attach , 'Szkolenie.pdf' );
        $email->Send();
    }
}