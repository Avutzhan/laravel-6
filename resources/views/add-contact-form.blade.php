<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интеграция сайта с Битрикс 24</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' type='text/css' media='all' />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <main id="content" class="neve-main" role="main">
        <form class="crm-form">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Имя *" value="The Lookin" required>
            </div>

            <div class="form-group">
                <input type="tel" class="form-control"  name="phone"  placeholder="Телефон *" value="+70000000000" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control"  name="email"  placeholder="Email *" value="test@mail.ru" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control"  name="company"  placeholder="Компания" value="ГазпромСольСахар">
            </div>

            <div class="form-group">
                <textarea style="width: 100%;" name="description"  placeholder="Вопросы, пожелания...">One question</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </main>

    <div class="modal" tabindex="-1" role="dialog" id='th-modal'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Спасибо за заявку</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Спасибо, что потратили ваше драгоценное время и заполнили эту форму. Мы вам обязательно перезвоним, но это не точно.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Есть пара вопросиков</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.crm-form').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route("crm.add.contact")}}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        $("#th-modal").modal()
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>
</html>