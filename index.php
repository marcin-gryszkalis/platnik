<? // $Id$

$recv = "";
if (isset($_POST['haslo']))
{
    $h = $_POST['haslo'];
    $h = trim($h);
    
    if ($h == '')
    {
        $recv = "Musisz coś wpisać!";
    }
    elseif (isset($_POST['action']) && $_POST['action']=='enc')
    {
        $h = substr($h,0,24); // truncate
        $h = escapeshellarg($h);
        $dec = chop(`/usr/bin/perl encode.pl $h`);
        $recv = "Zakodowane hasło '$h' ma postać '$dec'";
    }
    else
    {
        $h = substr($h,0,48); // truncate
print_r("xxx".$h);
        $h = escapeshellarg($h);
print_r("xxx".$h);
        $dec = chop(`/usr/bin/perl decode.pl $h`);
        $recv = "Dla klucza '$h' hasło prawdopodobnie brzmi '$dec'";
    }

    $recv = "<hr><span style='color: #558899; font-weight: bold'>$recv</span><br>";

}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=utf-8">
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
<h2>Odzyskiwanie haseł w Płatniku 5+</h2>
</center>
<?=$recv ?>
<hr>
<p>Jeśli zapomniałeś/zapomniałaś hasła administratora w Programie Płatnika
możesz je łatwo odzyskać (dotyczy to także hasła <b>ostatniej</b> użytej
bazy danych).
<p>
<b>Uwaga</b>: Misie z firmy Koala (ja nie mam z nimi nic wspolnego!) na podstawie ponizszych informacji napisaly program,
ktory odzyskuje hasla Platnika. Programik jest darmowy i mozna go znalezc tutaj:
<b><a href="http://koala.pl/Index2.php?page=KoalaRatownik&amp;lang=pl">Koala Ratownik</a></b>
<p>
<b>Uwaga</b>: Innym darmowym programem, który potrafi odplątać problemy z Płanikiem jest od-Plątnik autorstwa JBW:
<b>od-<a href="http://www.jbw.pl/pphas/">Plątnik</a></b>
<hr>
<p>Hasła trzymane są w rejestrze systemu Windows, hasło administratora w kluczu
<span class="tt">HKEY_LOCAL_MACHINE\SOFTWARE\PROKOM Software SA\Płatnik\5.01.001\Admin</span>
w kolejnych wartościach AdmXX (każda zmiana hasła dodaje 1 wpis, <b>aktualne hasło
znajduje się w polu AdmXX o największej wartości XX</b>).
Przy instalacji wypełnianych jest kilka wartości początkowych, do
Adm1 wpisywana jest aktaulna data, do Adm2 i 3 - imię i nazwisko
administratora, do Adm4 początkowe hasło.
Przy zmianie hasła do starego dopisywany jest znak '1'. Hasło może mieć maksymalnie 24 znaki.
<p>
Hasło bazy danych (ostatniej użytej) znajduje się w kluczu
<span class="tt">HKEY_LOCAL_MACHINE\SOFTWARE\PROKOM Software SA\Płatnik\5.01.001\Baza</span>,
pole <span class="tt">Jet OLEDB:Database Password</span>.
<p>
Hasla są "zaszyfrowane", to znaczy zakodowane w prosty do odkodowania sposób.
Aby odtworzyć hasło możesz skorzystać z formularza albo użyć zamieszczonego niżej
skryptu.
<p>
Przykładowe hasło wygląda tak: lzpovzyswnvw (w postaci odkodowanej - "haslo2")
<p>
Tip 1: informacja otrzymana od EMPI'ego: można zwalczyć wymuszanie zmiany
hasła co miesiąc ustawiając w kluczu <span class="tt">HKLM\SOFTWARE\PROKOM Software SA\Płatnik\6.01.001\Parametry\LimitHasła</span>
większa liczbę dni ważności hasła (domyślnie jest 30).
<p>
Tip 2: usuwanie haseł baz MS Access (czyli to właśnie Cię interesuje jeśli np. przeinstalowałeś system a teraz nie pamiętasz haseł do bazy płatnika)
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
Tip 3: jeśli wydaje ci się, że znasz hasło do bazy, a mimo to Płatnik nie chce otworzyć
bazy danych - sprawdź czy plik .mdb nie ma ustwionego atrybutu "tylko do
odczytu"
<p>
Tip 4: Skrypty przerobione na C++: <a
href="http://www.mariano.is.net.pl/mariano/index.php?go=platnik">http://www.mariano.is.net.pl/mariano/index.php?go=platnik</a>
<hr>
W razie problemów:
<ul>
<li>przeczytaj jeszcze raz to co jest napisane na tej stronie</li>
<li>przeczytaj <a href='http://rtfm.killfile.pl/'>jak mądrze zadawać pytania</a></li>
<li>napisz do mnie maila z mądrze zadanym pytaniem: <a href="mailto:mg@fork.pl">mg@fork.pl</a></li>
</ul>
<hr>

<table border="0">
<tr>
<td>dekodowanie hasła:
<td>
<form action="index.php" method="post">
<input type="text" name="haslo"><input type="submit" value="ok"><input type="hidden" name="action" value="dec">
</form>

<tr>
<td>kodowanie hasła:
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
