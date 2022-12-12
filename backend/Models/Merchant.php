<?php

namespace Models;

use Interfaces\DatabaseConnection;
use Interfaces\PaymentServiceProvider;

class Merchant
{
    private $table = "merchants";

    private $id;
    private $username;
    private $email;
    private $psp_name;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    private $active;

    private DatabaseConnection $db_connection;
    private PaymentServiceProvider $psp;

    public function __construct(DatabaseConnection $db_connection) {
        $this->db_connection = $db_connection;
    }

    public static function find(int $id, DatabaseConnection $db_connection) {
        $instance = new self($db_connection);
        $instance->getById($id);
        return $instance;
    }

    public function getById($id, bool $with_deleted = false) {
        $query = "select * from " . $this->table . " where id = ?";
        if (!$with_deleted) {
            $query .= " and deleted_at is null";
        }

        $stmt = $this->db_connection->getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $this->id = $result["id"];
        $this->username = $result["username"];
        $this->email = $result["email"];
        $this->psp_name = $result["psp_name"];
        $this->created_at = $result["created_at"];
        $this->updated_at = $result["updated_at"];
        $this->deleted_at = $result["deleted_at"];
        $this->active = $result["active"];

        return $this;
    }

    public function getByEmail($email, bool $with_deleted = false) {
        $query = "select * from " . $this->table . " where email = ?";
        if (!$with_deleted) {
            $query .= " and deleted_at is null";
        }

        $stmt = $this->db_connection->getConnection()->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $this->id = $result["id"];
        $this->username = $result["username"];
        $this->email = $result["email"];
        $this->psp_name = $result["psp_name"];
        $this->created_at = $result["created_at"];
        $this->updated_at = $result["updated_at"];
        $this->deleted_at = $result["deleted_at"];
        $this->active = $result["active"];

        return $this;
    }

    public function setPsp(PaymentServiceProvider $psp) {
        $this->psp = $psp;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPspName() {
        return $this->psp_name;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function getDeletedAt() {
        return $this->deleted_at;
    }

    public function getActive() {
        return $this->active;
    }

    public function getPsp() {
        return $this->psp;
    }

}
