<!DOCTYPE html>
    <head>
        <title>Loader</title>
        <!-- loader css -->
        <link rel="stylesheet" href="../css/css_loader.css" >

         <!-- bootstrap -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


         <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Hide the loader after 3 seconds
            setTimeout(function() {
                document.querySelector('.loader2').style.display = 'none';
                document.querySelector('.content').style.display = 'block'; // Show the content
       
            }, 3000);
        });
    </script>

    </head>
    <body>
    <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="loader2"></div>
        </div>
    </body>
</html>