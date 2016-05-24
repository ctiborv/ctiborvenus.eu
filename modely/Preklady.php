<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Preklady {
    

    public function vratPreklad($text_cs){
        
            $text = Db::dotazJeden("SELECT * FROM texty where text_cs=?", array($text_cs));
            $pole = array('text_cs','text_en','text_de');
            $jazyk_pole = $pole[$_SESSION['jazyk']];
            if (!$text) return $text_cs;
            else return $text[$jazyk_pole];
            
    }



}
