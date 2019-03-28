<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>AERO</title>
</head>
    <body>
        <div class="container">
        <form style="max-width: 500px; margin: 10px auto" action="academy.php" method="POST">
            <div class="form-group">
                <label for="full_name">Имя: </label>
                <input type="text" class="form-control form-control-danger" id="inputHorizontalDnger" name="full_name"/>
            </div>
            <div class="form-group">
                <label for="phone_number">Мобильный телефон: </label>
                <input type="text" class="form-control" name="phone_number" pattern="[+]?79[0-9]{9}"/>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" class="form-control" name="email"/>
                <div class="invalid-feedback">Имя должно содержать от 6 до 20 символов</div>
            </div>
            <div class="form-group">
                <label for="birthday">Дата рождения: </label>
                <input type="date" class="form-control" name="birthday"/>
                <div class="invalid-feedback">Имя должно содержать от 6 до 20 символов</div>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий: </label>
                <textarea name="comment" class="form-control" cols="30" rows="3"></textarea>
                <div class="invalid-feedback">Имя должно содержать от 6 до 20 символов</div>
            </div>

            <div class="g-recaptcha" data-sitekey="6LewZ5oUAAAAALt1zex-31WCdNWn1jFwQwntNZNa"></div>
            <?php
            //вывод всех ошибок
            if (isset($_SESSION['errors'])) {
                $errors = $_SESSION['errors'];

                if ($errors == "ok") {
                    echo "<div class=\"alert alert-success\">Вы успешно отправили форму!</div>";
                }
                else
                    if ($errors != "") {
                        if (strpos($errors, '0') !== false)
                            echo "<div class=\"alert alert-danger\">Капча не пройдена</div>";
                        if (strpos($errors, '1') !== false)
                            echo "<div class=\"alert alert-danger\">Неверное имя</div>";
                        if (strpos($errors, '2') !== false)
                            echo "<div class=\"alert alert-danger\">Неверный телефон</div>";
                        if (strpos($errors, '3') !== false)
                            echo "<div class=\"alert alert-danger\">Неверный email</div>";
                        if (strpos($errors, '4') !== false)
                            echo "<div class=\"alert alert-danger\">Неверная дата рождения</div>";
                        if (strpos($errors, '5') !== false)
                            echo "<div class=\"alert alert-danger\">Слишком короткий комментарий</div>";
                        if (strpos($errors, '6') !== false)
                            echo "<div class=\"alert alert-danger\">Не удалось подключиться к бд</div>";
                        if (strpos($errors, '7') !== false)
                            echo "<div class=\"alert alert-danger\">Не удалось выполнить запрос</div>";
                }
                $_SESSION['errors'] = "";
            }
            ?>
            <input type="submit" value="Отправить">
        </form>
        </div>

        <script src="https://c  ode.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>
