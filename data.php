<?php

/*****************************************************************************
/*Copyright (C) 2016 Alex Maina Mwangi
/*****************************************************************************
(KWTRPSPACE Version 1.0), is Manuscript management information system
designed to manage manuscripts from conception to publication in peer-reviewed journals.
This program is free software; you can redistribute it and/or modify it under the terms
of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License,
or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program;
If not, see <http://www.gnu.org/licenses/>.
/*****************************************************************************
For any details please feel free to contact me at afroscholar@users.sourceforge.net
Or for snail mail. P. O. Box 71044,Nairobi-00610, East Africa-Kenya.
/*****************************************************************************/
//session_start();
function dbConnect() {
  $host = 'localhost';
  $dbname = 'kwtrpspace';
  $user = 'root';
  $pass = '';
    try {
    $con= new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
return $con;
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 

catch (PDOException $e) {
      echo 'Cannot connect to database';
      exit();
    }
  
}?>
