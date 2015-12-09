<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hledat
 *
 * @author ctibor
 */
class HledatKontroler extends Kontroler {
    //put your code here
        private $_kontrolerMd;
        

        public function __construct() {
                $this->_kontrolerMd= new SpravceClanku();
        }
        
        
        
        public function zpracuj($parametry) {

    		if (!empty($_GET["q"]))
		{
                    $text= $_GET["q"];
                    $clanky = $this->_kontrolerMd->hledejClanky($text);
                    $this->data['clanky'] = $clanky;
                    $this->pohled = 'hledat';
                }
		else
		// Není zadáno URL článku, vypíšeme všechny
		{
                        
                    $this->pohled = 'hledat';
		}
        }
}
