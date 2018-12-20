<?php
    //require('checkSession.php');

    require('connection.php');
	$pdo_statement = $pdo->prepare("SELECT * FROM etudiants ORDER BY num ASC");
	$pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
    //var_dump($result);
?>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Numéro</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Filière</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
    <tbody>
        <tr>
        <th scope="row"><?php echo $row["num"] ?></th>
        <td><?php echo $row["nom"] ?></td>
        <td><?php echo $row["prenom"] ?></td>
        <td><?php echo $row["filiere"] ?></td>
        <td>
            <a class="btn btn-warning" href="editEtudiant.php?id=<?php echo $row['num']; ?>" role="button">Modifier</a>
            <a class="btn btn-danger" href="deleteEtudiant.php?id=<?php echo $row['num']; ?>" role="button">Supprimer</a>
        </td>
        </tr>
    </tbody>
    <?php
    }
    }
    ?>
</table>