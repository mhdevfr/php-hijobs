<?php
/* Fichier de remplacement pour detailOffreurComp.php avec un style moderne */
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
/* Styles modernes directement intégrés pour éviter les problèmes de chargement */
.modern-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1.5rem;
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
  animation: fadeIn 0.6s ease-in-out forwards;
}

.modern-card {
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
  border: 1px solid #e2e8f0;
  transition: all 0.3s ease;
  margin-bottom: 1.5rem;
  overflow: hidden;
  padding: 1.5rem;
  animation: slideUp 0.6s ease-out forwards;
}

.modern-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modern-button {
  background-color: #eab308;
  color: #1e293b;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  border: 2px solid #eab308;
  transition: all 0.2s ease;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
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
  margin-bottom: 1rem;
  font-size: 2rem;
  text-align: center;
}

.modern-divider {
  height: 2px;
  background-color: #e2e8f0;
  margin: 1rem 0;
  width: 100%;
}

.modern-badge {
  display: inline-block;
  background-color: #eab308;
  color: #1e293b;
  border-radius: 9999px;
  padding: 0.25rem 0.75rem;
  font-size: 0.75rem;
  font-weight: 500;
}

.modern-text {
  color: #64748b;
  line-height: 1.5;
  margin-bottom: 0.5rem;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideUp {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
</style>

<div class="modern-container">
    <h1 class="modern-heading">Toutes les annonces publiées</h1>
    
    <button>
        <a href="<?php echo isset($_SESSION['idParti']) ? 'index.php?section=acc-parti' : 'index.php?section=acc-off'; ?>" 
           class="modern-button">
            Retour
        </a>
    </button>
    
    <?php if (!empty($annoncePoste)): ?>
        <?php foreach ($annoncePoste as $poste): ?>
            <?php 
            $isEntreprise = isset($_SESSION['idEntreprise']);
            $isParti = isset($_SESSION['idParti']);
            
            if (($isEntreprise && $poste['idEntreprise'] == $_SESSION['idEntreprise']) ||
                ($isParti && $poste['idParti'] == $_SESSION['idParti'])):
            ?>
                <div class="modern-card">
                    <a href="" class="w-5/6 h-full">
                        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">
                            <?php 
                            if ($isEntreprise) {
                                echo htmlspecialchars($poste['titreAnnoncePro'] ?? '');
                            } else {
                                echo htmlspecialchars($poste['titreAnnonce'] ?? '');
                            }
                            ?>
                        </h2>
                        
                        <p class="modern-text">
                            <?php 
                            if ($isEntreprise) {
                                echo htmlspecialchars($poste['NomEntreprise'] ?? '');
                            } else {
                                echo htmlspecialchars(($poste['NomParti'] ?? '') . ' ' . ($poste['PrenomParti'] ?? ''));
                            }
                            ?>
                        </p>
                        
                        <p class="modern-text">
                            <?php 
                            if ($isEntreprise) {
                                echo htmlspecialchars($poste['descAnnoncePro'] ?? '');
                            } else {
                                echo htmlspecialchars($poste['descriptionParti'] ?? '');
                            }
                            ?>
                        </p>
                        
                        <?php if ($isEntreprise): ?>
                            <div class="modern-badge">
                                <p><?php echo htmlspecialchars($poste['typeContrat']); ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="modern-divider"></div>

                        <p class="modern-text">
                            <?php 
                            if ($isEntreprise) {
                                echo htmlspecialchars($poste['villeAnnoncePro'] ?? '');
                            } else {
                                echo htmlspecialchars($poste['villeAnnonceParti'] ?? '');
                            }
                            ?>
                        </p>

                        <div class="modern-divider"></div>
                        
                        <p class="modern-text">Créé le <?php echo htmlspecialchars($poste['created_at'] ?? ''); ?></p>
                        
                        <div class="modern-divider"></div>
                        
                        <div style="display: flex; justify-content: center; gap: 1rem;">
                            <a href="index.php?section=formModifAnnonce&idAnnonce=<?php echo $isEntreprise ? $poste['numAnnoncePro'] : $poste['numAnnonceParti']; ?>" 
                               class="modern-button">
                                Modifier l'annonce
                            </a>
                            
                            <form method="POST" action="index.php?section=supprimerAnnonce">
                                <input type="hidden" name="numAnnonce" 
                                       value="<?php echo $isEntreprise ? $poste['numAnnoncePro'] : $poste['numAnnonceParti']; ?>">
                                <button type="submit" name="supprimer" 
                                        class="modern-button"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                    Supprimer l'annonce
                                </button>
                            </form>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune annonce publiée.</p>
    <?php endif; ?>
</div>
