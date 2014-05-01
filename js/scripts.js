$(function () {
   $('.carousel').carousel({
       interval: 5000
   });

   $("#btn-send").on("click", function () {
       showContactAlert("Sending...");
       $.post("email/index.php", $("#contact-form").serialize())
         .done(function (data) {
             showContactAlert(data);
         })
         .fail(function(){
             showContactAlert("Server error");
         })
         .always(function() {
          
        });

   });

   function showContactAlert(data) {
       var $alerts = $(".form-alerts").empty();
       var $alert = $(".form-alert-template").clone();
       $alert.children(".form-alert-content").html(data);
       $alert.appendTo($alerts).removeClass("hide");
   }

   $('#printPDF').bind('click',function() {
      var thePopup = window.open( 'colpermin.pdf', "Customer Listing", "menubar=0,location=0,height=700,width=700" );
      $('#popup-content').clone().appendTo( thePopup.document.body );
      thePopup.print();
  });

 });