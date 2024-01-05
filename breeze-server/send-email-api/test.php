<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Test</title>
    <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        section {
            width: 1000px;
            margin: 0 auto;
            text-align: center;
            margin-bottom: 25px;
        }

        input {
            margin-top: 15px;
            margin-bottom: 15px;
            line-height: 30px;
            border: 0.5px solid silver;
            border-radius: 3px;
            text-indent: 5px;
        }

        textarea {
            border: 0.5px solid silver;
            text-indent: 5px;
        }

        select {
            margin-bottom: 25px;
            height: 30px;
        }

        input:hover {
            border: 1px solid silver;
        }

        input[type="color"] {
            height: 30px;
            margin-bottom: 0;
            margin-top: 5px;
        }

        button[type="submit"] {
            width: 250px;
            line-height: 30px;
        }

        #result {
            width: 500px;
        }

        .row {
            width: 100%;
        }

        .col-md-2 {
            width: 16%;
            display: inline-block;
        }

        .col-md-3 {
            width: 24%;
            display: inline-block;
        }

        .col-md-4 {
            width: 32%;
            display: inline-block;
        }

        .col-md-6 {
            width: 49%;
            display: inline-block;
        }

        .col-md-12 {
            width: 99%;
            display: inline-block;
        }
    </style>
</head>

<body>
    <section>
        <form action="#" id="send-email-form">
            <div class="row">
                <input type="text" placeholder="Email de l'expéditeur*" name="from" id="from" class="col-md-6" required>
                <input type="text" placeholder="Nom de l'expéditeur*" name="fromName" id="fromName" class="col-md-6" required>
            </div>
            <div class="row">
                <textarea name="recipients" id="recipients" placeholder="Email des destinataires [dest1@example.com, dest2@example.com, ...]*" cols="30" rows="2" class="col-md-12" required></textarea>
            </div>
            <div class="row">
                <input type="url" placeholder="URL Logo" name="logo_url" id="logo_url" class="col-md-4">
                <input type="text" placeholder="Alt Logo" name="logo_alt" id="logo_alt" class="col-md-4">
                <input type="number" placeholder="Largeur Logo" name="logo_width" id="logo_width" class="col-md-2" value="250" min="0">
                <input type="number" placeholder="Hauteur Logo" name="logo_height" id="logo_height" class="col-md-2" value="80" min="0">
            </div>
            <div class="row">
                <textarea name="subject" id="subject" placeholder="Sujet*" cols="30" rows="2" class="col-md-12" required></textarea>
            </div>
            <div class="row">
                <input type="text" placeholder="Titre" name="title" id="title" class="col-md-12">
            </div>
            <div class="row">
                <textarea name="content" id="content" placeholder="Contenu" cols="30" rows="5" class="col-md-12"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="button_bg_color">Arriere-plan bouton</label><br>
                    <input type="color" name="button_bg_color" value="#1b95c5" id="button_bg_color">
                </div>
                <div class="col-md-4">
                    <label for="button_text_color">Texte bouton</label><br>
                    <input type="color" name="button_text_color" value="#ffffff" id="button_text_color">
                </div>
            </div>
            <div class="row">
                <input type="url" placeholder="Lien Bouton" name="button_link" id="button_link" class="col-md-6">
                <input type="text" placeholder="Texte Bouton" name="button_text" id="button_text" class="col-md-6">
            </div>
            <div class="row">
                <textarea name="footer" id="footer" placeholder="Footer" cols="30" rows="4" class="col-md-6"></textarea>
                <textarea name="subfooter" id="subfooter" placeholder="Subfooter" cols="30" rows="4" class="col-md-6"></textarea>
            </div>
            <div class="row">
                <input type="text" placeholder="Signature" name="signature" id="signature" class="col-md-4">
                <input type="url" placeholder="Lien Copyright" name="copyright_link" id="copyright_link" class="col-md-4">
                <input type="text" placeholder="Texte Copyright" name="copyright_text" id="copyright_text" class="col-md-4">
            </div>
            <div class="row">
                <label for="template">Template : </label>
                <select name="template" id="template">
                    <option value="basic" selected>Basic</option>
                    <option value="verification">Verification</option>
                </select>
            </div>
            <div class="row">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </section>
    <section id="result"></section>
    <script type="text/javascript">
        (function() {

            var form = document.getElementById('send-email-form');
            var resultContainer = document.getElementById("result");

            form.addEventListener("submit", function(e) {

                e.preventDefault();

                var xmlhttp = new XMLHttpRequest();

                formData = new FormData(form);
                actionPath = window.location.protocol + '//' + window.location.hostname + "/breeze-server/send-email-api/";

                resultContainer.innerHTML = 'Envoi en cours...'

                xmlhttp.onreadystatechange = function() {

                    if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                        if (xmlhttp.status == 200) {

                            resultContainer.innerHTML = xmlhttp.responseText === 'true' ? 'Email envoyé avec succès!' : xmlhttp.responseText;

                        } else if (xmlhttp.status == 400) {
                            resultContainer.innerHTML = 'There was an error 400';
                        } else {
                            resultContainer.innerHTML = 'something else other than 200 was returned';
                            console.log(xmlhttp);
                        }
                    }

                };

                xmlhttp.open("POST", actionPath);
                xmlhttp.setRequestHeader("X-API-Key", "b47e8c19-9e29-4287-acb1-4f34481402a0");
                xmlhttp.send(formData);

            });

        })();
    </script>
</body>

</html>