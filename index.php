<?php

/*  Autor Ctibor Venus - info@ctiborvenus.eu
 * změnou, kopírováním, prodejem či jiným rozmnožováním tohoto kódu bez souhlasu
 * autora se dopouštíte porušování zákonů ČR dle autorského zákona a zákonů
 * o duševním vlastnictví a vystavujete se možnosti soudního stíhání.
 * Šablona vychází z kódu na www.devbook.cz :-) 
 */

// Nastavení interního kódování pro funkce pro práci s řetězci
mb_internal_encoding("UTF-8");

// Callback pro automatické načítání tříd controllerů a modelů
function autoloadFunkce($trida)
{
	// Končí název třídy řetězcem "Kontroler" ?
    if (preg_match('/Kontroler$/', $trida))	
        require("kontrolery/" . $trida . ".php");
    else
        require("modely/" . $trida . ".php");
}

// Registrace callbacku 
spl_autoload_register("autoloadFunkce");

// Připojení k databázi
if ($_SERVER["SERVER_NAME"]=='localhost') {
    Db::pripoj("127.0.0.1", "root", "", "ctiborvenus");
}
else {
    Db::pripoj("wm84.wedos.net", "w98406_cveu", "8RMRNVDQ", "d98406_cveu");
    
}

session_start();

// Vytvoření routeru a zpracování parametrů od uživatele z URL

const JAZYK_CS = 0;
const JAZYK_EN = 1;
const JAZYK_DE = 2;

const PREFIX_EN = '/en';
const PREFIX_DE = '/de';

const XML_CS = 'cs';
const XML_EN = 'en';
const XML_DE = 'de';




if (!isset($_SESSION['jazyk'])) {
        $_SESSION['jazyk']=JAZYK_CS;
        $_SESSION['prefix_jazyk']='';
        $_SESSION['xml_jazyk']=XML_CS;
}
        


$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
// Vyrenderování šablony
header("Content-Type: text/html; charset=utf-8");
$smerovac->vypisPohled();