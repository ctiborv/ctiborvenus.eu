<?php

/*  Autor Ctibor Venus - info@ctiborvenus.eu
 * změnou, kopírováním, prodejem či jiným rozmnožováním tohoto kódu bez souhlasu
 * autora se dopouštíte porušování zákonů ČR dle autorského zákona a zákonů
 * o duševním vlastnictví a vystavujete se možnosti soudního stíhání.
 * Šablona vychází z kódu na www.devbook.cz :-) 
 */

// Výchozí kontroler 
abstract class Kontroler
{

	// Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
    protected $data = array();
    protected $neodata = array();
	// Název šablony bez přípony
    protected $pohled = "";
	// Hlavička HTML stránky
    protected $hlavicka = array('titulek' => '', 'klicova_slova' => '', 'popis' => '');

	// Ošetří proměnnou pro výpis do HTML stránky
	private function osetri($x = null)
	{
		if (!isset($x))
			return null;
		elseif (is_string($x))
			return htmlspecialchars($x, ENT_QUOTES);
		elseif (is_array($x))
		{
			foreach($x as $k => $v)
			{
				$x[$k] = $this->osetri($v);
			}
			return $x;
		}
		else 
			return $x;
	}
	
	// Vyrenderuje pohled
        public function vypisPohled()
        {
            if ($this->pohled)
            {
                if (!$_SESSION['admin']) {
                        extract($this->osetri($this->data));
                }
                else {
                        extract($this->data);
                }
                extract($this->data, EXTR_PREFIX_ALL, "");
                require("pohledy/" . $this->pohled . ".phtml");
            }
        }
	
	// Přesměruje na dané URL
	public function presmeruj($url)
	{
		header("Location: /$url");
		header("Connection: close");
        exit;
	}

	// Hlavní metoda controlleru
    abstract function zpracuj($parametry);

}