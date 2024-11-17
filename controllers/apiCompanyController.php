<?php

namespace controller;

include_once '.\model\apiCompanyModel.php';
include_once 'apiController.php';

use ApiController;
use model\CompanyModel;

    class ApiCompanyController extends ApiController
    {

        private $companyModel;
        private $atributes;

        function __construct() {
            parent::__construct();
            $this->companyModel = new CompanyModel();
            $this->atributes = ['company_name'];
        }

        function getCompany($params = []) {
            $id = $params[':ID'];
            $company = $this->companyModel->getCompanyByID($id);
            if ($company) {

                $this->view->response($company);
            } else {
                $this->view->response("No se encontró ninguna compañía con el ID proporcionado.", 404);
            }
        }

        function createCompany($params = []) {
            $body = $this->getData();
            $company_name = $body->company_name;
            if (empty($company_name)) {
                $this->view->response("Complete los datos", 400);
            }
            $id = $this->companyModel->insertCompany($company_name);
            $company_name = $this->companyModel->getCompany($id);
            $this->view->response($company_name , 201);
        }

        function deleteCompany($params = []) {
            $id = $params[':ID'];
            $company = $this->companyModel->getCompanyByID($id);
            if($company) {
                $this->companyModel->deleteCompany($id);
                $this->view->response('La tarea con id=' . $id . ' ha sido borrada.', 200);
            }
            else {
                    $this->view->response('La tarea con id='.$id.' no existe.', 404);}
        }

        function editCompany($params = []) {
        $id = $params[':ID'];
        $body = $this->getData();
        $company_name = $body->company_name;
        $company = $this->companyModel->getCompanyByID($id);
            if($company) {

                $this->companyModel->editCompany($id,$company_name);
                $this->view->response('La tarea con id='.$id.' ha sido modificada.', 200);
            }
            else {
                $this->view->response('La tarea con id='.$id.' no existe.', 404);
            }
        }

        public function sanitized_column($column){
            if (in_array($column, $this->atributes))
                return true;
            else
                return false;
        }

        public function getCompanies() { //No permite sql injection
            try{
                $sort = $_GET['sort'] ?? "company_ID";
                $order = $_GET['order'] ?? "asc";

                if(!$this->sanitized_column($sort)||($order != "asc"&& $order!= "desc") )
                    $this->view->response("Datos erroneos", 400);

                $companies = $this->companyModel->companiesByOrden($sort, $order);
                if(!empty($companies)){
                    $this->view->response($companies, 200);
                }
                else{
                    $this->view->response("No existe ninguna compania", 404);
                }
            }catch(Exception $exc){
                $this->view->response("Error interno del servidor", 500);
            }
        }

    }
