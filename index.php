<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title></title>
    </head>
    <body>
        <div class="main">
             <?= phpversion() ?>
                <div class="container"> 
                    <h1>Contact Manager</h1>
                    <div class="search-container">
                        <button type="submit" id="add-contact"><i class="fa fa-user-plus"></i></button>
                        <form class="search-contact-form" >
                            <input type="text" id="search-box" name="search-box" placeholder="Search.." name="search">
                            <button type="submit" id="btn-search-contact"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="add-container hide-contact-form">
                        <form class="add-contact-form" method="POST">
                            <label for="name">Name:</label>
                            <input type="text" id="first-name" name="first_name" required />

                            <label for="surname">Surname:</label>
                            <input type="text" id="last-name" name="last_name" required />

                            <label for="cell">Cell:</label>
                            <input type="text" id="mobile-number" name="mobile_number" required />

                            <label for="email">Email:</label>
                            <input type="email" id="email-address" name="email_address"  required />
                            
                            <input type="button" id="btn-submit-contact" name="btn-submit-contact" value="Submit" >
                            <input type="button" id="btn-cancel" name="btn-cancel" value="Cancel" >
                        </form>
                    </div>
                    <div class="contacts-list"></div>
                </div>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body"></div>
            </div> 
        </div>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
