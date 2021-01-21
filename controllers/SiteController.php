<?php

class SiteController
{
  public function actionIndex ()
  {
    if (isset($_POST['submit'])) {
      $errors = false;
      $name = Contacts::formSecurity($_POST['name']);
      $phone = Contacts::formSecurity($_POST['phone']);

      if ($name == '') {
        $errors[] = 'Имя должно быть заполнено';
      }

      if ($phone == '') {
        $errors[] = 'Телефон должен быть заполнен';
      }

      $data = array ();
      $data['name'] = $name;
      $data['phone'] = $phone;
      $data = Contacts::filterData($data);
      if ($errors == false) {
        Contacts::addContact($data);
        header("Location: /");
      }
    }

    $dataFromContactList = array ();
    $dataFromContactList = Contacts::getContactList();

    // dd::dd2($dataFromContactList);
    require_once ROOT . "/views/site/index.php";
  }


}

 ?>
