<?php
/*
	Author: Helge Sverre Hessevik Liseth
	Website: www.helgesverre.com
	
	Email: helge.sverre@gmail.com
	Twitter: @HelgeSverre
	
	License: Attribution-ShareAlike 4.0 International
	
*/


/**
 * Class responsible for checking if a domain is registered
 *
 * @author  Helge Sverre <email@helgesverre.com>
 *
 * @param boolean $error_reporting Set if the function should display errors or suppress them, default is false
 * @return boolean true means the domain is NOT registered
 */
class DomainAvailability {

	private  $error_reporting;


	public function __construct($debug = false) {
		if ( $debug ) {
			error_reporting(E_ALL);
			$error_reporting = true;
		} else {
			error_reporting(0);
			$error_reporting = false;
		}

	}


	/**
	 * This function checks if the supplied domain name is registered
	 *
	 * @author  Helge Sverre <email@helgesverre.com>
	 *
	 * @param string $domain The domain that will be checked for registration.
	 * @param boolean $error_reporting Set if the function should display errors or suppress them, default is TRUE
	 * @return boolean true means the domain is NOT registered
	 */
	public function is_available($domain) {

		// make the domain lowercase
		$domain = strtolower($domain);

		// Set the timeout (in seconds) for the socket open function.
		$timeout = 10;



		/**
		 * This array contains the list of WHOIS servers and the "domain not found" string
		 * to be searched for to check if the domain is available for registration.
		 *
		 * NOTE: The "domain not found" string may change at any time for any reason.
		 */
		$whois_arr = array(
			"com"=>  array("whois.crsnic.net", "No match for"),
			"net"=>  array("whois.crsnic.net", "No match for"),
			"org"=>  array("whois.publicinterestregistry.net", "NOT FOUND"),
			"uk"=>  array("whois.nic.uk", "No match"),
			"couk"=>  array("whois.nic.uk", "No match"),
			"netuk"=>  array("whois.nic.uk", "No match"),
			"orguk"=>  array("whois.nic.uk", "No match"),
			"ltduk"=>  array("whois.nic.uk", "No match"),
			"plcuk"=>  array("whois.nic.uk", "No match"),
			"meuk"=>  array("whois.nic.uk", "No match"),
			"edu"=>  array("whois.internic.net", "No match for"),
			"mil"=>  array("whois.internic.net", "No match for"),
			"brcom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"cncom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"eucom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"hucom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"nocom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"qccom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"sacom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"secom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"senet"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"uscom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"uycom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"zacom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"ac"=>  array("whois.nic.ac", "is not registered"),
			"coac"=>  array("whois.nic.ac", "is not registered"),
			"gvac"=>  array("whois.nic.ac", "is not registered"),
			"orac"=>  array("whois.nic.ac", "is not registered"),
			"acac"=>  array("whois.nic.ac", "is not registered"),
			"af"=>  array("whois.nic.af", "No Object Found"),
			"am"=>  array("whois.amnic.net", "No match"),
			"as"=>  array("whois.nic.as", "Available"),
			"at"=>  array("whois.nic.at", "nothing found"),
			"acat"=>  array("whois.nic.at", "nothing found"),
			"coat"=>  array("whois.nic.at", "nothing found"),
			"gvat"=>  array("whois.nic.at", "nothing found"),
			"orat"=>  array("whois.nic.at", "nothing found"),
			"asnau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"comau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"eduau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"orgau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"netau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"idau"=>  array("whois-check.ausregistry.net.au", "Available"),
			"be"=>  array("whois.dns.be", "Status:"),
			"acbe"=>  array("whois.dns.be", "No such domain"),
			"br"=>  array("whois.nic.br", "No match for"),
			"admbr"=>  array("whois.nic.br", "No match for"),
			"advbr"=>  array("whois.nic.br", "No match for"),
			"ambr"=>  array("whois.nic.br", "No match for"),
			"arqbr"=>  array("whois.nic.br", "No match for"),
			"artbr"=>  array("whois.nic.br", "No match for"),
			"biobr"=>  array("whois.nic.br", "No match for"),
			"cngbr"=>  array("whois.nic.br", "No match for"),
			"cntbr"=>  array("whois.nic.br", "No match for"),
			"combr"=>  array("whois.nic.br", "No match for"),
			"ecnbr"=>  array("whois.nic.br", "No match for"),
			"engbr"=>  array("whois.nic.br", "No match for"),
			"espbr"=>  array("whois.nic.br", "No match for"),
			"etcbr"=>  array("whois.nic.br", "No match for"),
			"etibr"=>  array("whois.nic.br", "No match for"),
			"fmbr"=>  array("whois.nic.br", "No match for"),
			"fotbr"=>  array("whois.nic.br", "No match for"),
			"fstbr"=>  array("whois.nic.br", "No match for"),
			"g12br"=>  array("whois.nic.br", "No match for"),
			"govbr"=>  array("whois.nic.br", "No match for"),
			"indbr"=>  array("whois.nic.br", "No match for"),
			"infbr"=>  array("whois.nic.br", "No match for"),
			"jorbr"=>  array("whois.nic.br", "No match for"),
			"lelbr"=>  array("whois.nic.br", "No match for"),
			"medbr"=>  array("whois.nic.br", "No match for"),
			"milbr"=>  array("whois.nic.br", "No match for"),
			"netbr"=>  array("whois.nic.br", "No match for"),
			"nombr"=>  array("whois.nic.br", "No match for"),
			"ntrbr"=>  array("whois.nic.br", "No match for"),
			"odobr"=>  array("whois.nic.br", "No match for"),
			"orgbr"=>  array("whois.nic.br", "No match for"),
			"ppgbr"=>  array("whois.nic.br", "No match for"),
			"probr"=>  array("whois.nic.br", "No match for"),
			"pscbr"=>  array("whois.nic.br", "No match for"),
			"psibr"=>  array("whois.nic.br", "No match for"),
			"recbr"=>  array("whois.nic.br", "No match for"),
			"slgbr"=>  array("whois.nic.br", "No match for"),
			"tmpbr"=>  array("whois.nic.br", "No match for"),
			"turbr"=>  array("whois.nic.br", "No match for"),
			"tvbr"=>  array("whois.nic.br", "No match for"),
			"vetbr"=>  array("whois.nic.br", "No match for"),
			"zlgbr"=>  array("whois.nic.br", "No match for"),
			"ca"=>  array("whois.cira.ca", "Domain status:         available"),
			"cc"=>  array("whois.nic.cc", "No match"),
			"cn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"accn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"comcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"educn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"govcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"netcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"orgcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"bjcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"shcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"tjcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"cqcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hecn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"nmcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"lncn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"jlcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hlcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"jscn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"zjcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"ahcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hbcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hncn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"gdcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"gxcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hicn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"sccn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"scot"=>  array("whois.scot.coreregistry.net", "no matching objects found"),
			"gzcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"yncn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"xzcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"sncn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"gscn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"qhcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"nxcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"xjcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"twcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"hkcn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"mocn"=>  array("whois.cnnic.net.cn", "No matching record"),
			"cx"=>  array("whois.nic.cx", "No match for"),
			"cz"=>  array("whois.nic.cz", "No entries found"),
			"de"=>  array("whois.denic.de", "Status: free"),
			"comde"=>  array("whois.centralnic.com", "Status: free"),
			"dk"=>  array("whois.dk-hostmaster.dk", "No entries found"),
			"fo"=>  array("whois.nic.fo", "no entries found"),
			"comec"=>  array("whois.lac.net", "No match found"),
			"orgec"=>  array("whois.lac.net", "No match found"),
			"netec"=>  array("whois.lac.net", "No match found"),
			"milec"=>  array("whois.lac.net", "No match found"),
			"finec"=>  array("whois.lac.net", "No match found"),
			"medec"=>  array("whois.lac.net", "No match found"),
			"govec"=>  array("whois.lac.net", "No match found"),
			"fr"=>  array("whois.nic.fr", "No entries found"),
			"tmfr"=>  array("whois.nic.fr", "No entries found"),
			"comfr"=>  array("whois.nic.fr", "No entries found"),
			"assofr"=>  array("whois.nic.fr", "No entries found"),
			"pressefr"=>  array("whois.nic.fr", "No entries found"),
			"gf"=>  array("whois.nplus.gf", "not found in our database"),
			"coil"=>  array("whois.isoc.org.il", "No data was found"),
			"orgil"=>  array("whois.isoc.org.il", "No data was found"),
			"netil"=>  array("whois.isoc.org.il", "No data was found"),
			"acil"=>  array("whois.isoc.org.il", "No data was found"),
			"k12il"=>  array("whois.isoc.org.il", "No data was found"),
			"govil"=>  array("whois.isoc.org.il", "No data was found"),
			"muniil"=>  array("whois.isoc.org.il", "No data was found"),
			"acin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"coin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"orgin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"ernetin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"govin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"netin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"resin"=>  array("whois.inregistry.in", "NOT FOUND"),
			"is"=>  array("whois.isnic.is", "No entries found"),
			"it"=>  array("whois.nic.it", "AVAILABLE"),
			"acjp"=>  array("whois.nic.ad.jp", "No match!!"),
			"cojp"=>  array("whois.nic.ad.jp", "No match!!"),
			"gojp"=>  array("whois.nic.ad.jp", "No match!!"),
			"orjp"=>  array("whois.nic.ad.jp", "No match!!"),
			"nejp"=>  array("whois.nic.ad.jp", "No match!!"),
			"ackr"=>  array("whois.nic.or.kr", "is not registered"),
			"cokr"=>  array("whois.nic.or.kr", "is not registered"),
			"gokr"=>  array("whois.nic.or.kr", "is not registered"),
			"nekr"=>  array("whois.nic.or.kr", "is not registered"),
			"nmkr"=>  array("whois.nic.or.kr", "is not registered"),
			"orkr"=>  array("whois.nic.or.kr", "is not registered"),
			"rekr"=>  array("whois.nic.or.kr", "is not registered"),
			"li"=>  array("whois.nic.li", "do not have an entry in our database matching your query"),
			"lt"=>  array("das.domreg.lt", "Status:"),
			"lu"=>  array("whois.dns.lu", "No such domain"),
			"assomc"=>  array("whois.ripe.net", "no entries found"),
			"tmmc"=>  array("whois.ripe.net", "no entries found"),
			"commm"=>  array("whois.nic.mm", "No domains matched"),
			"orgmm"=>  array("whois.nic.mm", "No domains matched"),
			"netmm"=>  array("whois.nic.mm", "No domains matched"),
			"edumm"=>  array("whois.nic.mm", "No domains matched"),
			"govmm"=>  array("whois.nic.mm", "No domains matched"),
			"mx"=>  array("whois.nic.mx", "No_Se_Encontro_El_Objeto/Object_Not_Found"),
			"commx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"orgmx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"netmx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"edumx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"govmx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"gobmx"=>  array("whois.nic.mx", "Object_Not_Found"),
			"nl"=>  array("whois.domain-registry.nl", "is free"),
			"no"=>  array("whois.norid.no", "No match"),
			"nu"=>  array("whois.nic.nu", "not found"),
			"pl"=>  array("whois.dns.pl", "No information available"),
			"compl"=>  array("whois.dns.pl", "No information available"),
			"netpl"=>  array("whois.dns.pl", "No information available"),
			"orgpl"=>  array("whois.dns.pl", "No information available"),
			"aidpl"=>  array("whois.dns.pl", "No information available"),
			"agropl"=>  array("whois.dns.pl", "No information available"),
			"atmpl"=>  array("whois.dns.pl", "No information available"),
			"autopl"=>  array("whois.dns.pl", "No information available"),
			"bizpl"=>  array("whois.dns.pl", "No information available"),
			"edupl"=>  array("whois.dns.pl", "No information available"),
			"gminapl"=>  array("whois.dns.pl", "No information available"),
			"gsmpl"=>  array("whois.dns.pl", "No information available"),
			"infopl"=>  array("whois.dns.pl", "No information available"),
			"mailpl"=>  array("whois.dns.pl", "No information available"),
			"miastapl"=>  array("whois.dns.pl", "No information available"),
			"mediapl"=>  array("whois.dns.pl", "No information available"),
			"milpl"=>  array("whois.dns.pl", "No information available"),
			"nompl"=>  array("whois.dns.pl", "No information available"),
			"pcpl"=>  array("whois.dns.pl", "No information available"),
			"privpl"=>  array("whois.dns.pl", "No information available"),
			"realestatepl"=>  array("whois.dns.pl", "No information available"),
			"relpl"=>  array("whois.dns.pl", "No information available"),
			"shoppl"=>  array("whois.dns.pl", "No information available"),
			"skleppl"=>  array("whois.dns.pl", "No information available"),
			"sospl"=>  array("whois.dns.pl", "No information available"),
			"targipl"=>  array("whois.dns.pl", "No information available"),
			"tmpl"=>  array("whois.dns.pl", "No information available"),
			"tourismpl"=>  array("whois.dns.pl", "No information available"),
			"travelpl"=>  array("whois.dns.pl", "No information available"),
			"turystykapl"=>  array("whois.dns.pl", "No information available"),
			"ro"=>  array("whois.rotld.ro", "No entries found"),
			"comro"=>  array("whois.rotld.ro", "No entries found"),
			"orgro"=>  array("whois.rotld.ro", "No entries found"),
			"storero"=>  array("whois.rotld.ro", "No entries found"),
			"tmro"=>  array("whois.rotld.ro", "No entries found"),
			"firmro"=>  array("whois.rotld.ro", "No entries found"),
			"wwwro"=>  array("whois.rotld.ro", "No entries found"),
			"artsro"=>  array("whois.rotld.ro", "No entries found"),
			"recro"=>  array("whois.rotld.ro", "No entries found"),
			"inforo"=>  array("whois.rotld.ro", "No entries found"),
			"nomro"=>  array("whois.rotld.ro", "No entries found"),
			"ntro"=>  array("whois.rotld.ro", "No entries found"),
			"se"=>  array("whois.iis.se", "not found"),
			"si"=>  array("whois.arnes.si", "No entries found"),
			"comsg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"orgsg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"netsg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"govsg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"sk"=>  array("whois.sk-nic.sk", "Not found"),
			"st"=>  array("whois.nic.st", "No entries found"),
			"tf"=>  array("whois.adamsnames.tc", "Available"),
			"acth"=>  array("whois.thnic.net", "No match for"),
			"coth"=>  array("whois.thnic.net", "No match for"),
			"goth"=>  array("whois.thnic.net", "No match for"),
			"mith"=>  array("whois.thnic.net", "No match for"),
			"netth"=>  array("whois.thnic.net", "No match for"),
			"orth"=>  array("whois.thnic.net", "No match for"),
			"inth"=>  array("whois.thnic.net", "No match for"),
			"tj"=>  array("whois.nic.tj", "No match"),
			"to"=>  array("monarch.tonic.to", "No match for"),
			"bbstr"=>  array("whois.metu.edu.tr", "No match found"),
			"comtr"=>  array("whois.metu.edu.tr", "No match found"),
			"edutr"=>  array("whois.metu.edu.tr", "No match found"),
			"govtr"=>  array("whois.metu.edu.tr", "No match found"),
			"k12tr"=>  array("whois.metu.edu.tr", "No match found"),
			"miltr"=>  array("whois.metu.edu.tr", "No match found"),
			"nettr"=>  array("whois.metu.edu.tr", "No match found"),
			"orgtr"=>  array("whois.metu.edu.tr", "No match found"),
			"comtw"=>  array("whois.twnic.net", "No Found"),
			"orgtw"=>  array("whois.twnic.net", "No Found"),
			"nettw"=>  array("whois.twnic.net", "No Found"),
			"acuk"=>  array("whois.ja.net", "Sorry - no"),
			"ukco"=>  array("whois.uk.co", "NO MATCH"),
			"ukcom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"uknet"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"gbcom"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"gbnet"=>  array("whois.centralnic.com", "DOMAIN NOT FOUND"),
			"acza"=>  array("whois.co.za", "No information available"),
			"altza"=>  array("whois.co.za", "No information available"),
			"coza"=>  array("whois.registry.net.za", "Available"),
			"eduza"=>  array("whois.co.za", "No information available"),
			"govza"=>  array("whois.co.za", "No information available"),
			"milza"=>  array("whois.co.za", "No information available"),
			"netza"=>  array("net-whois.registry.net.za", "Available"),
			"ngoza"=>  array("whois.co.za", "No information available"),
			"nomza"=>  array("whois.co.za", "No information available"),
			"orgza"=>  array("org-whois.registry.net.za", "Available"),
			"schoolza"=>  array("whois.co.za", "No information available"),
			"tmza"=>  array("whois.co.za", "No information available"),
			"webza"=>  array("web-whois.registry.net.za", "Available"),
			"kz"=>  array("whois.domain.kz", "No entries found"),
			"ch"=>  array("whois.nic.ch", "not have an entry"),
			"info"=>  array("whois.afilias.net", "NOT FOUND"),
			"ua"=>  array("whois.ua", "No entries found"),
			"biz"=>  array("whois.nic.biz", "Not found"),
			"ws"=>  array("whois.website.ws", "No match for"),
			"gov"=>  array("whois.nic.gov", "No match for"),
			"name"=>  array("whois.nic.name", "No match"),
			"ie"=>  array("whois.domainregistry.ie", "% Not Registered"),
			"hk"=>  array("whois.hkirc.hk", "The domain has not been registered"),
			"comhk"=>  array("whois.hkdnr.net.hk", "The domain has not been registered"),
			"orghk"=>  array("whois.hkdnr.net.hk", "The domain has not been registered"),
			"nethk"=>  array("whois.hkdnr.net.hk", "The domain has not been registered"),
			"eduhk"=>  array("whois.hkdnr.net.hk", "The domain has not been registered"),
			"us"=>  array("whois.nic.us", "Not found"),
			"tk"=>  array("https://partners.nic.tk/cgi-bin/whmcs-whois.taloha?d=", "HTTPREQUEST-has no matches"),
			"cd"=>  array("whois.cd", "No match"),
			"aero"=>  array("whois.aero", "NOT FOUND"),
			"by"=>  array("whois.cctld.by", "Object does not exist"),
			"ad"=>  array("whois.ripe.net", "no entries found"),
			"lv"=>  array("whois.nic.lv", "Status: free"),
			"eulv"=>  array("whois.biz", "Not found"),
			"bz"=>  array("whois.afilias-grs.info.", "NOT FOUND"),
			"es"=>  array("whois.crsnic.net", "No match for"),
			"comes"=>  array("http://whois.virtualname.es/whois.php?domain=", "HTTPREQUEST-LIBRE"),
			"nomes"=>  array("http://whois.virtualname.es/whois.php?domain=", "HTTPREQUEST-LIBRE"),
			"gobes"=>  array("http://whois.virtualname.es/whois.php?domain=", "HTTPREQUEST-LIBRE"),
			"edues"=>  array("http://whois.virtualname.es/whois.php?domain=", "HTTPREQUEST-LIBRE"),
			"jp"=>  array("whois.jprs.jp", "No match!!"),
			"cl"=>  array("whois.nic.cl", "no existe"),
			"ag"=>  array("whois.nic.ag", "NOT FOUND"),
			"mobi"=>  array("whois.dotmobiregistry.net", "NOT FOUND"),
			"eu"=>  array("whois.eu", "Status: AVAILABLE"),
			"conz"=>  array("whois.srs.net.nz", "220 Available"),
			"orgnz"=>  array("whois.srs.net.nz", "220 Available"),
			"netnz"=>  array("whois.srs.net.nz", "220 Available"),
			"maorinz"=>  array("whois.srs.net.nz", "220 Available"),
			"iwinz"=>  array("whois.srs.net.nz", "220 Available"),
			"acnz"=>  array("whois.srs.net.nz", "220 Available"),
			"kiwinz"=>  array("whois.srs.net.nz", "220 Available"),
			"geeknz"=>  array("whois.srs.net.nz", "220 Available"),
			"gennz"=>  array("whois.srs.net.nz", "220 Available"),
			"schoolnz"=>  array("whois.srs.net.nz", "220 Available"),
			"nz"=>  array("whois.srs.net.nz", "220 Available"),
			"io"=>  array("whois.nic.io", "is available"),
			"la"=>  array("whois.nic.la", "NOT FOUND"),
			"md"=>  array("whois.nic.md", "No match for"),
			"sc"=>  array("wawa.eahd.or.ug", "No entries found"),
			"sg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"vc"=>  array("whois.adamsnames.tc", "Available"),
			"tw"=>  array("whois.twnic.net.tw", "No Found"),
			"travel"=>  array("whois.nic.travel", "Not found"),
			"my"=>  array("whois.mynic.my", "does not exist in database"),
			"commy"=>  array("whois.mynic.my", "does not exist in database"),
			"netmy"=>  array("whois.mynic.my", "does not exist in database"),
			"orgmy"=>  array("whois.mynic.my", "does not exist in database"),
			"edumy"=>  array("whois.mynic.my", "does not exist in database"),
			"govmy"=>  array("whois.mynic.my", "does not exist in database"),
			"comph"=>  array("http://www2.dot.ph/WhoIs.asp?Domain=", "HTTPREQUEST-is still available"),
			"netph"=>  array("http://www2.dot.ph/WhoIs.asp?Domain=", "HTTPREQUEST-is still available"),
			"orgph"=>  array("http://www2.dot.ph/WhoIs.asp?Domain=", "HTTPREQUEST-is still available"),
			"ngoph"=>  array("http://www2.dot.ph/WhoIs.asp?Domain=", "HTTPREQUEST-is still available"),
			"ph"=>  array("http://www2.dot.ph/WhoIs.asp?Domain=", "HTTPREQUEST-is still available"),
			"tv"=>  array("whois.nic.tv", "No match for"),
			"pt"=>  array("whois.dns.pt", "no match"),
			"compt"=>  array("whois.dns.pt", "no match"),
			"edupt"=>  array("whois.dns.pt", "no match"),
			"in"=>  array("whois.inregistry.in", "NOT FOUND"),
			"me"=>  array("whois.meregistry.net", "NOT FOUND"),
			"asia"=>  array("whois.nic.asia", "NOT FOUND"),
			"fi"=>  array("whois.ficora.fi", "Domain not found"),
			"zanet"=>  array("http://www.za.net/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-No such domain"),
			"zaorg"=>  array("http://www.za.net/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-No such domain"),
			"comve"=>  array("whois.nic.ve", "No match for"),
			"netve"=>  array("whois.nic.ve", "No match for"),
			"orgve"=>  array("whois.nic.ve", "No match for"),
			"webve"=>  array("whois.nic.ve", "No match for"),
			"infove"=>  array("whois.nic.ve", "No match for"),
			"cove"=>  array("whois.nic.ve", "No match for"),
			"tel"=>  array("whois.nic.tel", "Not found"),
			"im"=>  array("whois.nic.im", "was not found"),
			"gr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"comgr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"netgr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"orggr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"edugr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"govgr"=>  array("http://grwhois.ics.forth.gr:800/plainwhois/plainWhois?domainName=", "HTTPREQUEST-not exist"),
			"ir"=>  array("whois.nic.ir", "no entries found"),
			"ru"=>  array("whois.ripn.net", "No entries found"),
			"ppru"=>  array("whois.ripn.net", "No entries found"),
			"netru"=>  array("whois.ripn.net", "No entries found"),
			"orgru"=>  array("whois.ripn.net", "No entries found"),
			"spbru"=>  array("whois.relcom.ru", "No entries found"),
			"mskru"=>  array("whois.relcom.ru", "No entries found"),
			"su"=>  array("whois.ripn.net", "No entries found"),
			"comru"=>  array("whois.ripn.net", "No entries found"),
			"comua"=>  array("whois.net.ua", "No entries found"),
			"lvivua"=>  array("whois.net.ua", "No entries found"),
			"dnua"=>  array("whois.net.ua", "No entries found"),
			"khua"=>  array("whois.net.ua", "No entries found"),
			"lgua"=>  array("whois.net.ua", "No entries found"),
			"netua"=>  array("whois.net.ua", "No entries found"),
			"orgua"=>  array("whois.net.ua", "No entries found"),
			"kievua"=>  array("whois.net.ua", "No entries found"),
			"co"=>  array("whois.crsnic.net", "No match for"),
			"netco"=>  array("whois.nic.co", "Not found"),
			"comco"=>  array("whois.nic.co", "Not found"),
			"nomco"=>  array("whois.nic.co", "Not found"),
			"edusg"=>  array("whois.nic.net.sg", "Domain Not Found"),
			"comgt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"netgt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"orggt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"indgt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"edugt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"gobgt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"milgt"=>  array("http://www.gt/cgi-bin/whois.cgi?domain=", "HTTPREQUEST-DOMINIO NO REGISTRADO"),
			"pro"=>  array("whois.registrypro.pro", "NOT FOUND"),
			"re"=>  array("whois.nic.re", "No entries found"),
			"pm"=>  array("whois.nic.pm", "No entries found"),
			"tf"=>  array("whois.nic.tf", "No entries found"),
			"wf"=>  array("whois.nic.wf", "No entries found"),
			"yt"=>  array("whois.nic.yt", "No entries found"),
			"xxx"=>  array("whois.nic.xxx", "NOT FOUND"),
			"hu"=>  array("whois.nic.hu", "No match"),
			"acke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"coke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"orke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"neke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"mobike"=>  array("whois.kenic.or.ke", "No Object Found"),
			"infoke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"goke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"meke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"scke"=>  array("whois.kenic.or.ke", "No Object Found"),
			"gd"=>  array("whois.nic.gd", "not found..."),
			"rs"=>  array("whois.rnids.rs", "%ERROR:103"),
			"cors"=>  array("whois.rnids.rs", "%ERROR:103"),
			"orgrs"=>  array("whois.rnids.rs", "%ERROR:103"),
			"edurs"=>  array("whois.rnids.rs", "%ERROR:103"),
			"inrs"=>  array("whois.rnids.rs", "%ERROR:103"),
			"ae"=>  array("whois.aeda.net.ae", "No Data Found"),
			"pw"=>  array("whois.nic.pw", "DOMAIN NOT FOUND"),
			"cat"=>  array("whois.cat", "NOT FOUND"),
			"milid"=>  array("whois.idnic.net.id", "Not found"),
			"goid"=>  array("whois.idnic.net.id", "Not found"),
			"fm"=>  array("whois.nic.fm", "Not Registered"),
			"mn"=>  array("whois.afilias-grs.info", "NOT FOUND"),
			"sx"=>  array("whois.sx", "Status: AVAILABLE"),
			"pa"=>  array("http://www.nic.pa/whois.php?nombre_d=", "HTTPREQUEST-esta disponible para ser Registrado"),
			"compa"=>  array("http://www.nic.pa/whois.php?nombre_d=", "HTTPREQUEST-esta disponible para ser Registrado"),
			"netpa"=>  array("http://www.nic.pa/whois.php?nombre_d=", "HTTPREQUEST-esta disponible para ser Registrado"),
			"orgpa"=>  array("http://www.nic.pa/whois.php?nombre_d=", "HTTPREQUEST-esta disponible para ser Registrado"),
			"equipment"=>  array("whois.donuts.co", "Domain not found"),
			"gallery"=>  array("whois.donuts.co", "Domain not found"),
			"graphics"=>  array("whois.donuts.co", "Domain not found"),
			"lighting"=>  array("whois.donuts.co", "Domain not found"),
			"photography"=>  array("whois.donuts.co", "Domain not found"),
			"directory"=>  array("whois.donuts.co", "Domain not found"),
			"technology"=>  array("whois.donuts.co", "Domain not found"),
			"today"=>  array("whois.donuts.co", "Domain not found"),
			"bike"=>  array("whois.donuts.co", "Domain not found"),
			"clothing"=>  array("whois.donuts.co", "Domain not found"),
			"guru"=>  array("whois.donuts.co", "Domain not found"),
			"plumbing "=>  array("whois.donuts.co", "Domain not found"),
			"singles"=>  array("whois.donuts.co", "Domain not found"),
			"camera"=>  array("whois.donuts.co", "Domain not found"),
			"estate"=>  array("whois.donuts.co", "Domain not found"),
			"construction"=>  array("whois.donuts.co", "Domain not found"),
			"contractors"=>  array("whois.donuts.co", "Domain not found"),
			"kitchen"=>  array("whois.donuts.co", "Domain not found"),
			"land"=>  array("whois.donuts.co", "Domain not found"),
			"enterprises"=>  array("whois.donuts.co", "Domain not found"),
			"holdings"=>  array("whois.donuts.co", "Domain not found"),
			"ventures"=>  array("whois.donuts.co", "Domain not found"),
			"diamonds"=>  array("whois.donuts.co", "Domain not found"),
			"voyage"=>  array("whois.donuts.co", "Domain not found"),
			"photos"=>  array("whois.donuts.co", "Domain not found"),
			"shoes"=>  array("whois.donuts.co", "Domain not found"),
			"careers"=>  array("whois.donuts.co", "Domain not found"),
			"recipes"=>  array("whois.donuts.co", "Domain not found"),
			"cm"=>  array("whois.netcom.cm", "Not Registered"),
			"gs"=>  array("whois.nic.gs", "No Object Found"),
			"ms"=>  array("whois.nic.ms", "No Object Found"),
			"sh"=>  array("whois.nic.sh", "is available for purchase"),
			"tm"=>  array("whois.nic.tm", "is available for purchase"),
			"vg"=>  array("whois.adamsnames.tc", "No Object Found"),
			"ac"=>  array("whois.nic.ac", "is available for purchase"),
			"tc"=>  array("whois.adamsnames.tc", "No Object Found"),
			"ee"=>  array("whois.tld.ee", "no entries found"),
			"academy"=>  array("whois.donuts.co", "Domain not found."),
			"agency"=>  array("whois.donuts.co", "Domain not found."),
			"airforce"=>  array("whois.unitedtld.com", "Domain not found"),
			"archi"=>  array("whois.ksregistry.net", "not found"),
			"arpa"=>  array("whois.iana.org", "0 objects"),
			"associates"=>  array("whois.donuts.co", "Domain not found"),
			"ax"=>  array("whois.ax", "No records matching"),
			"bargains"=>  array("whois.donuts.co", "Domain not found."),
			"berlin"=>  array("whois.nic.berlin", "No match"),
			"blue"=>  array("whois.afilias.net", "NOT FOUND"),
			"boutique"=>  array("whois.donuts.co", "Domain not found."),
			"builders"=>  array("whois.donuts.co", "Domain not found"),
			"build"=>  array("whois.nic.build ", "No Data Found"),
			"buzz"=>  array("whois.nic.buzz", "Not found:"),
			"cab"=>  array("whois.donuts.co", "Domain not found."),
			"camp"=>  array("whois.donuts.co", "Domain not found."),
			"capetown"=>  array("whois.nic.capetown", "Available"),
			"center"=>  array("whois.donuts.co", "Domain not found."),
			"cheap"=>  array("whois.donuts.co", "Domain not found."),
			"club"=>  array("whois.nic.club", "Not found"),
			"codes"=>  array("whois.donuts.co", "Domain not found."),
			"coffee"=>  array("whois.donuts.co", "Domain not found"),
			"company"=>  array("whois.donuts.co", "Domain not found."),
			"computer"=>  array("whois.donuts.co", "Domain not found."),
			"cool"=>  array("whois.donuts.co", "Domain not found"),
			"durban"=>  array("whois.nic.durban", "Available"),
			"education"=>  array("whois.donuts.co", "Domain not found."),
			"email"=>  array("whois.donuts.co", "Domain not found."),
			"expert"=>  array("whois.donuts.co", "Domain not found"),
			"exposed"=>  array("whois.donuts.co", "Domain not found."),
			"farm"=>  array("whois.donuts.co", "Domain not found."),
			"flights"=>  array("whois.donuts.co", "Domain not found"),
			"florist"=>  array("whois.donuts.co", "Domain not found."),
			"futbol"=>  array("whois.unitedtld.com", "Domain not found"),
			"gift"=>  array("whois.uniregistry.net", "is available for registration"),
			"glass"=>  array("whois.donuts.co", "Domain not found."),
			"guitars"=>  array("whois.uniregistry.net", "is available for registration"),
			"holiday"=>  array("whois.donuts.co", "Domain not found."),
			"house"=>  array("whois.donuts.co", "Domain not found."),
			"ink"=>  array("whois.donuts.co", "Domain not found"),
			"institute"=>  array("whois.donuts.co", "Domain not found."),
			"international"=>  array("whois.donuts.co", "Domain not found."),
			"joburg"=>  array("whois.nic.joburg", "Available"),
			"kim"=>  array("whois.afilias.net", "NOT FOUND"),
			"limo"=>  array("whois.donuts.co", "Domain not found."),
			"link"=>  array("whois.uniregistry.net", "is available for registration"),
			"luxury"=>  array("whois.nic.luxury", "No Data Found"),
			"maison"=>  array("whois.donuts.co", "Domain not found"),
			"management"=>  array("whois.donuts.co", "Domain not found."),
			"marketing"=>  array("whois.donuts.co", "Domain not found."),
			"menu"=>  array("whois.nic.menu", "No Data Found"),
			"moda"=>  array("whois.nic.moda", "Domain not found"),
			"ninja"=>  array("whois.nic.ninja", "Domain not found"),
			"onl"=>  array("whois.donuts.co", "Domain not found"),
			"pics"=>  array("whois.uniregistry.net", "is available for registration"),
			"pink"=>  array("whois.afilias.net", "NOT FOUND"),
			"repair"=>  array("whois.donuts.co", "Domain not found."),
			"sexy"=>  array("whois.uniregistry.net", "is available for registration"),
			"shiksha"=>  array("whois.nic.shiksha", "NOT FOUND"),
			"social"=>  array("whois.donuts.co", "Domain not found"),
			"solar"=>  array("whois.donuts.co", "Domain not found."),
			"solutions"=>  array("whois.donuts.co", "Domain not found."),
			"supplies"=>  array("whois.donuts.co", "Domain not found."),
			"supply"=>  array("whois.donuts.co", "Domain not found."),
			"support"=>  array("whois.donuts.co", "Domain not found."),
			"systems"=>  array("whois.donuts.co", "Domain not found."),
			"tips"=>  array("whois.donuts.co", "Domain not found."),
			"training"=>  array("whois.donuts.co", "Domain not found"),
			"training"=>  array("whois.donuts.co", "Domain not found."),
			"uno"=>  array("whois.uno.nic", "Not found"),
			"viajes"=>  array("whois.donuts.co", "Domain not found."),
			"wiki"=>  array("whois.donuts.co", "Domain not found"),
			"work"=>  array("whois-dub.mm-registry.com", "Not Registered"),
			"zone"=>  array("whois.donuts.co", "Domain not found."),
			"cozw"=>  array("http://zispa.co.zw/cgi-bin/search?domain=", "HTTPREQUEST-is available for registration"),
			"coop"=>  array("whois.nic.coop", "No domain records were found"),
			"coid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"desaid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"webid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"acid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"orid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"schid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"myid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"bizid"=>  array("whois.pandi.or.id", "DOMAIN NOT FOUND"),
			"milid"=>  array("whois.idnic.net.id", "Not found"),
			"goid"=>  array("whois.idnic.net.id", "Not found"),
			"privno"=>  array("whois.norid.no", "No match"),
			"idrettno"=>  array("whois.norid.no", "No match"),
			"attorney"=>  array("whois.rightside.co", "Domain not found"),
			"world"=>  array("whois.donuts.co", "Domain not found")
		);

	
		// gethostbyname returns the same string if it cant find the domain,
		// we do a further check to see if it is a false positive
		//if (gethostbyname($domain) == $domain) {
			// get the TLD of the domain
			$tld = $this->get_tld($domain);

			// If an entry for the TLD exists in the whois array
			if (isset($whois_arr[$tld][0])) {
				// set the hostname for the whois server
				$whois_server = $whois_arr[$tld][0];

				// set the "domain not found" string
				$bad_string = $whois_arr[$tld][1];
			} else {
				// TODO: REFACTOR THIS
				// TLD is not in the whois array, die
				//throw new Exception("WHOIS server not found for that TLD");
				return '2';
			}

			$status = $this->checkDomainNameAvailabilty($domain,$whois_server,$bad_string);

			return $status;
		//} else {
			// not available
		//	return FALSE;
		//}

}
	

	/**
	 * Extracts the TLD from a domain, supports URLS with "www." at the beginning.
	 *
	 * @author  Helge Sverre <email@helgesverre.com>
	 *
	 * @param string $domain The domain that will get it's TLD extracted
	 * @return string The TLD for $domain
	 */

	public function get_tld ($domain) {
		$split = explode('.', $domain);

		if(count($split) === 0) {
			throw new Exception('Invalid domain extension');
			
		}
		return end($split);
	}

	public function checkDomainNameAvailabilty($domain_name, $whois_server, $find_text){
 
    // Open a socket connection to the whois server
    $con = fsockopen($whois_server, 43);
    if (!$con) return false;
 
    // Send the requested domain name
    fputs($con, $domain_name."\r\n");
 
    // Read and store the server response
    $response = " :";
    while(!feof($con))
        $response .= fgets($con,128); 
 
    // Close the connection
    fclose($con);
 
    // Check the Whois server response
    if (strpos($response, $find_text))
	return '1';
    else
    return '0';
	}
}

