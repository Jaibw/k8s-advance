<?php

use Psr\Http\Message\ServerRequestInterface;

function hello_world(ServerRequestInterface $request)
{

  $message = "NA";
  $servername = "34.134.115.220";
  $username = "root";
  $password = "update_password";
  $dbname = "demo";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
     $message = $conn->connect_error;
     return $message; 
  }
   
  $data = json_decode($request->getBody(), true);
  
  switch ($data['method']) {
  case "insert":
          $sql = 'insert into messages (title, message) values ("'.$data['title'].'", "'.$data['message'].'")';
          if ($conn->query($sql) === TRUE) {
              $message= "New record created successfully";
          } else {
              $message = "Error: " . $sql . "<br>" . $conn->error;
          }
          break;
  case "list":
          $sql = 'select title,message from messages';
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $message = "";
              while($row = $result->fetch_assoc()) {
                  $message .=  "title: " . $row["title"]. " - message: " . $row["message"]. "\n";
              }
          } else 
          {
              $message = "No data found";
          }
          break;
  default:
          $message = "Invalid method";
  }

  $conn->close();

  return $message; 

}
