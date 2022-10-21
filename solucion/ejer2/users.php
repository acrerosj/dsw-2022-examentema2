<?php
$users = [
  ["name" => "marta", "pw" => "m4rt4", "level" => "admin"],
  ["name" => "pepe", "pw" => "1234", "level" => "user"],
  ["name" => "juan", "pw" => "1111", "level" => "banned"],
  ["name" => "ana", "pw" => "1111", "level" => "user"],
];

function login($name, $pw, $users) {
  foreach($users as $user) {
    if($user['name']==$name && $user['pw']==$pw) {
      return $user['level'];
    }
  }
  return "no-login";
}
?>