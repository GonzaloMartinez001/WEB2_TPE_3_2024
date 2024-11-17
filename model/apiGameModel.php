<?php

namespace model;

use PDO;

class ApiGameModel
{
    private $db;

    function __construct() //instanciamos conexion con la base de datos
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=' . DB_NAME . ';charset=utf8', DB_USER_NAME, DB_PASSWORD);
    }

    function getGames() {
        $select = $this->db->prepare("SELECT * FROM games");
        $select->execute();
        $games = $select->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }

    function getGameById($id){
        $select = $this->db->prepare("SELECT * FROM games WHERE game_ID = ?");
        $select->execute([$id]);
        $game = $select->fetch(PDO::FETCH_OBJ);
        return $game;
    }

    function getGamesandCompany($id) {
        $select = $this->db->prepare("SELECT * FROM games WHERE games.company_ID = ?;");
        $select->execute([$id]);
        $games = $select->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }

    function insertGame($gameName, $genre, $year, $score, $company) {
        $select= $this->db->prepare('INSERT INTO games (game_ID, game_name, genre, year, score, company_ID) VALUES (NULL,?,?,?,?,?)');
        $select->execute([$gameName, $genre, $year, $score, $company]);
        return $this->db->lastInsertId();
    }

    function deleteGame($id){
        $select= $this->db->prepare('DELETE FROM games WHERE game_ID=?');
        $select->execute([$id]);
    }

    function editGame($id, $gameName, $genre, $year, $score){
        $select = $this->db->prepare('UPDATE games SET game_name = ?, genre = ?, year = ?, score = ? WHERE game_ID = ?');
        $select->execute([$gameName, $genre, $year, $score, $id]);
    }



    public function gamesByOrden($col, $order){
        $query = $this->db->prepare("SELECT * FROM games ORDER BY  ".$col." ".$order );
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }

}