<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MON PROFIL</title>
  <link href="profil.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <!--permet d'utiliser les fonctions de connexion.php-->
  <?php require_once('connexion.php');
  //connexion a la BD 
  $appliDB = new Connexion();
  // recupère la valeur id par l'url 
  $personne_Id = $_GET['id'];
  // recupère la personne selectionnée
  $personne = $appliDB->selectPersonneById($personne_Id);
  // recupère la liste des relations 
  $liste_relations = $appliDB->getRelationPersonne($personne_Id);
  ?>
</head>

<body><!--Debut de la page-->
  <div class="container">
    <!--permet d'utiliser les fonctions de header.php-->
    <?php include 'header.php' ?>
    <!--afficher le profil et la liste de relations--->
    <div class="contenu">
      <div class="contenuprofil">
          <img src="<?php echo "$personne->URL_Photo" ?>" alt="photo profil">
          <?php
          echo "<table>
            <tr>
              <th>Nom</th>
              <td>$personne->Nom</td>
            </tr>
            <tr>
              <th>Prénom</th>
              <td>$personne->Prenom</td>
            </tr>
            <tr>
              <th>Statut</th>
              <td>$personne->Statut_couple</td>
            </tr>
            <tr>
              <th>Date de Naissance</th>
              <td>$personne->Date_Naissance</td>
            </tr>"; ?>
            <?php //recupère les informations sur le genre de musique de la personne 
            $allMusiquePerson = $appliDB->getPersonneMusique($personne_Id);
            $first = true;
            foreach ($allMusiquePerson as $value) {
              echo "<tr>";
              if ($first) {
                echo "<th>Style musciaux</th>";
                $first = false;
              } else {
                echo "<th></th>";
              }
              echo '<td>' . $value->Type . '</td>';
              echo '</tr>';
            }
            ?>
            <?php //recupère les informations sur le type de hobbies de la personne 
            $allHobbiesPerson = $appliDB->getPersonneHobby($personne_Id);
            $first = true;
            foreach ($allHobbiesPerson as $value) {
              echo "<tr>";
              if ($first) {
                echo "<th>Hobbies</th>";
                $first = false;
              } else {
                echo "<th></th>";
              }
              echo '<td>' . $value->Type . '</td>';
              echo '</tr>';
            }
            ?>
          </table>
          </div>
    <!--afficher la liste de relations--->
    <div class="contenulistcontact">
    <?php // boucle qui parcours la liste des relations a afficher pour le profil
    foreach ($liste_relations as $relation) {
      echo "<a href='profil.php?id=$relation->Id'>"; // le lien vers le profil dans lequel on implémente l'id de la relation
      echo "<table>";
      echo "<tr>";
      echo "<td><img src='$relation->URL_Photo 'alt=photo profil class=relationcontact></td>";
      echo "<td><h5>" . $relation->Prenom . " " . $relation->Nom . "</h5><h6>" . $relation->Type . "</h6></td>";
      echo "</tr>";
      echo "</table></a>";
    }
    ?>
    </div>
    </div><!--link vers le ficher footer.php pour le bas de page-->
    <?php include 'footer.php' ?>
  </div>
</body>
</html>
