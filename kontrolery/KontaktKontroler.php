<?php

class KontaktKontroler extends Kontroler
{
	public function zpracuj($parametry)
	{
            
                
                $modelKontakt = new Kontakt;
		
		if (isset($_POST["odeslat"]))
		{
                    $antispam = $_POST['antispam'];
                    $jmeno = $_POST['name'];
                    $email = $_POST['email'];
                    $sluzba = $_POST['sluzba'];
                    $zprava = $_POST['message'];
                    $telefon = $_POST['phone'];
                    if ($antispam==6) {
                        $zprava = '
                            Jméno: $jmeno
                            Email: $email
                            Služba: $sluzba
                            Telefon : $telefon
                            Zprava : $zprava
                           ';
                        $zprava=$_POST['zprava'];
                        $email = $_POST['email'];

                        $odesilacEmailu = new OdesilacEmailu();
                        $odesilacEmailu->odesli("info@ctiborvenus.eu", "Email z webu", $zprava, $email);
                        $moznost=$modelKontakt->vratMoznost($sluzba);
                        $this->data['odeslano']=1;
                        $this->data['textodeslano']=$moznost['textmailu'];
                    }
                    else {
                        $this->data['chyba']="Antispam nebyl vyplněn";
                        $this->data['jmeno']=$jmeno;
                        $this->data['email']=$email;
                        $this->data['typsluzby']=$sluzba;
                        $this->data['zprava']=$zprava;
                        $this->data['telefon']=$telefon;
                        
                    }
		}
                else {

                    $idsluzba=$parametry[0];
                    if ($idsluzba) {
                        $moznost=$modelKontakt->vratMoznost($idsluzba);
                        $this->data['zprava']=$moznost['zprava'];
                        $this->data['typsluzby']=$idsluzba;
                    }
                    
                }
                $moznosti = $modelKontakt->vratMoznosti();
                $this->data['moznosti'] = $moznosti;
		$this->pohled = 'kontakt';
                $this->data['js'] = 'view.contact.js';
    }
}