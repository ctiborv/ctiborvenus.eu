<?php

class KontaktKontroler extends Kontroler
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'Kontaktní formulář',
			'klicova_slova' => 'kontakt, email, formulář',
			'popis' => 'Kontaktní formulář našeho webu.'
		);
		
		if (isset($_POST["email"]))
		{
			if ($_POST['rok'] == date("Y"))
			{
                                $zprava=$_POST['zprava'];
                                $email = $_POST['email'];
                                
				$odesilacEmailu = new OdesilacEmailu();
				$odesilacEmailu->odesli("info@ctiborvenus.eu", "Email z webu", $_POST['zprava'], $_POST['email']);
			}
		}
		
		$this->pohled = 'kontakt';
                $this->js = 'view.contact.js';
    }
}