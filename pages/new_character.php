<form class="container my-5" action="" method="post">
    <fieldset>
        <legend>Nom du personnage</legend>
        <input type="text" name="name" placeholder="Nom">
    </fieldset>
    <fieldset class="my-4">
        <legend>Caractéristiques</legend>
        <label for="initiative">Initiative (max 10):</label>
        <input type="number" name="initiative">
        <div class="d-flex gap-5 w-75 justify-content-between">
            <div class="my-3 d-flex justify-content-between w-50">
                <label for="pvmax">Points de vie maximum:</label>
                <input type="number" name="pvmax">
            </div>
            <div class="my-3 d-flex justify-content-between w-50">
                <label for="pmmax">Points de magie maximum:</label>
                <input type="number" name="pmmax">
            </div>
        </div>
        <div class="d-flex gap-5 w-75">
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between">
                    <label for="force">Force (max 20) </label>
                    <input data-type="stat" type="number" name="strength" id="str">
                </li>
                <li class="my-3 d-flex justify-content-between">
                    <label for="dexterity">Dextérité (max 20) </label>
                    <input data-type="stat" type="number" name="dexterity" id="dex">
                </li>
                <li class="my-3 d-flex justify-content-between">
                    <label for="constitution">Constitution (max 20) </label>
                    <input data-type="stat" type="number" name="constitution" id="cons">
                </li>
            </ul>
            <ul class="list-unstyled w-50">
                <li class="my-3 d-flex justify-content-between">
                    <label for="intelligence">Intelligence (max 20) </label>
                    <input data-type="stat" type="number" name="intelligence" id="int">
                </li>
                <li class="my-3 d-flex justify-content-between">
                    <label for="wisdom">Sagesse (max 20) </label>
                    <input data-type="stat" type="number" name="wisdom" id="wis">
                </li>
                <li class="my-3 d-flex justify-content-between">
                    <label for="luck">Chance (max 20) </label>
                    <input data-type="stat" type="number" name="luck" id="luc">
                </li>
            </ul>
        </div>
        <p class="fw-light text-center">FOR + DEX + CONST + INT + SAG + CHA entre 60 et 80 pts. <span id="count"></span></p>
    </fieldset>
    <button class="btn btn-success" type="submit">Créer</button>
</form>