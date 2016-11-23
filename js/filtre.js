/**
 * Created by guillaume on 22/11/2016.
 */


(function () {
    "use strict";

    var listeImage = document.querySelectorAll('.imgFiltre');

    function basculeGris() {
        for (var i = 0; i < listeImage.length; i++) {
            var uneImage = listeImage[i];
            uneImage.classList.remove('cache');
        }
        this.classList.add('cache');
    }

    for (var i = 0; i < listeImage.length; i++) {
        var uneImage = listeImage[i];
        uneImage.addEventListener("click", basculeGris);
    }

}());
