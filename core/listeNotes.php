<?php
    // require('checkSession.php');

    require('connection.php');
	$pdo_statement = $pdo->prepare("SELECT s.intitule as semestre,e.filiere,m.intitule as module,e.nom,e.prenom,note,
                                    num_etudiant,id_semestre,id_module
                                    FROM notes n,etudiants e,semestres s,modules m
                                    WHERE n.num_etudiant=e.num
                                    AND n.id_semestre=s.id
                                    AND n.id_module=m.id
                                    ORDER BY s.intitule,e.filiere,m.intitule,e.nom,e.prenom;");
	$pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
    //var_dump($result);
?>
<table class="table">
    <thead>
        <tr>
        <th scope="col">Semestre</th>
        <th scope="col">Filière</th>
        <th scope="col">Module</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Note</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
    <tbody>
        <tr>
            <td><?php echo $row["semestre"] ?></td>
            <td><?php echo $row["filiere"] ?></td>
            <td><?php echo $row["module"] ?></td>
            <td><?php echo $row["nom"] ?></td>
            <td><?php echo $row["prenom"] ?></td>
            <td><?php echo $row["note"] ?></td>
            <td>
                <a class="btn btn-danger" href="deleteNote.php?etudiant=<?php echo $row['num_etudiant']."&semestre=".$row["id_semestre"]."&module=".$row["id_module"] ?>" role="button">Supprimer</a>
            </td>
        </tr>
    </tbody>
    <?php
    }
    }
    ?>
</table>