<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translate Words</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- HTML kodlaringiz -->
    <div class="container row">
        <div class="col-8 p-5">
            <h1>Translate</h1>
            <form id="translate-form">
                <div class="language-select">
                    <select id="source-language" name="lan1">
                        <option value="uz">Tojik</option>
                        <option value="en">Ingliz</option>
                        <!-- Qo'shimcha tillarni bu yerga qo'shishingiz mumkin -->
                    </select>
                    <span title="Обратный перевод" id="swap-languages">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" style="transform: rotate(180deg);">
                            <path d="M6.99 11L3 15l3.99 4v-3H14v-2H6.99v-3zM21 9l-3.99-4v3H10v2h7.01v3L21 9z"></path>
                        </svg>
                    </span>
                    <select id="target-language" name="lan2">
                        <option value="en">Ingliz</option>
                        <option value="uz">O'zbek</option>
                        <!-- Qo'shimcha tillarni bu yerga qo'shishingiz mumkin -->
                    </select>
                </div>
                <textarea id="input-text" placeholder="Matn kiriting" name="word"></textarea>
                <button type="submit">Tarjima qilish</button>
            </form>
            <textarea id="output-text" placeholder="Tarjima natijasi" readonly><?= htmlspecialchars($result) ?></textarea>
        </div>
        <div class="col-4 img-item">
            <img src="./img/translateimg.png" alt="Default Image" class="translate-img" id="translated-image">
        </div>
    </div>

    <script src="js.js"></script>
    <script>
        $(document).ready(function() {
            $('#translate-form').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    type: 'POST',
                    url: 'translate.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#output-text').val(data.translation);
                        $('#translated-image').attr('src', data.photo_url);
                        $('#input-text').val(data.input-text);
                    }
                });
            });
        });
    </script>
</body>
</html>
