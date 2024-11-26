var animationModule = (function () {
    var $myDiv = $("#my-div");
    var $animateButton = $("#animate-button");

    function animate() {
        var randomTop = Math.floor(Math.random() * 300);
        var randomLeft = Math.floor(Math.random() * 300);
        var randomWidth = Math.floor(Math.random() * 200 + 100);
        var randomHeight = Math.floor(Math.random() * 200 + 100);

        var randomRadius = Math.floor(Math.random() * 30);
        var randomOpacity = Math.random();
        var randomColor = getRandomColor();

        $myDiv.css({
            top: randomTop + "px",
            left: randomLeft + "px",
            width: randomWidth + "px",
            height: randomHeight + "px",
            "border-radius": randomRadius + "px",
            opacity: randomOpacity,
            "background-color": randomColor,
        });

        var hexColor = rgbToHex($myDiv.css("background-color"));
        $animateButton.css("background-color", hexColor);
    }

    function getRandomColor() {
        var letters = "0123456789ABCDEF";
        var color = "#";
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;

    }

    function rgbToHex(rgb) {
        // Convert RGB color to hex format
        var matches = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
        var r = matches[1];
        var g = matches[2];
        var b = matches[3];
        var hex =
            "#" + componentToHex(r) + componentToHex(g) +
            componentToHex(b);
        return hex;
    }

    function componentToHex(c) {
        // Convert RGB component to hex format
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    return {
        animate: animate,
    };
})();

$(document).ready(function () {
    $("#animate-button").click(function () {
        animationModule.animate();
    });
});