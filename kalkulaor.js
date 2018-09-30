var Kalkulatory = {
    Kalendarz: function (src) {
        w = 200;
        s = 300;
        newTop = (screen.height / 2) - (w / 2);
        newLeft = (screen.width / 2) - (s / 2);
        N = window.open(src, "", "menubar=no,resizable=no,toolbar=no,location=no,scrollbars=no,left=" + newLeft + ",top=" + newTop + ",height=" + w + ",width=" + s + "");
        N.focus();
    }
};
function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);

    } else {
        var zostalo = limitNum - limitField.value.length;
        if ((zostalo >= 5) || (zostalo == 0))
            document.getElementById('liczba').outerHTML = "<span id=liczba>zostało: " + zostalo + " znaków</span>";
        else if (zostalo == 1)
            document.getElementById('liczba').outerHTML = "<span id=liczba>został: " + zostalo + " znak</span>";
        else
            document.getElementById('liczba').outerHTML = "<span id=liczba>zostały: " + zostalo + " znaki</span>";

    }
}

function sprawdzDokladnosc(liczba) {

    liczba = liczba.toString();
    //ustawienie formatowania dla liczb w kodzie
    var wyrazenie = /^[0-9]+[\.]{0,1}[0-9]{3,20}$/;

    //jeśli ktoś podał separator całości jako kropkę
    var dotCount = (liczba.match(/\./g) || []).length;
    if (dotCount === 1) {
        if (liczba.indexOf(".") >= liczba.length - 3) {
            liczba = liczba.replace(/[\.]/g, ',');
        }
    }
    liczba = liczba.replace(/[\.]/g, '');
    liczba = liczba.replace(',', '.');

    //czyszczenie ze znaków niepasujących do liczby
    if (!wyrazenie.test(liczba)) {
        liczba = liczba.replace(/[^0-9\.]/g, "");
    }
    //obcinanie dlugości liczby
    if (liczba.length > 14) {
        liczba = liczba.slice(0, 14);
    }

    //jesli jest to liczba to ustawienie dokladnosci do 2 miejsc po przecinku
    if (wyrazenie.test(liczba)) {
        if (liczba.length > 0 && !isNaN(liczba)) {
            liczba = parseInt(liczba * 100) / 100;
        }
    }
    //ustawienie notacji dla uzytkownika
    liczba = SeparatorNotacji(liczba);
    return liczba;
}
function SeparatorNotacji(liczba) {
    //ustawienie formatowania liczby na posrednia notacje ludzka
    liczba = liczba.toString();
    liczba = liczba.replace(/[^0-9\.]/g, "");
    liczba = liczba.replace('.', ',');
    //podzial liczby na calosc i ulamek
    var czesci = liczba.split(',');
    //podzial liczby - ulamek, jesli jest to wstawia separator
    if (typeof czesci[1] != 'undefined') {
        var ulamek = ',' + czesci[1];
        if (ulamek.length == 2) {
            ulamek = ulamek + '0';
        }
    } else {
        var ulamek = ',00';
    }
    //formatowanie separatora po kropce w liczbie
    if (typeof czesci[0] != 'undefined') {
        var calosc = czesci[0];
        var licznik = czesci[0].length - 3;
        while (licznik > 0) {
            calosc = calosc.slice(0, licznik) + '.' + calosc.slice(licznik);
            licznik = licznik - 3;
        }
        //złozenie liczby
        liczba = calosc + ulamek;
        //alert(calosc);
        //alert(ulamek);
    }
    return liczba;
}
function checkSprawdzDokladnosc(element) {
    var wartosc = sprawdzDokladnosc(element.value);
    $(element).val(wartosc);
}