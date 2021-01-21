<?php

class Contacts
{
  public static function getContactList ()
  {
    $db = Db::getConnection();
    $sql = "SELECT * FROM users ORDER BY id DESC";
    $result = $db->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function deleteContactById ($id)
  {
    $db = Db::getConnection();
    $sql = "DELETE FROM users WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(":id", $id, PDO::PARAM_INT);
    return $result->execute();
  }

  public static function formSecurity ($form)
  {
    $form = htmlspecialchars($form);
    $form = trim($form);
    return $form;
  }

  public static function filterData ($data)
  {
    $data['phone'] = str_replace(' ', '', $data['phone']);
    $first = substr($data['phone'], 0, 1);
    $second = substr($data['phone'], 1, 3);
    $third = substr($data['phone'], 4, 3);
    $fourth = substr($data['phone'], 7, 4);
    $data['phone'] = $first . ' ' . $second . ' ' . $third . ' ' . $fourth;
    return $data;
  }

  public static function addContact ($data)
  {
    $db = Db::getConnection();
    $sql = "INSERT INTO users (name, phone_number) VALUES (:name, :phone_number)";
    $result = $db->prepare($sql);
    $result->bindParam(":name", $data['name'], PDO::PARAM_STR);
    $result->bindParam(":phone_number", $data['phone'], PDO::PARAM_STR);
    return $result->execute();
  }

  public static function addContactAjax ($data)
  {
    $db = Db::getConnection();
    $sql = "INSERT INTO users (name, phone_number) VALUES (:name, :phone_number)";
    $result = $db->prepare($sql);
    $result->bindParam(":name", $data['name'], PDO::PARAM_STR);
    $result->bindParam(":phone_number", $data['phone'], PDO::PARAM_STR);
    $result->execute();
    $id = $db->lastInsertId();
    return $id;
  }
}

 ?>
