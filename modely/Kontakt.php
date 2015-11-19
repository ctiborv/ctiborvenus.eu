<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kontakt
 *
 * @author ctibor
 */
class Kontakt {
    
    
    public function vratMoznosti(){
        $moznosti= Db::dotazVsechny('
			SELECT `id`,`nazev`  
			FROM `kontaktmoznosti` 
                        ORDER by id
		');
            
        return $moznosti;

    }

    public function vratMoznost($id){

		return Db::dotazJeden('
			SELECT `id`, `nazev` , `zprava` , `textmailu` 
			FROM `kontaktmoznosti` 
			WHERE `id` = ?
		', array($id));

    }
    
    
}
