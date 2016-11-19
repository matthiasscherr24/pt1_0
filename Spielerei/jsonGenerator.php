<!DOCTYPE html>
<html>
<body>

<h1 id="demo">Hallo</h1>

<?php
$book = array(
    "title" => "ProjectTogether",
    "author" => "David Flanagan",
);
?>
<script type="text/javascript">
    var book = <?php echo json_encode($book, JSON_PRETTY_PRINT) ?>;
    /* var book = {
     "title": "JavaScript: The Definitive Guide",
     "author": "David Flanagan",
     "edition": 6
     }; */

    document.getElementById('demo').innerHTML =book.title;
</script>

</body>
<html

