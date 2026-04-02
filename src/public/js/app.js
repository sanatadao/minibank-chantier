/* =============================================
   MINIBANK — app.js
   Auteur : Membre 3 (Front-end)

   Ce fichier contient les 3 fonctionnalités
   JavaScript obligatoires :
   1. Confirmation avant suppression (modale)
   2. Validation des formulaires
   3. Filtre de recherche en direct
   ============================================= */


/* =============================================
   1. MODALE DE CONFIRMATION AVANT SUPPRESSION
   =============================================
   Quand on clique sur un bouton "Supprimer",
   on affiche une modale qui demande confirmation.
   Si l'utilisateur confirme → on suit le lien.
   Si non → on ferme la modale, rien ne se passe.
   ============================================= */

// On récupère les éléments de la modale dans le HTML
const modalOverlay  = document.getElementById('modal-overlay');
const modalMessage  = document.getElementById('modal-message');
const btnConfirm    = document.getElementById('btn-confirm-delete');
const btnCancel     = document.getElementById('btn-cancel-delete');

// Variable qui stocke le lien de suppression en attente
let deleteUrl = null;

/**
 * Ouvre la modale de confirmation.
 * @param {string} url  - Le lien vers lequel aller si on confirme
 * @param {string} nom  - Le nom de l'élément à supprimer (pour l'afficher)
 */
function ouvrirModaleSupprimer(url, nom) {
  deleteUrl = url;
  // On personnalise le message avec le nom de l'élément
  if (modalMessage) {
    modalMessage.textContent = 'Voulez-vous vraiment supprimer "' + nom + '" ? Cette action est irréversible.';
  }
  if (modalOverlay) {
    modalOverlay.classList.add('active');
  }
}

// Clic sur "Confirmer" → on suit le lien de suppression
if (btnConfirm) {
  btnConfirm.addEventListener('click', function () {
    if (deleteUrl) {
      window.location.href = deleteUrl;
    }
  });
}

// Clic sur "Annuler" ou sur le fond → on ferme la modale
if (btnCancel) {
  btnCancel.addEventListener('click', fermerModale);
}
if (modalOverlay) {
  modalOverlay.addEventListener('click', function (e) {
    // Ferme seulement si on clique sur le fond (pas sur la boîte)
    if (e.target === modalOverlay) {
      fermerModale();
    }
  });
}

function fermerModale() {
  if (modalOverlay) {
    modalOverlay.classList.remove('active');
  }
  deleteUrl = null;
}


/* =============================================
   2. VALIDATION DES FORMULAIRES
   =============================================
   Avant d'envoyer un formulaire, on vérifie :
   - Que les champs obligatoires ne sont pas vides
   - Que l'email a un format valide (contient @ et .)
   - Que le montant est un nombre strictement positif
   ============================================= */

/**
 * Affiche un message d'erreur sous un champ.
 * @param {HTMLElement} champ   - Le champ en erreur
 * @param {string}      message - Le texte à afficher
 */
function afficherErreur(champ, message) {
  champ.classList.add('error');
  // On cherche le span .field-error juste après le champ
  const erreurSpan = champ.parentElement.querySelector('.field-error');
  if (erreurSpan) {
    erreurSpan.textContent = message;
    erreurSpan.style.display = 'block';
  }
}

/**
 * Efface le message d'erreur d'un champ.
 * @param {HTMLElement} champ - Le champ à nettoyer
 */
function effacerErreur(champ) {
  champ.classList.remove('error');
  const erreurSpan = champ.parentElement.querySelector('.field-error');
  if (erreurSpan) {
    erreurSpan.textContent = '';
    erreurSpan.style.display = 'none';
  }
}

/**
 * Valide un formulaire client (ajout ou modification).
 * Retourne true si tout est OK, false sinon.
 */
function validerFormulaireClient(form) {
  let valide = true;

  const nom    = form.querySelector('[name="nom"]');
  const prenom = form.querySelector('[name="prenom"]');
  const email  = form.querySelector('[name="email"]');
  const ville  = form.querySelector('[name="ville"]');

  // Vérification du nom
  if (nom) {
    effacerErreur(nom);
    if (nom.value.trim() === '') {
      afficherErreur(nom, 'Le nom est obligatoire.');
      valide = false;
    }
  }

  // Vérification du prénom
  if (prenom) {
    effacerErreur(prenom);
    if (prenom.value.trim() === '') {
      afficherErreur(prenom, 'Le prénom est obligatoire.');
      valide = false;
    }
  }

  // Vérification de l'email
  if (email) {
    effacerErreur(email);
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.trim() === '') {
      afficherErreur(email, "L'email est obligatoire.");
      valide = false;
    } else if (!emailRegex.test(email.value.trim())) {
      afficherErreur(email, "L'email n'est pas valide (ex: jean@mail.com).");
      valide = false;
    }
  }

  return valide;
}

/**
 * Valide un formulaire de transaction (dépôt ou retrait).
 * Retourne true si tout est OK, false sinon.
 */
function validerFormulaireTransaction(form) {
  let valide = true;

  const montant = form.querySelector('[name="montant"]');
  const type    = form.querySelector('[name="type"]');

  // Vérification du type
  if (type) {
    effacerErreur(type);
    if (type.value === '') {
      afficherErreur(type, 'Choisissez un type (dépôt ou retrait).');
      valide = false;
    }
  }

  // Vérification du montant
  if (montant) {
    effacerErreur(montant);
    const val = parseFloat(montant.value);
    if (montant.value.trim() === '' || isNaN(val)) {
      afficherErreur(montant, 'Le montant est obligatoire.');
      valide = false;
    } else if (val <= 0) {
      afficherErreur(montant, 'Le montant doit être supérieur à 0.');
      valide = false;
    }
  }

  return valide;
}

/**
 * Valide un formulaire de création de compte.
 * Retourne true si tout est OK, false sinon.
 */
function validerFormulaireCompte(form) {
  let valide = true;

  const numero   = form.querySelector('[name="numero_compte"]');
  const clientId = form.querySelector('[name="client_id"]');

  if (numero) {
    effacerErreur(numero);
    if (numero.value.trim() === '') {
      afficherErreur(numero, 'Le numéro de compte est obligatoire.');
      valide = false;
    }
  }

  if (clientId) {
    effacerErreur(clientId);
    if (clientId.value === '' || clientId.value === '0') {
      afficherErreur(clientId, 'Veuillez sélectionner un client.');
      valide = false;
    }
  }

  return valide;
}

// On branche la validation sur tous les formulaires de la page
document.querySelectorAll('form[data-validate]').forEach(function (form) {
  form.addEventListener('submit', function (e) {
    const type = form.getAttribute('data-validate');
    let ok = true;

    if (type === 'client') {
      ok = validerFormulaireClient(form);
    } else if (type === 'transaction') {
      ok = validerFormulaireTransaction(form);
    } else if (type === 'compte') {
      ok = validerFormulaireCompte(form);
    }

    // Si la validation échoue, on bloque l'envoi du formulaire
    if (!ok) {
      e.preventDefault();
    }
  });
});


/* =============================================
   3. FILTRE DE RECHERCHE EN DIRECT
   =============================================
   Quand on tape dans le champ de recherche,
   les lignes du tableau se cachent en temps réel
   selon ce qu'on écrit — sans recharger la page.
   ============================================= */

const champRecherche = document.getElementById('search');
const tableClients   = document.getElementById('clients-table');

if (champRecherche && tableClients) {
  champRecherche.addEventListener('input', function () {
    // On met le texte recherché en minuscules pour comparer sans accent de casse
    const recherche = this.value.toLowerCase().trim();
    const lignes    = tableClients.querySelectorAll('tbody tr');

    let nbVisible = 0;

    lignes.forEach(function (ligne) {
      // On lit tout le texte de la ligne
      const texte = ligne.textContent.toLowerCase();

      if (texte.includes(recherche)) {
        ligne.style.display = '';   // on affiche la ligne
        nbVisible++;
      } else {
        ligne.style.display = 'none'; // on cache la ligne
      }
    });

    // Si aucun résultat, on affiche un message
    const emptyMsg = document.getElementById('empty-search-msg');
    if (emptyMsg) {
      emptyMsg.style.display = nbVisible === 0 ? 'block' : 'none';
    }
  });
}


/* =============================================
   BONUS — Indicateur solde retrait
   =============================================
   Sur la page transactions, quand on tape un
   montant de retrait, on affiche en temps réel
   si le solde sera suffisant après l'opération.
   ============================================= */

const champMontant  = document.querySelector('[name="montant"]');
const champType     = document.querySelector('[name="type"]');
const indicateur    = document.getElementById('solde-indicateur');
const soldeCourant  = document.getElementById('solde-courant');

if (champMontant && champType && indicateur && soldeCourant) {
  function mettreAJourIndicateur() {
    const type    = champType.value;
    const montant = parseFloat(champMontant.value) || 0;
    const solde   = parseFloat(soldeCourant.dataset.solde) || 0;

    if (type === 'retrait' && montant > 0) {
      const soldeApres = solde - montant;
      indicateur.style.display = 'block';

      if (soldeApres < 0) {
        indicateur.className = 'alert alert-error';
        indicateur.textContent = '⚠ Solde insuffisant ! Il manque ' + Math.abs(soldeApres).toFixed(2) + ' €.';
      } else {
        indicateur.className = 'alert alert-success';
        indicateur.textContent = '✓ Retrait possible. Solde après opération : ' + soldeApres.toFixed(2) + ' €.';
      }
    } else if (type === 'depot' && montant > 0) {
      const soldeApres = solde + montant;
      indicateur.style.display = 'block';
      indicateur.className = 'alert alert-success';
      indicateur.textContent = '✓ Dépôt possible. Solde après opération : ' + soldeApres.toFixed(2) + ' €.';
    } else {
      indicateur.style.display = 'none';
    }
  }

  champMontant.addEventListener('input', mettreAJourIndicateur);
  champType.addEventListener('change', mettreAJourIndicateur);
}
