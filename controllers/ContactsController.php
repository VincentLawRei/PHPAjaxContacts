<?php

class ContactsController
{
  public function actionDelete ()
  {
    $id = $_POST['id'];
    Contacts::deleteContactById($id);
  }

  public function actionCreate ()
  {
    $name = Contacts::formSecurity($_POST['name']);
    $phone = Contacts::formSecurity($_POST['phone']);
    $ajaxOptions['name'] = $name;
    $ajaxOptions['phone'] = $phone;
    $ajaxOptions = Contacts::filterData($ajaxOptions);
    $id = Contacts::addContactAjax($ajaxOptions);
    $ajaxOptions['id'] = $id;
    echo json_encode($ajaxOptions);
  }
}

 ?>
