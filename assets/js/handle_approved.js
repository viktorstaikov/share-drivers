(function() {
    if (driver && driver.IsApproved) {
        // alert("appology approved");
        $(".apology")
            .show();
        $(".user_comment")
            .hide();
        $(".img_descr")
            .hide();
        $("#viralPic")
            .hide();

        $(".content")
            .children()
            .hide();
        $("#download")
            .show();
        $("#dln_icons")
            .show();
    }
    else {
        // alert("appology not approved");
    }
})();