<?php

include "../lib/php/functions.php";

// $file = "json_notes.json";
// $data_string = file_get_contents($file);
// $data = json_decode($data_string);
// pretty_dump($data);

$notes_object = file_get_json("json_notes.json");
$users_array = file_get_json("users.json");

?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Document</title>

   <?php include "../parts/meta.php" ?>
</head>
<body>
   <header class="navbar">
      <div class="container">
         <h1>Notes</h1>
      </div>
   </header>

   <div class="container">
      <div class="card soft">
         <h2>JSON Notes</h2>

         <ul>
         <?php

         for($i=0; $i<count($notes_object->notes); $i++) {
            echo "<li>".
               $notes_object->notes[$i].
               "</li>";
         }

         ?>
         </ul>
      </div>
   </div>

   <div class="container">
      <div class="card soft">
         <h2>Users</h2>

         <ul>
         <?php

         for($i=0; $i<count($users_array); $i++) {
            echo "<li><div class='display-flex'>
            <strong class='flex-stretch'>{$users_array[$i]->name}</strong>
            <span>{$users_array[$i]->type}</span>
            </div></li>";
         }

         ?>
         </ul>
      </div>
   </div>
   
</body>
</html>