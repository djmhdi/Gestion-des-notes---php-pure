<?php
// require('checkSession.php');

    require('connection.php');
	$statement = $pdo->prepare("SELECT * FROM modules ORDER BY id ASC");
	$statement->execute();
    $result = $statement->fetchAll();
    // var_dump($result);
?>
<table class="table">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Intitulé</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <?php
	if(!empty($result)) { 
		foreach($result as $row) {
	?>
    <tbody>
        <tr>
        <th scope="row"><?php echo $row["id"] ?></th>
        <td><?php echo $row["intitule"] ?></td>
        <td>
            <a class="btn btn-warning" href="editModule.php?id=<?php echo $row['id']; ?>" role="button">Modifier</a>
            <a class="btn btn-danger" href="deleteModule.php?id=<?php echo $row['id']; ?>" role="button">Supprimer</a>
        </td>
        </tr>
    </tbody>
    <?php
    }
    }
    ?>
</table>