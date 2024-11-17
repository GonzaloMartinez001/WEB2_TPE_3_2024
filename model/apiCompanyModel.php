<?php

namespace model;

use PDO;

class CompanyModel
{
    private $db;

    function __construct() //instanciamos conexion con la base de datos
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname='.DB_NAME.';charset=utf8', DB_USER_NAME, DB_PASSWORD);
    }

    function getCompany() {
        $select = $this->db->prepare("SELECT * FROM company");
        $select->execute();
        $company = $select->fetchAll(PDO::FETCH_OBJ);
        return $company;
    }

    function getCompanyByID($id) {
        $select = $this->db->prepare("SELECT * FROM company WHERE company_ID = ?");
        $select->execute([$id]);
        $company = $select->fetch(PDO::FETCH_OBJ);
        return $company;
    }

    function insertCompany($companyName){
        $select= $this->db->prepare('INSERT INTO company(company_ID, company_name) VALUES (NULL,?)');
        $select->execute([$companyName]);
        return $this->db->lastInsertId();
    }

    function deleteCompany($id){
        $select = $this->db->prepare('DELETE FROM company WHERE company_ID=?');
        $select->execute([$id]);
    }

    function editCompany($company_ID, $companyName){
        $select = $this->db->prepare('UPDATE company SET company_name = ? WHERE company_ID = ?');
        $select->execute([$companyName, $company_ID]);
    }

    public function companiesByOrden($col, $order){
        $query = $this->db->prepare("SELECT * FROM company ORDER BY  ".$col." ".$order );
        $query->execute();
        $companies = $query->fetchAll(PDO::FETCH_OBJ);
        return $companies;
    }

}


