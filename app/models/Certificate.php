<?php

class Certificate
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStudents()
    {

        $this->db->query("SELECT 
                                etudiant.idEtudiant,
                                etudiant.nom AS nomEtudiant, 
                                etudiant.prenom, 
                                etudiant.mail, 
                                etudiant.convention, 
                                convention.idConvention, 
                                convention.nom AS nomConvention, 
                                convention.nbHeur 
                        FROM etudiant 
                        JOIN convention 
                        ON etudiant.convention = convention.idConvention");

        $result = $this->db->resultset();

        return $result;
    }

    // Add user / Register
    public function register($data)
    {

        // Prepare query
        $this->db->query("INSERT INTO attestation VALUES (NULL,:etudiant,:convention,:message)");

        // Bind values
        $this->db->bind(':etudiant', $data['student']);
        $this->db->bind(':convention', $data['convention']);
        $this->db->bind(':message', $data['message']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCertificate()
    {

        $lastIsertedId = $this->db->lastInsertId();

        $this->db->query("SELECT 
                                attestation.message, 
                                etudiant.nom AS nomEtudiant, 
                                etudiant.prenom, 
                                convention.nom AS nomConvention 
                        FROM attestation
                        JOIN etudiant 
                        ON etudiant.idEtudiant = etudiant
                        JOIN convention 
                        ON convention.idConvention = attestation.convention 
                        WHERE attestation.idAttestation = $lastIsertedId");

        $result = $this->db->resultset();

        return $result;
    }
}
