<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacts</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="template/css/main.css">
</head>
<body>
  <div id="wrapper">
    <?php if(isset($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <div style="margin-bottom: 10px; border: 1px black solid; background: #fff;">
          <span style="color: red; padding: 25px; "><?php echo $error . '<br>'; ?></span>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
    <div class="box">
      <p class="header">Добавить контакт <span id="error2" style="color: red;"></span></p>
      <form method="post" class="add-to-contacts">
        <input type="text" name="name" placeholder="Имя">
        <input type="text" name="phone" placeholder="Телефон">
        <button type="submit" name="submit" class="button">Добавить</button>
      </form>
    </div>

    <div class="box2">
      <p class="header">Список контактов</p>
      <?php foreach ($dataFromContactList as $contact): ?>
      <div class="name" data-name="<?php echo $contact['id']?>">
        <p><?php echo $contact['name']; ?> <span><a href="/delete/<?php echo $contact['id']; ?>" class="delete-contact" data-id="<?php echo $contact['id']?>">×</a></span></p>
        <p class="contact"><?php echo $contact['phone_number']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
<script>

  var form = $("form");

  $("body").on("click", ".delete-contact", function (event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    var id = {'id': $(this).attr("data-id")};
    var iddata = $(this).attr("data-id");
    $.ajax({
      url: "/delete",
      method: "POST",
      data: id,
      success: function (data) {
        $(".name[data-name='" + iddata + "']").remove();
      },
      error: function () {
        console.log('ERROR');
      }
    });
  });

  form.submit(function(event) {
    $("#error2").html('');
    event.preventDefault();
    let name = form.find("input[name=name]").val().trim();
    let phone = form.find("input[name=phone]").val().trim();
    if (name == '') {
      console.log("Пустое имя");
      $("#error2").append("— пустое имя");
      return false;
    }
    if (phone == '') {
      $("#error2").append("— пустой телефон");
      console.log("Пустой телефон");
      return false;
    }
    $.ajax({
      url: "/create",
      method: "POST",
      data: form.serialize(),
      dataType: "json",
      success: function (data) {
        console.log("Ajax connection established");
        var newP = $("<div class='name' data-name='" + data['id'] + "'><p>" + data['name']
          + " <span><a href='' class='delete-contact' data-id='" + data['id'] + "'>×</a></span></p>"
          + "<p class='contact'>" + data['phone']
          + "</p></div>");
        $(".box2").find(".header").after(newP);
      },
      error: function () {
        console.log("Error with Ajax connection");
      }
    });
  });




</script>
</html>
