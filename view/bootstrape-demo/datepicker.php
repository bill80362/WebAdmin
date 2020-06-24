<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 4 DatePicker</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

<div class="form-group">
    <label >Begin voorverkoop periode</label>
    <input type="date" name="bday" max="3000-12-31"
           min="1000-01-01" class="form-control">
</div>
<div class="form-group">
    <label >Einde voorverkoop periode</label>
    <input type="date" name="bday" min="1000-01-01"
           max="3000-12-31" class="form-control">
</div>

</body>
</html>