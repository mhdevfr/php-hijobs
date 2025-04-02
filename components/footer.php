<div class="h-screen w-full flex justify-center flex-col items-end">
    <div class="h-3/4 w-full flex items-center justify-center">
        <div class="h-2/3 lg:w-4/6 w-full rounded-xl bg-gray-50 border-gray-950 text-gray-950 border-opacity-15 border">
            <h1 class=" lg:text-4xl text-2xl text-gray-950 font-serif text-center my-6">Vous avez une question ?</h1>
            <form method="post" action="https://submit-form.com/fcimsyRjr" class="flex flex-col">
                <input type="text" required name="nom" placeholder="Nom" class=" w-3/4 m-auto p-2 my-2 rounded-md">
                <input type="email" required name="email" placeholder="Email" class=" w-3/4 m-auto p-2 my-2 rounded-md">
                <textarea required name="message" placeholder="Message" class=" w-3/4 m-auto h-28 p-2 my-2 rounded-md"></textarea>
                <input type="submit" value="Envoyer" class="w-1/4 m-auto p-2 my-2 hover:bg-white hover:text-black rounded-md bg-black text-white">
            </form>
        </div>

    </div>
    <div class="h-1/4 w-full bg-black flex items-center justify-center text-center flex-col">
        <footer class="lg:w-5/6 w-full bg-black text-white h-full flex items-end justify-center text-center">
            <div class="h-full w-full lg:text-xl text-sm police-2 text-start p-4 flex justify-around">
                <ul>
                    <li><a href="#">Connexion</a></li>
                    <li><a href="#">Inscription</a></li>
                    <li><a href="#">Mon compte</a></li>
                </ul>

                <ul>
                    <li><a href="#">Voir les annonces</a></li>
                    <li><a href="#">En savoir plus sur Hijobs</a></li>
                    <li><a href="#">Retourner à l'accueil</a></li>
                </ul>

                <ul>
                    <h1>Nos réseaux :</h1>
                    <li><a href="#">Linkedin</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                </ul>
            </div>
        </footer>
        <p class="text-white mb-4">&copy; <?php echo date("Y"); ?> HiJobs. All rights reserved.</p>

    </div>
</div>
<style>
textarea {
   resize: none;
}
</style>