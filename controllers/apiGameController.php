<?php

namespace controller;

include_once '.\model\apiGameModel.php';
include_once 'apiController.php';

use ApiController;
use model\ApiGameModel;

class ApiGameController extends ApiController
{

    private $companyModel;
    private $atributes;
    function __construct()
    {
        parent::__construct();
        $this->gameModel = new ApiGameModel();
        $this->atributes = ['game_ID' ,'game_name' , 'genre' , 'year' , 'score' , 'company_ID'];
    }

    function getGamesByCompany($params = []){
        $id = $params[':ID'];
        $games = $this->gameModel->getGamesandCompany($id);
        if($games)
            $this->view->response($games);
        else
            $this->view->response("No se encontró ningun juego.", 404);
    }


    function getGame($params = []) {
        $id = $params[':ID'];
        $game = $this->gameModel->getGameById($id);
        if ($game) {

            $this->view->response($game);
        } else {
            $this->view->response("No se encontró ningun juego con el ID proporcionado.", 404);
        }
    }

    function createGame($params = []) {
        $body = $this->getData();
        $game_name = $body->game_name;
        $genre = $body->genre;
        $year = $body->year;
        $score = $body->score;
        $company_ID = $body->company_ID;
        if (empty($game_name)|| empty($genre)|| empty($year)||empty($score)||empty($company_ID)) {
            $this->view->response("Complete los datos", 400);
        }
        $id = $this->gameModel->insertGame($game_name, $genre, $year, $score, $company_ID);
        $game = $this->gameModel->getGameById($id);
        $this->view->response($game , 201);
    }

    function deleteGame($params = []) {
        $id = $params[':ID'];
        $game = $this->gameModel->getGameByID($id);
        if($game) {
            $this->gameModel->deletegame($id);
            $this->view->response('El juego con id=' . $id . ' ha sido borrada.', 200);
        }
        else {
            $this->view->response('El juego con id='.$id.' no existe.', 404);}
    }

    function editGame($params = []) {
        $id = $params[':ID'];
        $body = $this->getData();
        $game_name = $body->game_name;
        $genre = $body->genre;
        $year = $body->year;
        $score = $body->score;
        $game = $this->gameModel->getGameByID($id);
        if($game || empty($game_name)|| empty($genre)|| empty($year)||empty($score)) {

            $this->gameModel->editGame($id, $game_name, $genre, $year, $score);
            $this->view->response('El juego con id='.$id.' ha sido modificada.', 200);
        }
        else {
            $this->view->response('El juego con id='.$id.' no existe.', 404);
        }
    }

    public function sanitized_column($column) {
        return in_array($column, $this->atributes);
    }


    public function getByOrderedColumn($params = null){
        if($this->sanitized_column($params[':COLUMN'])) {
            $col = $params[':COLUMN'];
            if ($params[':ORDER'] === 'asc')
                $games = $this->gameModel->gamesByOrdenAsc($col);
            else
                $games = $this->gameModel->gamesByOrdenDesc($col);
        }
        if ($games)
            $this->view->response($games, 200);
        else
            $this->view->response('No content', 204);
    }

    public function getGames() { //No permite sql injection
        try{
            $sort = $_GET['sort'] ?? "game_ID";
            $order = $_GET['order'] ?? "asc";

            if(!$this->sanitized_column($sort)||($order != "asc"&& $order!= "desc") ){
                $this->view->response("Datos erroneos", 400);
                return;
            }

            $games = $this->gameModel->gamesByOrden($sort, $order);
            if(!empty($games)){
                $this->view->response($games, 200);
            }
            else{
                $this->view->response("El juego no existe", 404);
            }
        }catch(Exception $exc){
            $this->view->response("Error interno del servidor", 500);
        }
    }

}
