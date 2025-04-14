<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - HIJOBS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen w-full flex flex-col bg-gray-50 justify-center items-center">
    <?php include "./components/navbar.php" ?>

    <div class="h-full w-screen bg-gray-50 text-white z-0 flex items-center flex-col justify-center">
        <form action="index.php?section=enregistrer" method="post" class="flex flex-col h-auto w-1/4 rounded-xl bg-gray-100 border-gray-950 border border-opacity-15 bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-50">
            <div class="flex flex-col text-gray-950 h-full items-start justify-start p-4">
                <h2 class="text-center police-1 text-4xl text-gray-900 mb-4">Inscription</h2>
                <div class="flex flex-col items-center justify-center w-full h-full">
                    <input type="text" placeholder="Nom" required class="mt-2 my-1 police-2 rounded-lg w-full px-2 py-2 mb-2" name="lastname" pattern="[a-zA-Zà-ÿ\-\s]{2,}">
                    <input type="text" placeholder="Prénom" required class="mt-2 my-1 police-2 rounded-lg w-full px-2 py-2 mb-2" name="name" pattern="[a-zA-Zà-ÿ\-\s]{2,}">
                    <input type="email" placeholder="monpseudo72@gmail.com" required class="mt-2 my-1 police-2 rounded-lg w-full px-2 py-2 mb-2" name="email" pattern="[a-zA-Z0-9._\-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,}$">
                    <input type="password" placeholder="votremotdepasse" required class="mt-2 my-1 police-2 rounded-lg w-full px-2 py-2 mb-2" name="password" pattern="[a-zA-Z0-9à-ÿ!@#$%^&*\-_.]{12,}">
                    <input type="password" placeholder="confirmezvotremotdepasse" required class="mt-2 my-1 police-2 rounded-lg w-full px-2 py-2 mb-2" name="passconf" pattern="[a-zA-Z0-9à-ÿ!@#$%^&*\-_.]{12,}">
                    <label class="self-start police-2 my-1">Quel est votre profil ?</label>
                    <div class="flex flex-col justify-start w-full police-2 my-1">
                        <div class="flex items-center">
                            <input type="radio" name="userType" value="pro" id="pro" required class="m-2">
                            <label for="pro">Professionnel</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="userType" value="etudiant" id="etudiant" required class="m-2">
                            <label for="etudiant">Étudiant</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="userType" value="particulier" id="particulier" required class="m-2">
                            <label for="particulier">Particulier</label>
                        </div>
                    </div>
                </div>
                <p><a href="index.php?section=connecter" class="police-2 text-slate-950">Déjà un compte ?</a></p>
                <input type="submit" value="M'inscrire" id="submit" class="px-6 py-2 w-full hover:bg-gray-50 hover:text-black transition-all mt-4 bg-gray-950 text-white rounded-lg police-1">
            </div>
    </div>
    </div>
    </form>
</body>

</html>
<style>
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
        font-weight: auto;
        font-style: normal;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>