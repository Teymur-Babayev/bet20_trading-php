<?php include './header.php'; ?>
<style>

    /* accordian*/
    #mg-multisidetabs .list-group-item:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    #mg-multisidetabs .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    #mg-multisidetabs .list-group{
        margin-bottom:0;
    }
    .slide-container{
        overflow:hidden;
    }
    #mg-multisidetabs .list-sub{
        display:none;
    }
    #mg-multisidetabs .panel{
        margin-bottom:0;
    }

    #mg-multisidetabs .panel-body{
        padding: 0px !important;
    }
    .mg-icon{
        font-size:10px;
        line-height: 20px;
    }


    /*live*/
    .livem {
        background: #353644 !important;
        padding: 15px !important;
        border: 1px solid #535353;
        color: #FF4E4E !important;
        font-size: 17px !important;
        font-weight: bold !important;
        font-family: inherit !important;
    }
    .upcoming {
        background: #353644!important;
        padding: 15px!important;
        border: 1px solid #535353;
        color: #2BB370!important;
        font-size: 17px!important;
        font-weight: bold!important;
        font-family: inherit!important;
    }

    .first-lebal {
        background: #252837 !important;
        padding: 15px !important;
        border: 1px solid #595959;
        color: #acacac !important;
        font-size: 17px !important;
        font-weight: bold !important;
        font-family: inherit !important;
    }
    .second-lebal {
        background: #D9D9D9!important;
        padding: 12px!important;
        border: 1px solid #313D56;
        color: #4B4B4B!important;
        font-size: 15px!important;
        font-weight: bold!important;
        font-family: inherit!important;
    }

</style>
<style>
   .contact {
	background: #f4f4f4;
	padding: 23px;
} 
</style>

<section class="callaction ">






  <div class="container">

    <div class="row">

      <div class="col-lg-8 col-lg-offset-2 contact">

        <form id="contact-form" method="post" action="contact.php" role="form">

        <div class="messages"></div>

        <div class="controls">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_name">Firstname *</label>
                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_lastname">Lastname *</label>
                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_email">Email *</label>
                <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="form_phone">Phone</label>
                <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="form_message">Message *</label>
                <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-12">
              <input type="submit" class="btn btn-success btn-send" value="Send message">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="text-muted"><strong>*</strong> These fields are required.</p>
            </div>
          </div>
        </div>

        </form>

      </div>

    </div>

  </div>
</section>



<?php

    include './footer.php';

?>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min_1.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/validation/placeBet.js"></script>
<script src="js/animate.js"></script>
<script src="js/validation/validated.js"></script>

<script>
    $(function() {
  // init the validator
  // validator files are included in the download package
  // otherwise download from http://1000hz.github.io/bootstrap-validator

  $("#contact-form").validator();

  // when the form is submitted
  $("#contact-form").on("submit", function(e) {
    // if the validator does not prevent form submit
    if (!e.isDefaultPrevented()) {
      var url = "contact.php";

      // FOR CODEPEN DEMO I WILL PROVIDE THE DEMO OUTPUT HERE, download the PHP files from
      // https://bootstrapious.com/p/how-to-build-a-working-bootstrap-contact-form

      var messageAlert = "alert-success";
      var messageText =
        "Your message was sent, thank you. I will get back to you soon.";

      // let's compose Bootstrap alert box HTML
      var alertBox =
        '<div class="alert ' +
        messageAlert +
        ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
        messageText +
        "</div>";

      // If we have messageAlert and messageText
      if (messageAlert && messageText) {
        // inject the alert to .messages div in our form
        $("#contact-form").find(".messages").html(alertBox);
        // empty the form
        $("#contact-form")[0].reset();
      }

      return false;
    }
  });
});

</script>
<script type="text/javascript">



    var multisidetabs = (function () {
        var opt, parentid,
                vars = {
                    listsub: '.list-sub',
                    showclass: 'mg-show'
                },
        test = function () {
            console.log(parentid);
        },
                events = function () {
                    $(parentid).find('a').on('click', function (ev) {
                        ev.preventDefault();
                        var atag = $(this), childsub = atag.next(vars.listsub);
                        //console.log(atag.text());
                        if (childsub && opt.multipletab == true) {
                            if (childsub.hasClass(vars.showclass)) {
                                childsub.removeClass(vars.showclass).slideUp(500);
                            } else {
                                childsub.addClass(vars.showclass).slideDown(500);
                            }
                        }
                        if (childsub && opt.multipletab == false) {
                            childsub.siblings(vars.listsub).removeClass(vars.showclass).slideUp(500);
                            if (childsub.hasClass(vars.showclass)) {
                                childsub.removeClass(vars.showclass).slideUp(500);
                            } else {
                                childsub.addClass(vars.showclass).slideDown(500);
                            }
                        }


                    });
                },
                init = function (options) {//initials
                    if (options) {
                        opt = options;
                        parentid = '#' + options.id;
                        //test();
                        events();
                    } else {
                        alert('no options');
                    }
                }

        return {init: init};
    })();

    multisidetabs.init({
        "id": "mg-multisidetabs",
        "multipletab": false
    });

    // set time




</script>

<script type="text/javascript">


</script>


<?php include './chatBox.php'; ?>
</body>

</html>
