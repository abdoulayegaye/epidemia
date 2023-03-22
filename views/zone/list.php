<div class="container mt-5">

    <div class="row pt-3">
        <div class="col-9">
            <h2>Liste des zones</h2>
        </div>
        <div class="col-3"><a href="index.php?uc=zone&action=add" class='btn btn-success'><i class="fas fa-plus-circle"></i> Créer une zone</a> </div>

    </div>

    <form id="formRecherche" action="index.php?uc=zone&action=list" method="post" class="border border-primary rounded p-3 mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class='form-control' id='nom' onInput="document.getElementById('formRecherche').submit()" placehoder='Saisir le nom' name='nom' value="<?php echo $nom; ?>">
            </div>
            <div class="col">
                <select name="pays" class="form-control" onChange="document.getElementById('formRecherche').submit()">
                    <?php
                    echo "<option value='Tous'>Tous les pays</option>";
                    foreach ($lesPays as $p) {
                        $selection = $p['idP'] == $paysSel ? 'selected' : '';
                        echo "<option value='".$p['idP']."'". $selection.">".$p['nomP']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success btn-block"> Rechercher</button>
            </div>
        </div>
    </form>


    <table class="table table-hover table-striped">
        <thead>
        <tr class="d-flex">
            <th scope="col" class="col-md-1">Id</th>
            <th scope="col" class="col-md-2">Nom</th>
            <th scope="col" class="col-md-1">Nb Personnes Total</th>
            <th scope="col" class="col-md-2">Nb Personnes ayant Symptomes </th>
            <th scope="col" class="col-md-2">Nb Personnes Positives </th>
            <th scope="col" class="col-md-2">Pays</th>
            <th scope="col" class="col-md-2" colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($lesZones as $zone => $value) {
            echo "<tr class='d-flex'>";
                echo "<td class='col-md-1'>".$value['idZ']."</td>";
                echo "<td class='col-md-2'>".$value['libZone']."</td>";
                echo "<td class='col-md-1'>".$value['nbPersonnesTotal']."</td>";
                echo "<td class='col-md-2'>".$value['nbPersonnesSympt']."</td>";
                echo "<td class='col-md-2'>".$value['nbPersonnesPosi']."</td>";
                echo "<td class='col-md-2'>".$value['libPays']."</td>";
                echo "<td class='col-md-2'>
                <a href='index.php?uc=zone&action=update&id=". $value['idZ'] . "' class='btn btn-primary'><i class='fas fa-pen'></i></a>
                <a href='#modalSuppression' data-toggle='modal' data-message='Voulez vous supprimer cette zone ?' data-suppression='index.php?uc=zone&action=delete&id=".$value['idZ'] ."' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
            </td>";
            echo "</tr>";
        }

        ?>

        </tbody>
    </table>

</div>