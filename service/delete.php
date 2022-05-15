<?php

$deleteId = $_POST['deletar'];
if(isset($deleteId)){
  try {
    $queryDelete = "DELETE FROM candidatura WHERE id='$deleteId'";
    $ExcludeCandidatura = $myslq_i->query($queryDelete);
  } catch (\Throwable $th) {
    //throw $th;
  }
}