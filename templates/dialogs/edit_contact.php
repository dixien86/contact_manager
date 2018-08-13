
<form class="edit-contact-form" action="" method="POST">
    <input type='hidden' name='id' value="<?= $_GET['id'] ?>" />
    
    <label for="name">Name:</label>
    <input type="text" id="first-name" name="first_name"  value="<?= $_GET['first_name'] ?>" required />

    <label for="surname">Surname:</label>
    <input type="text" id="last-name" name="last_name" value="<?= $_GET['last_name'] ?>" required />

    <label for="cell">Cell:</label>
    <input type="text" id="mobile-number" name="mobile_number" value="<?= $_GET['mobile_number'] ?>" required />

    <label for="email">Email:</label>
    <input type="email" id="email-address" name="email_address" value="<?= $_GET['email_address'] ?>" required />

    <input type="button" id="btn-edit-contact" name="btn-edit-contact" value="Submit" >
    <input type="button" id="btn-cancel" name="btn-cancel" value="Cancel" >
</form>

