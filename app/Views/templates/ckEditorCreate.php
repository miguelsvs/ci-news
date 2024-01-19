<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width , initial-scale=1" />

    <title>News Creator</title>

    <link rel="stylesheet" href="/ci-news/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ci-news/css/styles.css">
    <link rel="stylesheet" href="/ci-news/css/ckeditor.css" type="text/css">
    <meta name="viewport" content="width=device-width , initial-scale=1" />
    <script src="../scripts/editor/build/ckeditor.js"></script>


    <script>
      document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
              })
    </script>


