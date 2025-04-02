<div class="grid grid-cols-2 gap-4 z-0 ml-12 w-5/6 pb-12 h-full rounded-2xl bg-gray-100 justify-center">
    <?php foreach ($annonces as $annonce) { ?>
        <div class="py-4 hover:scale-[1.02] duration-300 shadow-2xl z-10 flex justify-center items-center bg-white rounded-2xl mx-12 mt-12 ">
            <a href="index.php?section=DetailAnnonceParti" class="w-5/6 h-full">
                <h1 class="text-4xl police-1"><?php echo $annonce['titreAnnonce']; ?></h1>
                <p class="police-2"><?php echo $annonce['villeAnnonces']; ?></p>
                <hr class="w-full border-2 border-gray-400 my-4">
                <p class="police-2"><?php echo $annonce['descriptionAnnonce']; ?></p>
                <hr class="w-full border-2 border-gray-400 my-4">
                <p class="police-2">Crée le <?php echo $annonce['created_at']; ?></p>
            </a>
        </div>
    <?php } ?>
</div>
