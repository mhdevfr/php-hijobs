<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="assets/css/shadcn-theme.css"/>
<div class="z-0 mr-12 w-full pb-12 h-full mb-12 shadcn-card flex lg:flex-row flex-col-reverse bg-gray-100 justify-center items-center fade-in">
    
    <div class="lg:w-1/2 w-5/6 h-full flex flex-col justify-start p-4 items-start">
        
        <h1 class="text-4xl w-full text-bold police-1 mb-6 mt-6">Postez une annonce</h1>
        
            <form action="index.php?section=addAnnoncePro" class="w-full" method="post">
                <div class="w-full flex flex-col lg:items-start items-center justify-center text-center">
                    <input type="text" name="titreAnnonce" class="shadcn-input lg:w-96 w-full mb-5" placeholder="Titre">
                    <input type="text" name="intitEntreprise" class="lg:w-96 w-full mb-5 p-2 h-11 border-2 border-gray-400 rounded-lg outline-none"  
                    value=<?php echo $_SESSION['nomEntreprise'] ?>
                    placeholder="Nom de l'entreprise">
                    <input type="text" name="localisation" class="shadcn-input lg:w-96 w-full mb-5" placeholder="Localisation">
                    <select name="typeContrat" class="shadcn-select lg:w-96 mb-5 w-full">
                    <?php foreach ($typedecontrat as $typeContrat) { ?>
                        <option value="<?php echo $typeContrat['IntituleContrat']; ?>">
                            <?php echo $typeContrat['IntituleContrat']; ?>
                        </option>
                    <?php } ?>
                </select>
                    <textarea name="descriptionAnnonce" class="shadcn-input lg:w-96 w-full mb-5 h-28" placeholder="Description"></textarea>
                </div>

                <input type="submit" value="Publier" class="shadcn-button lg:w-96 w-full">
            </form>
        
        
    </div>
    
    <div class="flex lg:w-3/6 bg-gray-100 h-full flex-col rounded-2xl p-6 ">
    <div class="flex flex-col text-gray-950 shadcn-card py-6 h-full items-center justify-center slide-up" style="background-color: white;">
        <?php
        foreach ($professionelle as $pro) { ?>
            <h1 class="text-4xl text-bold police-1 mb-6">Information du profil</h1>
            <p placeholder="Nom de l'entreprise" class="police-2">Nom Entreprise : <?php echo $pro['NomEntreprise']; ?></p>
            <p placeholder="Code Postal" class="police-2">Code Postal : <?php echo $pro['CodePostal']; ?></p>
            <p placeholder="Ville" class="police-2">Ville : <?php echo $pro['Ville']; ?></p>
            <p placeholder="Adresse de l'entreprise" class="police-2">Adresse entreprise :
                <?php echo $pro['AdresseEntreprise']; ?>
            </p>
            <p placeholder="Pays" class="police-2">Pays : <?php echo $pro['Pays']; ?></p>
            <p placeholder="Téléphone Pro" class="police-2">Téléphone profesionelle :
                <?php echo $pro['TelephoneEntreprise']; ?>
            </p>
            <p placeholder="Site web" class="police-2">Site Web : <?php echo $pro['SiteWeb']; ?></p>
            <p placeholder="Email Pro" class="police-2">Email profesionelle : <?php echo $pro['EmailEntreprise']; ?></p>
            <p placeholder="Numéro de Siret" class="police-2">Numéro Siret : <?php echo $pro['NumeroSiret']; ?></p>
            <p placeholder="Secteur d'activité" class="police-2">Secteur d'activité : <?php echo $pro['SecteurActivite']; ?>
            </p>
            <p placeholder="Taille de l'entreprise" s class="police-2">Taille de l'entreprise :
                <?php echo $pro['Taille']; ?></>
            <div class="mt-6">
                <button><a href="index.php?section=formModifProfilPro"
                        class="shadcn-button my-6">Modifier votre
                        profil</a></button>
                <button><a href="index.php?section=formSupprProfilPro"
                        class="shadcn-button my-6"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer votre
                        profil</a></button>
            </div>
        <?php } ?>





    </div>
</div>

</div>
    
<div class="flex lg:w-full w-full bg-gray-100 h-full text-start items-center justify-center flex-col rounded-2xl p-6">

<h1 class="text-4xl text-bold police-1 mb-6 ">Annonces publiées</h1>
<a href="index.php?section=annoncePoste" class="italic px-2 py-1 bg-orange-400 flex items-center justify-center lg:w-auto w-64 rounded-lg">Voir toute les annonces posté</a>

</div>
<style>

    textarea{
        resize: none;
    }
</style>