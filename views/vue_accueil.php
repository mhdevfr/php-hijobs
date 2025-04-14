<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - HIJOBS</title>
    <link href="/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-full lg:w-full h-full flex justify-center items-center flex-col">
        <div class="w-3/4 h-full lg:w-full flex justify-center items-center flex-col">
            <?php include './components/navbar.php'; ?>
            <!-- Conteneur principal de la page d'accueil -->
            <?php include './components/heroTexte.php'; ?>
            <div class="h-full w-full flex items-center justify-center">
                <?php include './components/heroComponent.php'; ?>
                <?php  // include './components/selectAfficherContrats.php '; 
                ?>
            </div>
            <?php include './components/pricingCards.php'; ?>
            <?php include './components/heroComponent2.php'; ?>
            <?php include './components/footer.php'; ?>
        </div>
    </div>
</body>

</html>

<style lang="css">
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

    .police-1 {
        font-family: "Bebas Neue", system-ui;
        font-weight: 400;
        font-style: normal;
    }

    .police-2 {
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-weight: weight;
        font-style: normal;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>