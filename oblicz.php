<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of oblicz
 *
 * @author test
 */
class oblicz {

    public $wymiarCzasuPracy = 0;
    public $wymiarRocznyUrlopu = 0;
    public $intervalMiesiac = 0;
    public $intervalRok = 0;
    public $wymiarCzasuPracy_Licznik = 0;
    public $wymiarCzasuPracy_Mianownik = 0;
    public $liczbaDniUrlopu = 0;
    public $normaDobowaCzasuPracy = 0;

    public function __construct() {
        
    }

    public function liczbaDniUrlopuNaOkresPracy($wymiarCzasuPracy, $wymiarRocznyUrlopu, $intervalMiesiac, $intervalRok) {
        if ($intervalMiesiac === 0 && $intervalRok === 0) {
            return ceil(ceil($wymiarCzasuPracy * $wymiarRocznyUrlopu) * 1 / 12);
        } elseif ($intervalRok === 0) {
            return ceil(ceil($wymiarCzasuPracy * $wymiarRocznyUrlopu) * ($intervalMiesiac + 1) / 12);
        } else {
            return ceil(ceil($wymiarCzasuPracy * $wymiarRocznyUrlopu) * ($intervalMiesiac + 1 + $intervalRok * 12) / 12);
        }
    }

    public function liczbaGodzinUrlopu($liczbaDniUrlopu, $normaDobowaCzasuPracy) {
        return $liczbaDniUrlopu * $normaDobowaCzasuPracy;
    }

    public function liczbaDniUrlopuZeWzgleduNaPrzerwe($liczbaDniUrlopuNaOkresPracy, $liczbaMiesiecyNieobecnosci, $wymiarRocznyUrlopu) {
        return ceil($liczbaDniUrlopuNaOkresPracy - ($liczbaMiesiecyNieobecnosci * $wymiarRocznyUrlopu));
    }

    public function ulamek($wymiarCzasuPracy_Licznik, $wymiarCzasuPracy_Mianownik) {
        return $wymiarCzasuPracy_Licznik / $wymiarCzasuPracy_Mianownik;
    }

}
