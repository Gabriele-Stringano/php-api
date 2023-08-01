<?php

class Itinerary
{

    private $conn;
    private $TABLE_NAME = "itinerary"; // Specify the correct table name here

    // Properties
    public $Id;
    public $Country_id;
    public $Travel_id;

    private function isIdPresent()
    {
        $checkQuery = "SELECT Id FROM " . $this->TABLE_NAME . " WHERE Id = :id";
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

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {

        $query = "SELECT a.Id, a.Country_id, a.Travel_id FROM " . $this->TABLE_NAME . " a";
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
    }

    function create()
    {

        $query = "INSERT INTO
                        " . $this->TABLE_NAME . "
                    SET
                    Country_id=:country_id,
                    Travel_id=:travel_id
                    ";

        $stmt = $this->conn->prepare($query);

        $this->Country_id = htmlspecialchars(strip_tags($this->Country_id));
        $this->Travel_id = htmlspecialchars(strip_tags($this->Travel_id));

        $stmt->bindParam(":country_id", $this->Country_id);
        $stmt->bindParam(":travel_id", $this->Travel_id);

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

        if (!$this->isIdPresent()) {
            return false;
        }

        $query = "UPDATE
                    " . $this->TABLE_NAME . "
                SET
                Country_id=:country_id,
                Travel_id=:travel_id
                WHERE
                Id = :Id";

        $stmt = $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));
        $this->Country_id = htmlspecialchars(strip_tags($this->Country_id));
        $this->Travel_id = htmlspecialchars(strip_tags($this->Travel_id));

        $stmt->bindParam(":Id", $this->Id);
        $stmt->bindParam(":country_id", $this->Country_id);
        $stmt->bindParam(":travel_id", $this->Travel_id);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new PDOException("Error updating itinerary.");
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

        $query = "DELETE FROM " . $this->TABLE_NAME . " WHERE Id = ?";

        $stmt = $this->conn->prepare($query);

        $this->Id = htmlspecialchars(strip_tags($this->Id));

        $stmt->bindParam(1, $this->Id);

        try {
            if ($stmt->execute()) {
                return true;
            }
            throw new PDOException("Error updating itinerary.");
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
