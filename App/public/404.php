<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <link rel="stylesheet" href="<?= URL_ABSOLUTE."App/public/css/404.css"; ?>">
</head>
<body>
    <section class="notFound">
        <div class="img">
        <img src="https://assets.codepen.io/5647096/backToTheHomepage.png" alt="Back to the Homepage" style="height: 15vh;"/><br>
        <img src="https://assets.codepen.io/5647096/Delorean.png" alt="El Delorean, El Doc y Marti McFly" style="height: 75vh;max-width:100%;"/>
        </div>
        <div class="text">
        <h1>404</h1>
        <h2>PAGE NOT FOUND</h2>
        <h3>BACK TO HOME?</h3>
        <a href="<?= URL_BASE;?>" class="yes">YES</a>
        <a href="https://www.youtube.com/watch?v=G3AfIvJBcGo">NO</a>
        </div>
    </section>
</body>
</html>