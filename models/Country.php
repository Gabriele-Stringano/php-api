<?php

class Country
{

    private $conn;
    private $table_name = "country"; // Specify the correct table name here
    public $NewName;

    // Properties
    public $Id;
    public $Name;

    private function isNamePresent()
    {
        $checkQuery = "SELECT Name FROM " . $this->table_name . " WHERE Name = :Name";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":Name", $this->Name);
        $checkStmt->execute();
        $rowCount = $checkStmt->rowCount();

        if ($rowCount === 0) {
            // Record not found, return false or handle the error as needed
            return false;
        }
        return true;
    }

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // READ
    function read()
    {
        // Select all
        $query = "SELECT a.Id, a.Name FROM " . $this->table_name . " a";
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
    }

    function byTravel()
    {
        $query =
            "SELECT 
            c.Name
        FROM 
            travel t
        JOIN 
            itinerary i ON t.Id = i.Travel_id
        JOIN 
            country c ON i.Country_id = c.id
        WHERE
            t.Id=:Id
        ";

        $stmt = $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));

        // binding
        $stmt->bindParam(":Id", $this->Id);

        // execute query
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    // CREATE COUNTRY
    function create()
    {

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                 Name=:name";


        $stmt = $this->conn->prepare($query);

        // La funzione strip_tags si occupa di rimuovere i tag HTML e PHP dall'input passato
        // La funzione htmlspecialchars, processa il risultato della funzione precedente per convertire opportunamente i caratteri speciali di HTML
        $this->Name = htmlspecialchars(strip_tags($this->Name));

        // il binding, ovvero il collegamento di questi con la query SQL.
        $stmt->bindParam(":name", $this->Name);

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

    function update()
    {

        if (!$this->isNamePresent()) {
            return false;
        }

        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Name=:NewName
                WHERE
                    Name=:name";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->NewName = htmlspecialchars(strip_tags($this->NewName));

        // binding
        $stmt->bindParam(":name", $this->Name);
        $stmt->bindParam(":NewName", $this->NewName);

        // execute query
        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new PDOException("Error updating country.");
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    function delete()
    {

        if (!$this->isNamePresent()) {
            return false;
        }

        $query = "DELETE FROM " . $this->table_name . " WHERE Name = ?";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));

        // Il valore 1 in bindParam indica il primo punto interrogativo della query, dove andare a inserire il valore dell'Name.
        $stmt->bindParam(1, $this->Name);

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
