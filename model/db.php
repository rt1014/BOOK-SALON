<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/BOOK SALON/conf/const.php');

function db_connect(){
    try{
        $dbh = new PDO(DSN, DB_USER, DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }catch(PDOException $e) {
        exit('接続できませんでした。理由：' . $e->getMessage());
    }
    return $dbh;
}

function fetch_query($db, $sql){
    try{
      $statement = $db->prepare($sql);
      $statement->execute();
      return $statement->fetch();
    }catch(PDOException $e){
      $errors[] = 'データ取得に失敗しました。';
    }
  }

  function fetch_all_query($db, $sql){
    try{
      $statement = $db->prepare($sql);
      $statement->execute();
      return $statement->fetchAll();
    }catch(PDOException $e){
      $errors[] = 'データ取得に失敗しました。';
    }
  }

  function execute_query($db, $sql){
    try{
        $statement = $db->prepare($sql);
        return $statement->execute();
    }catch(PDOException $e){
        $errors[] = '更新に失敗しました。';
    }
  }