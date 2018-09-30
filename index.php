<?php
include 'oblicz.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["oblicz1"])) {
        //I. Ze wzgledu na okres pracy
        $odDzien_1 = $_POST["rozpoczecieZatrudnieniaDzien_1"];
        $odMiesiac_1 = $_POST["rozpoczecieZatrudnieniaMiesiac_1"];
        $odRok_1 = $_POST["rozpoczecieZatrudnieniaRok_1"];
        $doDzien_1 = $_POST["zakonczenieZatrudnieniaDzien_1"];
        $doMiesiac_1 = $_POST["zakonczenieZatrudnieniaMiesiac_1"];
        $doRok_1 = $_POST["zakonczenieZatrudnieniaRok_1"];
        $intervalMiesiac = $doMiesiac_1 - $odMiesiac_1;
        $intervalRok = $doRok_1 - $odRok_1;

        //Wymiar czasu pracy
        $wymiarCzasuPracy_1_Licznik = $_POST["wymiarCzasuPracy_1_Licznik"];
        $wymiarCzasuPracy_1_Mianownik = $_POST["wymiarCzasuPracy_1_Mianownik"];

        $oblicz_6 = new oblicz();
        $wymiarCzasuPracy_1 = $oblicz_6->ulamek($wymiarCzasuPracy_1_Licznik, $wymiarCzasuPracy_1_Mianownik);
        //Wynik
        //Liczba dni urlopu
        $wymiarRocznyUrlopu_1 = $_POST["wymiarRocznyUrlopu_1"];
        $oblicz_1 = new oblicz();
        $liczbaDniUrlopuNaOkresPracy_1 = $oblicz_1->liczbaDniUrlopuNaOkresPracy($wymiarCzasuPracy_1, $wymiarRocznyUrlopu_1, $intervalMiesiac, $intervalRok);

        //Liczba godzin urlopu
        $normaDobowaCzasuPracy_1 = $_POST["normaDobowaCzasuPracy_1"];
        $oblicz_2 = new oblicz();
        $liczbaGodzinUrlopuNaOkresPracy_1 = $oblicz_2->liczbaGodzinUrlopu($liczbaDniUrlopuNaOkresPracy_1, $normaDobowaCzasuPracy_1);

    } else if (isset($_POST["oblicz2"])) {
        //II. Ze wzgledu na przerwę w wykonywaniu pracy
        $odDzien_2 = $_POST["rozpoczecieZatrudnieniaDzien_2"];
        $odMiesiac_2 = $_POST["rozpoczecieZatrudnieniaMiesiac_2"];
        $odRok_2 = $_POST["rozpoczecieZatrudnieniaRok_2"];
        $doDzien_2 = $_POST["zakonczenieZatrudnieniaDzien_2"];
        $doMiesiac_2 = $_POST["zakonczenieZatrudnieniaMiesiac_2"];
        $doRok_2 = $_POST["zakonczenieZatrudnieniaRok_2"];
        $intervalMiesiac = $doMiesiac_2 - $odMiesiac_2;
        $intervalRok = $doRok_2 - $odRok_2;

        //Wymiar czasu pracy
        $wymiarCzasuPracy_2_Licznik = $_POST["wymiarCzasuPracy_2_Licznik"];
        $wymiarCzasuPracy_2_Mianownik = $_POST["wymiarCzasuPracy_2_Mianownik"];
        $oblicz_7 = new oblicz();
        $wymiarCzasuPracy_2 = $oblicz_7->ulamek($wymiarCzasuPracy_2_Licznik, $wymiarCzasuPracy_2_Mianownik);

        //Liczba dni urlopu I. Ze wzgledu na okres pracy
        $wymiarRocznyUrlopu_2 = $_POST["wymiarRocznyUrlopu_2"];
        $oblicz_5 = new oblicz();
        $liczbaDniUrlopuNaOkresPracy_2 = $oblicz_5->liczbaDniUrlopuNaOkresPracy($wymiarCzasuPracy_2, $wymiarRocznyUrlopu_2, $intervalMiesiac, $intervalRok);
        $normaDobowaCzasuPracy_2 = $_POST["normaDobowaCzasuPracy_2"];

        //Liczba miesięcy nieobecnośc
        $liczbaMiesiecyNieobecnosci_2_Licznik = $_POST["liczbaMiesiecyNieobecnosci_2_Licznik"];
        $liczbaMiesiecyNieobecnosci_2_Mianownik = $_POST["liczbaMiesiecyNieobecnosci_2_Mianownik"];
        $oblicz_8 = new oblicz();
        $liczbaMiesiecyNieobecnosci_2 = $oblicz_8->ulamek($liczbaMiesiecyNieobecnosci_2_Licznik, $liczbaMiesiecyNieobecnosci_2_Mianownik);

        //Liczba dni urlopu
        $oblicz_3 = new oblicz();
        $liczbaDniUrlopuZeWzgleduNaPrzerwe_2 = $oblicz_3->liczbaDniUrlopuZeWzgleduNaPrzerwe($liczbaDniUrlopuNaOkresPracy_2, $liczbaMiesiecyNieobecnosci_2, $wymiarRocznyUrlopu_2);

        //Liczba godzin urlopu
        $oblicz_4 = new oblicz();
        $liczbaGodzinUrlopuZeWzgleduNaPrzerwe_2 = $oblicz_4->liczbaGodzinUrlopu($liczbaDniUrlopuZeWzgleduNaPrzerwe_2, $normaDobowaCzasuPracy_2);
    }
}
//var_dump($wymiarCzasuPracy_1);
//var_dump($liczbaMiesiecyNieobecnosci_2); 
//var_dump($wymiarRocznyUrlopu_2); 
?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Kalkulator urlopu wypoczynkowego za część roku</title>
        <link rel="stylesheet" href="styles.css" />
        <script type="text/javascript" src="kalkulaor.js" ></script>
    </head>
    <body>
        <form name="urlopWypoczynkowy1" action="" method="post">
            <div style=" text-align: center;">
                <div style="width: 100%;">
                    <div id="kalkulator">
                        <div id="kalkulator_bl"></div><div id="kalkulator_br"></div>
                        <div id="kalkulatorNaglowek">
                            <span>Kalkulator urlopu wypoczynkowego za część roku</span>
                        </div>
                        <div id="kalkulatorFormularz">
                            <div class="formularzWiersz" style="height:120px;">
                                <div class="opisEtykieta" style="width:35%"><b>opis:</b></br><i>(dodaj krótki opis sporządzanych obliczeń)</i><br></div>
                                <div class="opisPoleEdycji" id="Textarea" style="width:65%; ">
                                    <div id="Pozostalo"  style="font-size: 10px;text-align:left;float:left;margin-bottom:0px; width: 300px;"><SPAN id="liczba">zostało: 200 znaków</SPAN></div>
                                    <textarea id="ta" style="
                                              resize: none;
                                              width:300px;
                                              height:85px; 
                                              font-family: times,serif; 
                                              font-size: 14px; 
                                              margin-top:0px;
                                              word-break: normal;
                                              overflow-y: scroll;"
                                              name="opis"
                                              onKeyDown="limitText(this, 200);"
                                              onKeyUp="limitText(this, 200);"
                                              ></textarea>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            limitText(document.getElementById('ta'), 200);
                                        });
                                    </script>
                                </div>
                            </div>
                            <!--I. Ze wzgledu na okres pracy-->
                            <div id="kalkulatorCzesc1">
                                <span><b>I. Ze wzgledu na okres pracy</b></span>
                                <div class="formularzWiersz" style="height: 70px;">
                                    <div class="wierszEtykieta">Okres zatrudnienia w bieżącym roku (od - do):</div>
                                    <div class="wierszPoleEdycji">
                                        <input name="rozpoczecieZatrudnieniaRok_1" value="<?php
                                        if (isset($_POST["rozpoczecieZatrudnieniaRok_1"])) {
                                            echo htmlentities($_POST["rozpoczecieZatrudnieniaRok_1"]);
                                        }
                                        ?>" style="width:30px;" required></input>
                                               <?php
                                               $options = array(
                                                   "Styczeń" => "01",
                                                   "Luty" => "02",
                                                   "Marzec" => "03",
                                                   "Kwiecień" => "04",
                                                   "Maj" => "05",
                                                   "Czerwiec" => "06",
                                                   "Lipec" => "07",
                                                   "Sierpień" => "08",
                                                   "Wrzesień" => "09",
                                                   "Październik" => "10",
                                                   "Listopad" => "11",
                                                   "Grudzień" => "12"
                                               );
                                               echo '<select required name = "rozpoczecieZatrudnieniaMiesiac_1">'
                                               . '<option selected></option>';
                                               foreach ($options as $view => $value) {
                                                   $selected = ($value == $_POST['rozpoczecieZatrudnieniaMiesiac_1']) ? "selected='selected'" : "";
                                                   echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                               }
                                               echo ' </select>';
                                               ?>
                                               <?php
                                               $options = array(
                                                   "01" => "01",
                                                   "02" => "02",
                                                   "03" => "03",
                                                   "04" => "04",
                                                   "05" => "05",
                                                   "06" => "06",
                                                   "07" => "07",
                                                   "08" => "08",
                                                   "09" => "09",
                                                   "10" => "10",
                                                   "11" => "11",
                                                   "12" => "12",
                                                   "13" => "13",
                                                   "14" => "14",
                                                   "15" => "15",
                                                   "16" => "16",
                                                   "17" => "17",
                                                   "18" => "18",
                                                   "19" => "19",
                                                   "20" => "20",
                                                   "21" => "21",
                                                   "22" => "22",
                                                   "23" => "23",
                                                   "24" => "24",
                                                   "25" => "25",
                                                   "26" => "26",
                                                   "27" => "27",
                                                   "28" => "28",
                                                   "29" => "29",
                                                   "30" => "30",
                                                   "31" => "31"
                                               );
                                               echo '<select required name = "rozpoczecieZatrudnieniaDzien_1">'
                                               . '<option selected></option>';
                                               foreach ($options as $view => $value) {
                                                   $selected = ($value == $_POST['rozpoczecieZatrudnieniaDzien_1']) ? "selected='selected'" : "";
                                                   echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                               }
                                               echo ' </select>';
                                               ?>
                                        <br><br>
                                        <input required name="zakonczenieZatrudnieniaRok_1" value="<?php
                                        if (isset($_POST["zakonczenieZatrudnieniaRok_1"])) {
                                            echo htmlentities($_POST["zakonczenieZatrudnieniaRok_1"]);
                                        }
                                        ?>" style="width:30px;" required></input>
                                               <?php
                                               $options = array(
                                                   "Styczeń" => "01",
                                                   "Luty" => "02",
                                                   "Marzec" => "03",
                                                   "Kwiecień" => "04",
                                                   "Maj" => "05",
                                                   "Czerwiec" => "06",
                                                   "Lipec" => "07",
                                                   "Sierpień" => "08",
                                                   "Wrzesień" => "09",
                                                   "Październik" => "10",
                                                   "Listopad" => "11",
                                                   "Grudzień" => "12"
                                               );
                                               echo '<select required name = "zakonczenieZatrudnieniaMiesiac_1">'
                                               . '<option selected></option>';
                                               foreach ($options as $view => $value) {
                                                   $selected = ($value == $_POST['zakonczenieZatrudnieniaMiesiac_1']) ? "selected='selected'" : "";
                                                   echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                               }
                                               echo ' </select>';
                                               ?>
                                               <?php
                                               $options = array(
                                                   "01" => "01",
                                                   "02" => "02",
                                                   "03" => "03",
                                                   "04" => "04",
                                                   "05" => "05",
                                                   "06" => "06",
                                                   "07" => "07",
                                                   "08" => "08",
                                                   "09" => "09",
                                                   "10" => "10",
                                                   "11" => "11",
                                                   "12" => "12",
                                                   "13" => "13",
                                                   "14" => "14",
                                                   "15" => "15",
                                                   "16" => "16",
                                                   "17" => "17",
                                                   "18" => "18",
                                                   "19" => "19",
                                                   "20" => "20",
                                                   "21" => "21",
                                                   "22" => "22",
                                                   "23" => "23",
                                                   "24" => "24",
                                                   "25" => "25",
                                                   "26" => "26",
                                                   "27" => "27",
                                                   "28" => "28",
                                                   "29" => "29",
                                                   "30" => "30",
                                                   "31" => "31"
                                               );
                                               echo '<select required name = "zakonczenieZatrudnieniaDzien_1">'
                                               . '<option selected></option>';
                                               foreach ($options as $view => $value) {
                                                   $selected = ($value == $_POST['zakonczenieZatrudnieniaDzien_1']) ? "selected='selected'" : "";
                                                   echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                               }
                                               echo ' </select>';
                                               ?>
                                    </div>
                                </div>
                                <div class="formularzWiersz">
                                    <div class="wierszEtykieta">Wymiar czasu pracy (podać w ułamku dziesiętnym):</div>
                                    <div class="wierszPoleEdycji">
                                        <input type="textbox" name="wymiarCzasuPracy_1_Licznik" value="<?php
                                        if (isset($_POST["wymiarCzasuPracy_1_Licznik"])) {
                                            echo htmlentities($_POST["wymiarCzasuPracy_1_Licznik"]);
                                        }
                                        ?>" style="width: 25px" required> / 
                                        <input type="textbox" name="wymiarCzasuPracy_1_Mianownik" value="<?php
                                        if (isset($_POST["wymiarCzasuPracy_1_Mianownik"])) {
                                            echo htmlentities($_POST["wymiarCzasuPracy_1_Mianownik"]);
                                        }
                                        ?>" style="width: 25px" required>
                                    </div>
                                </div>
                                <div class="formularzWiersz">
                                    <div class="wierszEtykieta">Pełny wymiar roczny urlopu:</div>
                                    <div class="wierszPoleEdycji">
                                        <?php
                                        $options = array(
                                            "10" => "10",
                                            "20" => "20",
                                            "26" => "26",
                                        );
                                        echo '<select required name = "wymiarRocznyUrlopu_1">'
                                        . '<option selected></option>';
                                        foreach ($options as $view => $value) {
                                            $selected = ($value == $_POST['wymiarRocznyUrlopu_1']) ? "selected='selected'" : "";
                                            echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                        }
                                        echo ' </select>';
                                        ?>
                                    </div>
                                </div>
                                <div class="formularzWiersz">
                                    <div class="wierszEtykieta">Obowiązująca norma dobowa czasu pracy (liczba godzin):</div>
                                    <div class="wierszPoleEdycji">
                                        <input type="textbox" name="normaDobowaCzasuPracy_1" value="<?php
                                        if (isset($_POST["normaDobowaCzasuPracy_1"])) {
                                            echo htmlentities($_POST["normaDobowaCzasuPracy_1"]);
                                        }
                                        ?>" required>
                                    </div>
                                </div> 
                                <div class="kalkulatorPrzycisk" style="width: 50%; margin: 0 auto;">
                                    <input id="przyciskObliczenia" type="submit" title="Oblicz urlop" value="" name="oblicz1">
                                </div>
                                <input type="hidden" name="oblicz" value="oblicz">
                                </form>
                                <form action="" name="oblicz2" method="POST">
                                    <div style="text-align: center;">
                                        <div id="kalkulatorWyniki" style="display: block;">
                                            <div id="kalkulatorWyniki_tl"></div>
                                            <div id="kalkulatorWyniki_tr"></div>
                                            <div id="kalkulatorWyniki_bl"></div>
                                            <div id="kalkulatorWyniki_br"></div>
                                            <div id="wynikiNaglowek">Wyniki</div>
                                            <table class="wynikiTabela" style="width: 100%">
                                                <tbody>
                                                    <tr>
                                                        <th>Liczba dni urlopu:</th>
                                                        <td><?php if (isset($liczbaDniUrlopuNaOkresPracy_1)) echo $liczbaDniUrlopuNaOkresPracy_1 ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Liczba godzin urlopu:</th>
                                                        <td><?php if (isset($liczbaGodzinUrlopuNaOkresPracy_1)) echo $liczbaGodzinUrlopuNaOkresPracy_1 ?></td>
                                                    </tr>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> 
                                    <!--II. Ze wzgledu na przerwę w wykonywaniu pracyI-->
                                    <div id="kalkulatorCzesc2">
                                        <span><b>II. Ze wzgledu na przerwę w wykonywaniu pracy</b></span>
                                    </div>
                                    <div class="formularzWiersz">
                                        <div class="wierszEtykieta">Rodzaj nieobecności w bieżącym roku:</div>
                                        <div class="wierszPoleEdycji">
                                            <?php
                                            $options = array(
                                                "urlop bezpłatny" => "urlopBezplatny",
                                                "urlop wychowawczy" => "urlopWychowawczy",
                                                "odbywanie zasadniczej służby wojskowej lub jej zastępczej służby przygotowawczej, określonej służby wojskowej, terytorialenj służby wojskowej pełnionej rotacyjnie, przeszkolenia wojskowego albo ćwiczeń wojskowych" => "odbycieSluzby",
                                                "tymczasowe aresztowanie" => "tymczasoweAresztowanie",
                                                "odbywanie kary pozbawienia wolności" => "pozbawienieWolnosci",
                                                "nieusprawiedliwiona nieobecność w pracy" => "nieobecnoscWPracy",
                                            );
                                            echo ' <select name="wymiarRocznyUrlopu" style="width:195px;">'
                                            . '<option selected></option>';
                                            foreach ($options as $view => $value) {
                                                $selected = ($value == $_POST['wymiarRocznyUrlopu']) ? "selected='selected'" : "";
                                                echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                            }
                                            echo ' </select>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="formularzWiersz" style="height: 70px;">
                                        <div class="wierszEtykieta">Okres nieobecności (od - do)<span style="color: #cc0000;">*</span>:</div>
                                        <div class="wierszPoleEdycji">
                                            <input name="rozpoczecieZatrudnieniaRok_2" value="<?php
                                            if (isset($_POST["rozpoczecieZatrudnieniaRok_2"])) {
                                                echo htmlentities($_POST["rozpoczecieZatrudnieniaRok_2"]);
                                            }
                                            ?>" style="width:30px;" required></input>
                                                   <?php
                                                   $options = array(
                                                       "Styczeń" => "01",
                                                       "Luty" => "02",
                                                       "Marzec" => "03",
                                                       "Kwiecień" => "04",
                                                       "Maj" => "05",
                                                       "Czerwiec" => "06",
                                                       "Lipec" => "07",
                                                       "Sierpień" => "08",
                                                       "Wrzesień" => "09",
                                                       "Październik" => "10",
                                                       "Listopad" => "11",
                                                       "Grudzień" => "12"
                                                   );
                                                   echo '<select required name = "rozpoczecieZatrudnieniaMiesiac_2">'
                                                   . '<option selected></option>';
                                                   foreach ($options as $view => $value) {
                                                       $selected = ($value == $_POST['rozpoczecieZatrudnieniaMiesiac_2']) ? "selected='selected'" : "";
                                                       echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                                   }
                                                   echo ' </select>';
                                                   ?>
                                                   <?php
                                                   $options = array(
                                                       "01" => "01",
                                                       "02" => "02",
                                                       "03" => "03",
                                                       "04" => "04",
                                                       "05" => "05",
                                                       "06" => "06",
                                                       "07" => "07",
                                                       "08" => "08",
                                                       "09" => "09",
                                                       "10" => "10",
                                                       "11" => "11",
                                                       "12" => "12",
                                                       "13" => "13",
                                                       "14" => "14",
                                                       "15" => "15",
                                                       "16" => "16",
                                                       "17" => "17",
                                                       "18" => "18",
                                                       "19" => "19",
                                                       "20" => "20",
                                                       "21" => "21",
                                                       "22" => "22",
                                                       "23" => "23",
                                                       "24" => "24",
                                                       "25" => "25",
                                                       "26" => "26",
                                                       "27" => "27",
                                                       "28" => "28",
                                                       "29" => "29",
                                                       "30" => "30",
                                                       "31" => "31"
                                                   );
                                                   echo '<select required name = "rozpoczecieZatrudnieniaDzien_2">'
                                                   . '<option selected></option>';
                                                   foreach ($options as $view => $value) {
                                                       $selected = ($value == $_POST['rozpoczecieZatrudnieniaDzien_2']) ? "selected='selected'" : "";
                                                       echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                                   }
                                                   echo ' </select>';
                                                   ?>
                                            <br><br>
                                            <input name="zakonczenieZatrudnieniaRok_2" value="<?php
                                            if (isset($_POST["zakonczenieZatrudnieniaRok_2"])) {
                                                echo htmlentities($_POST["zakonczenieZatrudnieniaRok_2"]);
                                            }
                                            ?>" style="width:30px;" required></input>
                                                   <?php
                                                   $options = array(
                                                       "Styczeń" => "01",
                                                       "Luty" => "02",
                                                       "Marzec" => "03",
                                                       "Kwiecień" => "04",
                                                       "Maj" => "05",
                                                       "Czerwiec" => "06",
                                                       "Lipec" => "07",
                                                       "Sierpień" => "08",
                                                       "Wrzesień" => "09",
                                                       "Październik" => "10",
                                                       "Listopad" => "11",
                                                       "Grudzień" => "12"
                                                   );
                                                   echo '<select required name = "zakonczenieZatrudnieniaMiesiac_2">'
                                                   . '<option selected></option>';
                                                   foreach ($options as $view => $value) {
                                                       $selected = ($value == $_POST['zakonczenieZatrudnieniaMiesiac_2']) ? "selected='selected'" : "";
                                                       echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                                   }
                                                   echo ' </select>';
                                                   ?>
                                                   <?php
                                                   $options = array(
                                                       "01" => "01",
                                                       "02" => "02",
                                                       "03" => "03",
                                                       "04" => "04",
                                                       "05" => "05",
                                                       "06" => "06",
                                                       "07" => "07",
                                                       "08" => "08",
                                                       "09" => "09",
                                                       "10" => "10",
                                                       "11" => "11",
                                                       "12" => "12",
                                                       "13" => "13",
                                                       "14" => "14",
                                                       "15" => "15",
                                                       "16" => "16",
                                                       "17" => "17",
                                                       "18" => "18",
                                                       "19" => "19",
                                                       "20" => "20",
                                                       "21" => "21",
                                                       "22" => "22",
                                                       "23" => "23",
                                                       "24" => "24",
                                                       "25" => "25",
                                                       "26" => "26",
                                                       "27" => "27",
                                                       "28" => "28",
                                                       "29" => "29",
                                                       "30" => "30",
                                                       "31" => "31"
                                                   );
                                                   echo '<select required name = "zakonczenieZatrudnieniaDzien_2">'
                                                   . '<option selected></option>';
                                                   foreach ($options as $view => $value) {
                                                       $selected = ($value == $_POST['zakonczenieZatrudnieniaDzien_2']) ? "selected='selected'" : "";
                                                       echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                                   }
                                                   echo ' </select>';
                                                   ?>
                                        </div>
                                    </div>
                                    <div class="formularzWiersz">
                                        <div class="wierszEtykieta">Wymiar czasu pracy (podać w ułamku dziesiętnym):</div>
                                        <div class="wierszPoleEdycji">
                                            <input type="textbox" name="wymiarCzasuPracy_2_Licznik" value="<?php
                                            if (isset($_POST["wymiarCzasuPracy_2_Licznik"])) {
                                                echo htmlentities($_POST["wymiarCzasuPracy_2_Licznik"]);
                                            }
                                            ?>" style="width: 25px" required> / 
                                            <input type="textbox" name="wymiarCzasuPracy_2_Mianownik" value="<?php
                                            if (isset($_POST["wymiarCzasuPracy_2_Mianownik"])) {
                                                echo htmlentities($_POST["wymiarCzasuPracy_2_Mianownik"]);
                                            }
                                            ?>" style="width: 25px" required>
                                        </div>
                                    </div>
                                    <div class="formularzWiersz">
                                        <div class="wierszEtykieta">Pełny wymiar roczny urlopu:</div>
                                        <div class="wierszPoleEdycji">
                                            <?php
                                            $options = array(
                                                "10" => "10",
                                                "20" => "20",
                                                "26" => "26",
                                            );
                                            echo '<select required name = "wymiarRocznyUrlopu_2">'
                                            . '<option selected></option>';
                                            foreach ($options as $view => $value) {
                                                $selected = ($value == $_POST['wymiarRocznyUrlopu_2']) ? "selected='selected'" : "";
                                                echo '<option  value="' . $value . '" ' . $selected . '  >' . $view . '</option>';
                                            }
                                            echo ' </select>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="formularzWiersz">
                                        <div class="wierszEtykieta">Obowiązująca norma dobowa czasu pracy (liczba godzin):</div>
                                        <div class="wierszPoleEdycji">
                                            <input type="textbox" name="normaDobowaCzasuPracy_2" value="<?php
                                            if (isset($_POST["normaDobowaCzasuPracy_2"])) {
                                                echo htmlentities($_POST["normaDobowaCzasuPracy_2"]);
                                            }
                                            ?>" required>
                                        </div>
                                    </div> 
                                    <div class="formularzWiersz">
                                        <div class="wierszEtykieta">Liczba miesięcy nieobecności (podać w ułamku dziesiętnym)<span style="color: #cc0000;">**</span>:</div>
                                        <div class="wierszPoleEdycji">                                            
                                            <input type="textbox" name="liczbaMiesiecyNieobecnosci_2_Licznik" value="<?php
                                            if (isset($_POST["liczbaMiesiecyNieobecnosci_2_Licznik"])) {
                                                echo htmlentities($_POST["liczbaMiesiecyNieobecnosci_2_Licznik"]);
                                            }
                                            ?>" style="width: 25px" required> / 
                                            <input type="textbox" name="liczbaMiesiecyNieobecnosci_2_Mianownik" value="<?php
                                            if (isset($_POST["liczbaMiesiecyNieobecnosci_2_Mianownik"])) {
                                                echo htmlentities($_POST["liczbaMiesiecyNieobecnosci_2_Mianownik"]);
                                            }
                                            ?>" style="width: 25px" required>
                                        </div>
                                    </div>
                                    <div class="formularzWiersz" style="height: 100px; margin: 0px 0px 6px;">
                                        <p class="trescUwagi" style="text-align: justify; text-justify: inter-word;">
                                            <span style="color: #cc0000;">*</span>nie wypełniać gry okres jest przerwany
                                        </p>
                                        <p class="trescUwagi" style="text-align: justify; text-justify: inter-word;">
                                            <span style="color: #cc0000;">*</span>wpisać tylko, gdy nieobecność ma charakter przerwany (jeśli okres nieobecności wymieniony w poz: "Rodzaj nieobecności" obejmują części miesięcy kalendarzowych, za miesiąc uważa się łacznie 30 dni); UWAGA!!! rubryki nie wypełniać gdy nieobecność była dopasowana urlopem wychowawczym udzielonym po nabyciu prawa do urlopu wypoczynkowego za bieżący rok
                                        </p>
                                    </div>
                                    <div class="kalkulatorPrzycisk"style="width: 50%; margin: 0 auto;">
                                        <input id="przyciskObliczenia" type="submit" title="Oblicz urlop" value="" name="oblicz2">
                                    </div>
                                </form>                       
                                <input type="hidden" name="oblicz" value="oblicz">

                                <div style="text-align: center;">
                                    <div id="kalkulatorWyniki" style="display: block;">
                                        <div id="kalkulatorWyniki_tl"></div>
                                        <div id="kalkulatorWyniki_tr"></div>
                                        <div id="kalkulatorWyniki_bl"></div>
                                        <div id="kalkulatorWyniki_br"></div>
                                        <div id="wynikiNaglowek">Wyniki</div>
                                        <table class="wynikiTabela" style="width: 100%">
                                            <tbody>
                                                <tr>
                                                    <th>Liczba dni urlopu:</th>
                                                    <td><?php if (isset($liczbaDniUrlopuZeWzgleduNaPrzerwe_2)) echo $liczbaDniUrlopuZeWzgleduNaPrzerwe_2 ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Liczba godzin urlopu:</th>
                                                    <td><?php if (isset($liczbaGodzinUrlopuZeWzgleduNaPrzerwe_2)) echo $liczbaGodzinUrlopuZeWzgleduNaPrzerwe_2 ?></td>
                                                </tr>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>

