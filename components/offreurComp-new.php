<?php
/* Fichier de remplacement pour offreurComp.php avec un style moderne */
?>
<style>
/* Styles modernes directement intu00e9gru00e9s */
.modern-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1.5rem;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  gap: 2rem;
  animation: fadeIn 0.6s ease-in-out forwards;
}

@media (max-width: 1024px) {
  .modern-container {
    flex-direction: column-reverse;
  }
}

.modern-card {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
  transition: all 0.3s ease;
  margin-bottom: 1.5rem;
  padding: 1.5rem;
  flex: 1;
}

.modern-form-section {
  flex: 1;
  min-width: 300px;
}

.modern-profile-section {
  flex: 1;
  min-width: 300px;
  animation: slideUp 0.6s ease-out forwards;
}

.modern-input {
  background-color: #f8fafc;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.75rem 1rem;
  width: 100%;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  color: #1e293b;
  margin-bottom: 1rem;
}

.modern-input:focus {
  outline: none;
  border-color: #eab308;
  box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.2);
}

.modern-select {
  background-color: #f8fafc;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.5rem 1rem;
  width: 100%;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  color: #1e293b;
  margin-bottom: 1rem;
}

.modern-textarea {
  background-color: #f8fafc;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.75rem 1rem;
  width: 100%;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  color: #1e293b;
  margin-bottom: 1rem;
  min-height: 120px;
  resize: none;
}

.modern-button {
  background-color: #eab308;
  color: #1e293b;
  font-weight: 500;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  border: 2px solid #eab308;
  transition: all 0.2s ease;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  width: 100%;
  text-decoration: none;
}

.modern-button:hover {
  background-color: #ca8a04;
  border-color: #ca8a04;
  transform: translateY(-2px);
}

.modern-heading {
  color: #1e293b;
  font-weight: 600;
  margin-bottom: 1.5rem;
  font-size: 2rem;
}

.profile-info {
  margin-bottom: 0.5rem;
  padding: 0.5rem 0;
  border-bottom: 1px solid #f1f5f9;
  color: #64748b;
}

.profile-actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.profile-actions .modern-button {
  flex: 1;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.announcements-section {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 2rem;
}
</style>

<div class="modern-container">
    <div class="modern-form-section">
        <h1 class="modern-heading">Postez une annonce</h1>
        
        <form action="index.php?section=addAnnoncePro" class="w-full" method="post">
            <div class="form-fields">
                <input type="text" name="titreAnnonce" class="modern-input" placeholder="Titre">
                
                <input type="text" name="intitEntreprise" class="modern-input" 
                       value="<?php echo $_SESSION['nomEntreprise'] ?>" 
                       placeholder="Nom de l'entreprise">
                
                <input type="text" name="localisation" class="modern-input" placeholder="Localisation">
                
                <select name="typeContrat" class="modern-select">
                    <?php foreach ($typedecontrat as $typeContrat) { ?>
                        <option value="<?php echo $typeContrat['IntituleContrat']; ?>">
                            <?php echo $typeContrat['IntituleContrat']; ?>
                        </option>
                    <?php } ?>
                </select>
                
                <textarea name="descriptionAnnonce" class="modern-textarea" placeholder="Description"></textarea>
            </div>

            <input type="submit" value="Publier" class="modern-button">
        </form>
    </div>
    
    <div class="modern-profile-section">
        <div class="modern-card">
            <?php foreach ($professionelle as $pro) { ?>
                <h1 class="modern-heading">Information du profil</h1>
                
                <p class="profile-info">Nom Entreprise : <?php echo $pro['NomEntreprise']; ?></p>
                <p class="profile-info">Code Postal : <?php echo $pro['CodePostal']; ?></p>
                <p class="profile-info">Ville : <?php echo $pro['Ville']; ?></p>
                <p class="profile-info">Adresse entreprise : <?php echo $pro['AdresseEntreprise']; ?></p>
                <p class="profile-info">Pays : <?php echo $pro['Pays']; ?></p>
                <p class="profile-info">Tu00e9lu00e9phone profesionelle : <?php echo $pro['TelephoneEntreprise']; ?></p>
                <p class="profile-info">Site Web : <?php echo $pro['SiteWeb']; ?></p>
                <p class="profile-info">Email profesionelle : <?php echo $pro['EmailEntreprise']; ?></p>
                <p class="profile-info">Numu00e9ro Siret : <?php echo $pro['NumeroSiret']; ?></p>
                <p class="profile-info">Secteur d'activitu00e9 : <?php echo $pro['SecteurActivite']; ?></p>
                <p class="profile-info">Taille de l'entreprise : <?php echo $pro['Taille']; ?></p>
                
                <div class="profile-actions">
                    <a href="index.php?section=formModifProfilPro" class="modern-button">Modifier votre profil</a>
                    <a href="index.php?section=formSupprProfilPro" class="modern-button"
                       onclick="return confirm('u00cates-vous su00fbr de vouloir supprimer votre compte ?')">Supprimer votre profil</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="announcements-section modern-card">
    <h1 class="modern-heading">Annonces publiu00e9es</h1>
    <a href="index.php?section=annoncePoste" class="modern-button" style="max-width: 300px;">Voir toutes les annonces postu00e9es</a>
</div>
