/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function () {
    
    var contactRules = {
        first_name: {required: true},
        last_name: {required: true},
        email_address: {required: true, email: true},
        mobile_number : {required: true, min: 10}
    };

    var contactMessages = {
        first_name: "First name is required",
        last_name: "Last name is required",
        email_address: "Email address is required",
        mobile_number: "Mobile number must be ten numbers"
    };

    $(document).on('click', '#btn-submit-contact',function (e) {

        e.preventDefault();
        $.ajax({
            url: "controllers/ContactsController.php?action=create_contact",
            type: "POST",
            data: $('.add-contact-form').serialize(),
            dataType: 'json',
            success: function (JsonObject) {
                $('.add-container').addClass('hide-contact-form');
                $('.contacts-list').removeClass('hide-contacts-list');
                $('.contacts-list').html(listContacts(JsonObject));
            }
        });
        return false;
    });
    
    $(document).on("click", "#add-contact", function (e) {
        e.stopPropagation();
        
        $(".add-contact-form").validate({
            rules: contactRules,
            messages: contactMessages,
            submitHandler: function (form) {
                form.submit();
            }
        });
        
        if($('.add-container').hasClass('hide-contact-form')){
            $('.add-container').removeClass('hide-contact-form');
            $('.contacts-list').addClass('hide-contacts-list');
        }else{
            $('.add-container').addClass('hide-contact-form');
            $('.contacts-list').removeClass('hide-contacts-list');
        }
    });
    
    $(document).on("click", "#btn-cancel", function (e) {
        e.stopPropagation();
        $('.add-container').addClass('hide-contact-form');
        $('.contacts-list').removeClass('hide-contacts-list');
    });
    
    $(document).on("click", ".update-contact", function (e) {
        e.stopPropagation();
        
        var id = $(this).attr('id');
        $.ajax({
            url: "controllers/ContactsController.php?action=select_one",
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (JsonObject) {
                var query = "id=" + id
                          + "&first_name=" + JsonObject[0]['first_name']
                          + "&last_name=" + JsonObject[0]['last_name']
                          + "&email_address=" + JsonObject[0]['email_address']
                          + "&mobile_number=" + JsonObject[0]['mobile_number'];
                $("#myModal").find('.modal-body').load("templates/dialogs/edit_contact.php?" + query, function(){
                    $("#myModal").show();
                });
            }
        });
        
        return false;  
    });
    
    $(document).on("click", "#btn-edit-contact", function (e) {
        e.stopPropagation();
        
        $(".edit-contact-form").validate({
            rules: contactRules,
            messages: contactMessages,
            submitHandler: function (form) {
                form.submit();
            }
        });
        
        $.ajax({
            url: "controllers/ContactsController.php?action=update_contact",
            type: "POST",
            data: $('.edit-contact-form').serialize(),
            dataType: 'json',
            success: function (JsonObject) {
                $("#myModal").css({display:"none"});
                $('.contacts-list').html(listContacts(JsonObject));
            }
        });
        
        return false;  
    });
    
    $(document).on("click", ".delete-contact", function (e) {
        e.stopPropagation();
        
        $.ajax({
            url: "controllers/ContactsController.php?action=delete_contact",
            type: "POST",
            data: {id: $(this).attr('id')},
            dataType: 'json',
            success: function (JsonObject) {
                $('.contacts-list').html(listContacts(JsonObject));
            }
        });
        return false;
    });
    
    $(document).on("click", ".close", function (e) {
        e.stopPropagation();
        $("#myModal").css({display:"none"});
    });
    
    function listContacts(listObject){
        
        var string = '<table>'
            + '<tr>'
            + '<th>First Name</th>'
            + '<th>Last Name</th>'
            + '<th>Email Address</th>'
            + '<th>Mobile</th>'
            + '<th style="text-align: center;" >Action</th>'
            + '</tr>';
        if(listObject.length > 0){
            for(var key in listObject) {
                string += '<tr>'
                    + '<td>' + listObject[key]['first_name'] + '</td>'
                    + '<td>' + listObject[key]['last_name'] + '</td>'
                    + '<td>' + listObject[key]['email_address'] + '</td>'
                    + '<td>' + listObject[key]['mobile_number'] + '</td>'
                    + '<td style="text-align: center;">'
                    +    '<a href="#" id="' + listObject[key]['id'] + '" class="update-contact"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;'
                    +    '<a href="#" id="' + listObject[key]['id']+ '" class="delete-contact"><i class="fa fa-remove"></i></a>'
                    +'</td>'
                +'</tr>';
            }
        } else{
             string += '<tr><td colspan="5">No Contacts</td></tr>';
        }
        string += '</table>';
        return string;
    }
    
    function loadContact(){
        $.ajax({
            url: "controllers/ContactsController.php?action=select_all_contacts",
            type: "POST",
            dataType: 'json',
            success: function (JsonObject) {
                $('.contacts-list').html(listContacts(JsonObject));
            }
        });
    }
    
    loadContact();
    
})();

