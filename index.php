<? // $Id$

$recv = "";
if (isset($_POST['haslo']))
{
    $h = $_POST['haslo'];
    $h = trim($h);

    if ($h == '')
    {
        $recv = "Musisz co� wpisa�!";
    }
    elseif (isset($_POST['action']) && $_POST['action']=='enc')
    {
    $h = substr($h,0,24); // truncate
    $h = escapeshellarg($h);
        $dec = chop(`perl encode.pl $h`);
        $recv = "Zakodowane has�o $h ma posta� '$dec'";
    }
    else
    {
        $h = substr($h,0,48); // truncate
        $h = escapeshellarg($h);
        $dec = chop(`perl decode.pl $h`);
        $recv = "Dla klucza $h has�o prawdopodobnie brzmi '$dec'";
    }

    $recv = "<hr><span style='color: #558899; font-weight: bold'>$recv</span><br>";

}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<title>Platnik - haslo</title>
<style type="text/css">
body,a:link,a:visited,td
{
    font-family: Tahoma, Helvetica, sans-serif;
    font-size: 10pt;
    color: #557799;
    vertical-align: baseline;
}
a:hover
{
    color: #7799bb;
}

span.tt
{
    white-space: nowrap;
    font-family: Courier, monospace;
    color: black;
    background-color: #eeeeee;
}
</style>
</head>
<body>
<center>
<h2>Odzyskiwanie hase� w P�atniku 5 i 6</h2>
</center>
<?=$recv ?>
<hr>
<p>Je�li zapomnia�e�/zapomnia�a� has�a administratora w Programie P�atnika
mo�esz je �atwo odzyska� (dotyczy to tak�e has�a <b>ostatniej</b> u�ytej
bazy danych).
<p>
<b>Uwaga</b>: Misie z firmy Koala (ja nie mam z nimi nic wspolnego!) na podstawie ponizszych informacji napisaly program,
ktory odzyskuje hasla Platnika. Programik jest darmowy i mozna go znalezc tutaj:
<b><a href="http://koala.pl/Index2.php?page=KoalaRatownik&amp;lang=pl">Koala Ratownik</a></b>

<p>Has�a trzymane s� w rejestrze systemu Windows, has�o administratora w kluczu
<span class="tt">HKEY_LOCAL_MACHINE\SOFTWARE\PROKOM Software SA\P�atnik\5.01.001\Admin</span>
w kolejnych warto�ciach AdmXX (ka�da zmiana has�a dodaje 1 wpis, <b>aktualne has�o
znajduje si� w polu AdmXX o najwi�kszej warto�ci XX</b>).
Przy instalacji wype�nianych jest kilka warto�ci pocz�tkowych, do
Adm1 wpisywana jest aktaulna data, do Adm2 i 3 - imi� i nazwisko
administratora, do Adm4 pocz�tkowe has�o.
Przy zmianie has�a do starego dopisywany jest znak '1'. Has�o mo�e mie� maksymalnie 24 znaki.
<p>
Has�o bazy danych (ostatniej u�ytej) znajduje si� w kluczu
<span class="tt">HKEY_LOCAL_MACHINE\SOFTWARE\PROKOM Software SA\P�atnik\5.01.001\Baza</span>,
pole <span class="tt">Jet OLEDB:Database Password</span>.
<p>
Hasla s� "zaszyfrowane", to znaczy zakodowane w prosty do odkodowania spos�b.
Aby odtworzy� has�o mo�esz skorzysta� z formularza albo u�y� zamieszczonego ni�ej
skryptu.
<p>
Przyk�adowe has�o wygl�da tak: lzpovzyswnvw (w postaci odkodowanej - "haslo2")
<p>
Tip 1: informacja otrzymana od EMPI'ego: mo�na zwalczy� wymuszanie zmiany
has�a co miesi�c ustawiaj�c w kluczu <span class="tt">HKLM\SOFTWARE\PROKOM Software SA\P�atnik\6.01.001\Parametry\LimitHas�a</span>
wi�ksza liczb� dni wa�no�ci has�a (domy�lnie jest 30).
<p>
Tip 2: usuwanie hase� baz MS Access (czyli to w�a�nie Ci� interesuje je�li np. przeinstalowa�e� system a teraz nie pami�tasz hase� do bazy p�atnika)
<ul>
<li><a href="http://www.access.vis.pl/zab001.htm">http://www.access.vis.pl/zab001.htm</a>
(odpowiednie pliki to:
<a href="http://www.access.vis.pl/zabezp/czytaj97.zip">czytaj97.zip</a> [<a href='czytaj97.zip'>kopia lokalna</a>]
i
<a href="http://www.access.vis.pl/zabezp/czytaj2k.zip">czytaj2k.zip</a> [<a href='czytaj2k.zip'>kopia lokalna</a>])
<li><a href="http://www.lostpassword.com/access.htm">http://www.lostpassword.com/access.htm</a>
<li><a href="http://www.elcomsoft.com/acpr.html">http://www.elcomsoft.com/acpr.html</a>
</ul>
<p>
Tip 3: je�li wydaje ci si�, �e znasz has�o do bazy, a mimo to P�atnik nie chce otworzy�
bazy danych - sprawd� czy plik .mdb nie ma ustwionego atrybutu "tylko do
odczytu"
<p>
Tip 4: Skrypty przerobione na C++: <a
href="http://www.mariano.is.net.pl/mariano/index.php?go=platnik">http://www.mariano.is.net.pl/mariano/index.php?go=platnik</a>
<hr>
W razie problem�w:
<ul>
<li>przeczytaj jeszcze raz to co jest napisane na tej stronie</li>
<li>przeczytaj <a href='http://rtfm.bsdzine.org'>jak m�drze zadawa� pytania</a></li>
<li>napisz do mnie maila z m�drze zadanym pytaniem: <a href="mailto:mg@fork.pl">mg@fork.pl</a></li>
</ul>
<hr>

<table border="0">
<tr>
<td>dekodowanie has�a:
<td>
<form action="index.php" method="post">
<input type="text" name="haslo"><input type="submit" value="ok"><input type="hidden" name="action" value="dec">
</form>

<tr>
<td>kodowanie has�a:
<td>
<form action="index.php" method="post">
<input type="text" name="haslo"><input type="submit" value="ok"><input type="hidden" name="action" value="enc">
</form>

</table>

<br>
<span style="color: #558899; font-weight: bold">
<?=$recv ?>
</span>
<hr>
<pre>
<? readfile("decode.pl"); ?>
</pre>
<hr>
<pre>
<? readfile("encode.pl"); ?>
</pre>
<hr>
<div style="text-align: right"><a href="mailto:mg@fork.pl">mg@fork.pl</a><br>
<a href="http://validator.w3.org/check?uri=referer">[Valid HTML]</a><br>
<span style="font-family: monospace; ">$Id$</span>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-896002-2");
pageTracker._initData();
pageTracker._trackPageview();
</script>

</body>
</html>
