<?php

class Travel
{

    private $conn;
    private $table_name = "travel"; // Specify the correct table name here
    public $countryName;

    // Properties
    public $Id;
    public $AvailablePlaces;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    private function isIdPresent()
    {
        $checkQuery = "SELECT Id FROM " . $this->table_name . " WHERE Id = :id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":id", $this->Id);
        $checkStmt->execute();
        $rowCount = $checkStmt->rowCount();

        if ($rowCount === 0) {
            // Record not found, return false or handle the error as needed
            return false;
        }
        return true;
    }

    // READ
    function read()
    {
        // Select all
        $query = "SELECT a.Id, a.AvailablePlaces FROM " . $this->table_name . " a";
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
    }

    function byCountry()
    {
        $query =
            "SELECT 
            t.Id, t.AvailablePlaces
        FROM 
            " . $this->table_name . " t
        JOIN 
            itinerary i ON t.Id = i.Travel_id
        JOIN 
            country c ON i.Country_id = c.id
        WHERE
            c.Name=:countryName
            ";

        $stmt = $this->conn->prepare($query);

        $this->countryName = htmlspecialchars(strip_tags($this->countryName));

        // binding
        $stmt->bindParam(":countryName", $this->countryName);

        // execute query
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    function byAvailablePlaces()
    {
        $query =
            "SELECT 
            t.Id, t.AvailablePlaces
        FROM 
            " . $this->table_name . " t
        WHERE
            t.AvailablePlaces<=:availablePlaces
            ";

        $stmt = $this->conn->prepare($query);

        $this->AvailablePlaces = htmlspecialchars(strip_tags($this->AvailablePlaces));

        // binding
        $stmt->bindParam(":availablePlaces", $this->AvailablePlaces);

        // execute query
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    // CREATE Travel
    function create()
    {

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                AvailablePlaces=:availablePlaces";


        $stmt = $this->conn->prepare($query);

        // La funzione strip_tags si occupa di rimuovere i tag HTML e PHP dall'input passato
        // La funzione htmlspecialchars, processa il risultato della funzione precedente per convertire opportunamente i caratteri speciali di HTML
        $this->AvailablePlaces = htmlspecialchars(strip_tags($this->AvailablePlaces));

        // il binding, ovvero il collegamento di questi con la query SQL.
        $stmt->bindParam(":availablePlaces", $this->AvailablePlaces);

        // execute query
        try {
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    // update travel
    function update()
    {

        if (!$this->isIdPresent()) {
            return false;
        }

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    AvailablePlaces=:availablePlaces
                WHERE
                    Id=:id";

        $stmt = $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));
        $this->AvailablePlaces = htmlspecialchars(strip_tags($this->AvailablePlaces));

        // binding
        $stmt->bindParam(":id", $this->Id);
        $stmt->bindParam(":availablePlaces", $this->AvailablePlaces);

        // execute query
        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new PDOException("Error updating travel.");
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    function delete()
    {

        if (!$this->isIdPresent()) {
            return false;
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE Id = ?";

        $stmt = $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));

        // Il valore 1 in bindParam indica il primo punto interrogativo della query, dove andare a inserire il valore dell'Name.
        $stmt->bindParam(1, $this->Id);

        // execute query
        try {
            if ($stmt->execute()) {
                return true;
            }
            throw new PDOException("Error updating country.");
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
