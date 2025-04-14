<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Conteneur principal -->
    <div class="w-full h-full flex justify-center items-center flex-col" >
        <?php include "./components/navbar.php" ?>
        <!-- Conteneur du détail de l'annonce professionnel -->
        <div class="w-full my-24 h-full flex justify-center items-center">
            <?php include "./components/DetailAnnonceProComp.php" ?>
        </div>
        <?php include "./components/footer.php" ?>
    </div>
</body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
.police-1{
  font-family: "Bebas Neue", system-ui;
  font-weight: 400;
  font-style: normal;
}

.police-2{
    font-family: "Nunito", sans-serif;
  font-optical-sizing: auto;
  font-weight: weight;
  font-style: normal;
}

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
</html>
