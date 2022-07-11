
<?php


class gerecht_info {

    private $connection;
    private $user;

    

    public function __construct ($connection) {
        $this->connection = $connection;
        $this->user = new user($connection);
    } 

    private function selecteerUser($user_id) {
       
        $user= $this->user->selecteerUser($user_id);
        return($user);
        
    }

    public function selectgerechtInfo ($gerecht_id, $record_type) {
       
       $sql= "SELECT * FROM gerecht_info where gerecht_id = $gerecht_id and record_type = '$record_type'";     

        $result = mysqli_query($this->connection, $sql);

        

        while($gerecht_info = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
        {

            if ($record_type == "O" || $record_type == "F") {
            $user= $this->selecteerUser($gerecht_info["user_id"]);


            // $gerecht_info[] = ["gerecht_info" => $row,
            //                     "user_info" => $user];

            $gerechtInfo[] = [
            "gerecht_info_id" => $gerecht_info ["id"],
            "record_type" => $gerecht_info ["record_type"],
            "gerecht_id" => $gerecht_info ["gerecht_id"],
            "user_id" => $user["id"],
            "datum" => $gerecht_info ["datum"],
            "nummers" => $gerecht_info ["nummeriekveld"],
            "tekst" => $gerecht_info ["tekstveld"],
            "name"=> $user ["user_name"],
            "foto" => $user ["afbeelding"],
            "email"=> $user ["email"],
            "password"=> $user ["password"]
            ];

            } else 
                {
                  $gerechtInfo[] = $gerecht_info;
                }

        }

    return($gerechtInfo);

    }

}

