<?php

Class Database {

    private $host;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $result = [];

    public function __construct($hostPr, $usernamePr, $passwordPr, $dbnamePr) {
        $this->host = $hostPr;
        $this->username = $usernamePr;
        $this->password = $passwordPr;
        $this->dbname = $dbnamePr;
    }

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if (!$this->conn) {
            die('Cant connect Database');
        }
        $this->conn->set_charset('utf8');
    }

    public function disconnect() {
        $this->conn->close();
    }

    public function select($tableName, $fields = '*', $where = Null, $orderby = Null, $limit = Null, $offset = 0) {
        $sql = "SELECT $fields FROM $tableName";
        if ($where == !NULL) {
            $sql .= " WHERE $where";
        }

        if ($orderby == !NULL) {
            $sql .= " ORDER BY $orderby";
        }

        if ($limit == !NULL) {
            $sql .= " LIMIT $limit";
        }

        if ($offset != 0) {
            $sql .= " OFFSET $offset";
        }
        $send = $this->conn->query($sql);

        if ($send->num_rows == 1) {
            $this->result = $send->fetch_assoc();
        } elseif ($send->num_rows > 1) {
            while ($row = $send->fetch_assoc()) {
                array_push($this->result, $row);
            }
        } else {
            $this->result = Null;
        }
    }

    public function delete($tableName, $where) {
        $sql = "DELETE FROM `$tableName` WHERE $where";

        $result = $this->conn->query($sql);

        if ($result) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function insert($tableName, $data) {
        $sql = "INSERT INTO `$tableName`";
        $sql .="(";
        $keys = array_keys($data);
        foreach ($keys as $key => $value) {
            if ($key == count($keys) - 1) {
                $sql .= '`' . $value . '`';
            } else {
                $sql .= '`' . $value . '` ,';
            }
        }
        $values = array_values($data);
        $sql .=") VALUES (";

        foreach ($values as $key => $value) {
            if ($key == count($values) - 1) {
                $sql .= " '$value' ";
            } else {
                $sql .= " '$value' ,";
            }
        }

        $sql .=")";

        $result = $this->conn->query($sql);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update($tableName, $data, $condition) {
        $sql = "UPDATE `$tableName` SET";
        $i = 1;
        foreach ($data as $key => $value) {
            if ($i == count($data)) {
                $sql .= " $key = '$value' ";
            } else {
                $sql .= " $key = '$value' , ";
            }
            $i++;
        }
        $sql .= " WHERE $condition";

        $result = $this->conn->query($sql);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getResult() {
        return $this->result;
    }

}
