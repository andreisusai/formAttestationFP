<?php

require APPROOT . "/views/inc/header.php"; ?>
<div class="container my-1">
    <?php if ($data["success"] === true) : header("Refresh:7"); ?>
        <div class="register_success_done">
            <p class="my-1">Votre attestation a été enregistrée avec succès !</p>
            <p><strong>Nom:</strong> <?php echo $data["certificate"][0]->nomEtudiant ?></p>
            <p><strong>Convention:</strong> <?php echo $data["certificate"][0]->nomConvention ?></p>
            <p><strong>Message</strong> <?php echo $data["certificate"][0]->message ?></p>
        </div>
    <?php endif ?>
    <div class="form-content px-2">
        <h3>Formation Plus</h3>
        <span>Veuillez remplir le formulaire ci-dessous pour enregistrer une attestation</span>
        <form action="<?php echo URLROOT; ?>/certificates/index" method="post">
            <div class="form-group flex-items-columns py-1">
                <label>Étudiant:<sup>*</sup></label>
                <select name="student" id="student" onchange="getValues()" class="py-1  <?php echo (!isset($data['student_err'])) ? 'is-invalid' : '' ?>">
                    <option value="">Choisir un étudiant</option>
                    <?php for ($i = 0; $i < count($data["students"]); $i++) : ?>
                        <option value="<?php echo $data["students"][$i]->idEtudiant . " " . $data["students"][$i]->idConvention . " " . $data["students"][$i]->nbHeur ?>"><?php echo $data["students"][$i]->nomEtudiant . " " . $data["students"][$i]->prenom ?></option>
                    <?php endfor ?>
                </select>
                <span class="invalid-feedback"><?php echo $data['student_err']; ?></span>
            </div>
            <div class="form-group flex-items-columns py-1">
                <label>Convention:</label>
                <input type="text" name="convention" id="convention" class="py-1 <?php echo (!empty($data['convention_err'])) ? 'is-invalid' : ''; ?>" readonly>
                <span class="invalid-feedback"><?php echo $data['convention_err']; ?></span>
            </div>
            <div class="form-group flex-items-columns py-1">
                <label>Message:<sup>*</label>
                <textarea name="message" id="message" cols="30" rows="10" class="py-1 <?php echo (!empty($data['message_err'])) ? 'is-invalid' : ''; ?>"></textarea>
                <span class="invalid-feedback"><?php echo $data['message_err']; ?></span>
            </div>
            <div class="form-content-btn flex-items py-1">
                <div>
                    <input class="form-btn-success" type="submit" value="Enregistrer">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function getValues() {
        // Get student id, convention id and hours number
        let digits = document.getElementById('student').value;
        // Split student's value
        let studentPayload = digits.split(" ");
        // First index represent the id of the student, the second one the id of the convention and the third one hours number
        let idConvention = studentPayload[1];
        let nbHeure = studentPayload[2];

        // Get student first and last name
        let select = document.getElementById('student');
        let name = select.options[select.selectedIndex].text;

        // Inject message in textarea
        let textarea = document.getElementById('message');
        textarea.value = `
        Bonjour ${name.toUpperCase()},

        Vous avez suivi ${nbHeure}h de formation chez FormationPlus.

        Pouvez-vous nous retourner ce mail avec la pièce jointe signée.

        Cordialement,

        FormationPlus
        `
        // Check for the correspondent convention and fill inputs
        switch (idConvention) {
            case undefined:
                return (document.getElementById("convention").value = "", textarea.value = '', nbHeure = '');
            case "1":
                return (document.getElementById("convention").value = "Stage", textarea, nbHeure);
            case "2":
                return (document.getElementById("convention").value = "Contrat pro", textarea, nbHeure);
            case "3":
                return (document.getElementById("convention").value = "Alternance", textarea, nbHeure);
        }

    }
</script>