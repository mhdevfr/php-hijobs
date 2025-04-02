<div class="h-full w-96  text-white bg-gray-100 flex rounded-md items-center flex-col justify-center">
        <button class="mb-6 mt-6"><a href="index.php?section=DetailAnnonce" class="bg-yellow-500 border-2 border-yellow-500 my-6 rounded py-1 px-2">Retour</a></button>
        <form action="index.php?section=enregistrer" method="post" class="mb-6 flex flex-col h-3/4 w-1/4 rounded-xl  p-10 bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-50 border border-gray-100">
                    <div class="">
                        <div class="flex flex-col items-center text-gray-950 justify-around">
                            <h2 class="card-title text-center text-4xl text-yellow-400 my-2 police-1">Contactez-nous</h2>
                                <div class="flex flex-col items-center justify-center">
                                    <input type="text" placeholder="Nom" required class="mt-2 rounded-lg police-2 py-2 px-8 mb-2" name="lastname" pattern="[a-zA-Zà-ÿ\-\s]{2,}">
                                    <input type="text" placeholder="Prénom" required class="mt-2 rounded-lg required police-2 py-2 px-8 mb-2" name="name" pattern="[a-zA-Zà-ÿ\-\s]{2,}">  
                                    <input type="email" placeholder="monpseudo72@gmail.com" required class="mt-2 rounded-lg police-2 py-2 px-8 mb-2" name="email" pattern="[a-zA-Z0-9._\-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]{2,}$">
                                    <input type="password" placeholder="numéro de téléphone" required class="mt-2 rounded-lg police-2 py-2 mb-2 px-8" name="password" pattern="[a-zA-Z0-9à-ÿ!@#$%^&*\-_.]{12,}">
                                    <input type="password" placeholder="Déposez votre CV" required class="mt-2 police-2 rounded-lg px-8 py-2 mb-2" name="passconf" pattern="[a-zA-Z0-9à-ÿ!@#$%^&*\-_.]{12,}">                               
                               </div>
                            <input type="submit" value="Postuler" id="submit" class="px-6 py-1 mt-4 bg-yellow-400 rounded-lg police-1">
                        </div>
                    </div>
                </div>
        </form>
</div>