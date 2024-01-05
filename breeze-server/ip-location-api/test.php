<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Test</title>
    <style>
        section {
            width: 500px;
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
            text-align: center;
            width: 250px;
        }

        select {
            margin-bottom: 25px;
            height: 30px;
        }

        input:hover {
            border: 1px solid silver;
        }

        button {
            width: 250px;
            line-height: 20px;
        }

        #result {
            width: 1000px;
        }

        table {
            margin: 0 auto;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid gray;
        }

        th,
        td {
            padding: 5px;
        }

        th {
            background-color: whitesmoke;
        }
    </style>
</head>

<body>
    <section>
        <form action="#" id="ip-geolocation-form">
            <input type="text" placeholder="Adresse IP" name="ip-address" id="ip-address">
            <br>
            <label for="source">Source : </label>
            <select name="source" id="source">
                <option value="auto" selected>Automatique</option>
                <option value="geoplugin">GeoPlugin</option>
                <option value="ipinfo">IpInfo</option>
                <option value="ipdata">IpData</option>
            </select>
            <br>
            <button type="submit">Lancer</button>
        </form>
    </section>
    <section id="result"></section>
    <script type="text/javascript">
        (function() {

            var form = document.getElementById('ip-geolocation-form');

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                        if (xmlhttp.status == 200) {

                            var resultContainer = document.getElementById("result");

                            try {

                                const parsed = JSON.parse(xmlhttp.responseText);

                                if (typeof parsed === 'string') {

                                    resultContainer.innerHTML = parsed;

                                } else {

                                    const keys = Object.keys(parsed);

                                    const header = `<thead><tr>` + keys.map(key => `<th>${key}</th>`).join('') + `</thead></tr>`;

                                    const body = `<tbody><tr>${Object.values(parsed).map(cell => `<td>${cell}</td>`).join('')}</tr>`;

                                    const table = `<table>${header}${body}</table>`;

                                    resultContainer.innerHTML = table;

                                }

                            } catch (e) {

                                resultContainer.innerHTML = xmlhttp.responseText;

                            }

                        } else if (xmlhttp.status == 400) {
                            console.log('There was an error 400');
                        } else {
                            console.log('something else other than 200 was returned');
                            console.log(xmlhttp);
                        }
                    }
                };

                xmlhttp.open(
                    "GET",
                    window.location.protocol + '//' + window.location.hostname + "/breeze-server/ip-location-api/" +
                    document.getElementById("ip-address").value + "/" +
                    document.getElementById("source").value,
                    true
                );
                xmlhttp.setRequestHeader("X-API-Key", "b47e8c19-9e29-4287-acb1-4f34481402a0");
                xmlhttp.send();
            });

        })();
    </script>
</body>

</html>