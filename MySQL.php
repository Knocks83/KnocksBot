<?php
class MySQL {
    public function __construct(string $host, string $username, string $password, string $db)
    {
        $this->db = mysqli_connect($host, $username, $password, $db);
        if (!$this->db) {
            print("Error while logging into the DB!\n");
        }
    }

    public function sendQuery($query)
    {
        return mysqli_query($this->db, $query);
    }
}
