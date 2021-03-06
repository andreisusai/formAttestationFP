<?php

class Certificates extends Controller
{

    public function __construct()
    {
        $this->modelCertificate = $this->model('Certificate');
    }

    public function index()
    {

        $students = $this->modelCertificate->getStudents();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "student" => trim($_POST['student']),
                "convention" => trim($_POST['convention']),
                "message" => trim($_POST['message']),
                "student_err" => '',
                "convention_err" => '',
                "message_err" => ''
            ];


            // Validate student
            if (empty($data['student'])) {
                $data['student_err'] = 'Veuillez choisir un étudiant';
            }
            // Validate convention
            if (empty($data['convention'])) {
                $data['convention_err'] = 'Convention invalide';
            }
            // Validate message
            if (empty($data['message'])) {
                $data['message_err'] = 'Veuillez écrire un message';
            }

            // Make sure errors are empty
            if (empty($data['student_err']) && empty($data['convention_err']) && empty($data['message_err'])) {

                // SUCCESS - Proceed to insert

                $studentPayload = explode(" ", $data["student"]);
                $idStudent = $studentPayload[0];
                $idConvention = $studentPayload[1];

                $data = [
                    "student" => $idStudent,
                    "convention" => $idConvention,
                    "message" => $data["message"]
                ];

                // Execute
                if ($this->modelCertificate->register($data)) {

                    // Get inserted data
                    $data = $this->modelCertificate->getCertificate();

                    $data = [
                        "certificate" => $data,
                        "student_err" => '',
                        "convention_err" => '',
                        "message_err" => '',
                        "success" => true
                    ];

                    $this->view('certificates/index', $data);
                } else {
                    die('Désolé, il semble qu\'il y ait eu une erreur');
                }
            } else {



                $students = $this->modelCertificate->getStudents();

                $data = [
                    "students" => $students,
                    "student_err" => $data['student_err'],
                    "convention_err" => $data['convention_err'],
                    "message_err" => $data['message_err'],
                    "success" => false
                ];
                // Load view
                $this->view('certificates/index', $data);
            }
        }

        $data = [
            "students" => $students,
            "student_err" => '',
            "convention_err" => '',
            "message_err" => ''
        ];

        $this->view('certificates/index', $data);
    }
}
