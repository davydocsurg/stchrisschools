window.onscroll = () => {
    shrinkNavBar();
};

function shrinkNavBar() {
    if (
        document.body.scrollTop > 80 ||
        document.documentElement.scrollTop > 80
    ) {
        $("#navbar").css("padding", "7px 5px");
        $("#navbar").addClass("fixed-top");
        // $("#logo").style.fontSize = "25px !important";
    } else {
        $("#navbar").css("padding", "35px 10px");
        $("#navbar").removeClass("fixed-top");

        // $("#logo").style.fontSize = "35px !important";
    }
}
