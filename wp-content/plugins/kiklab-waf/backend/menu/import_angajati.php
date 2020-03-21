<?php


#####------------------------------------
##### ADMIN PAGE: Import angajati
#####------------------------------------


?>
	
	<div class="wrap">
		<h2>Import angajați</h2>
		<br />
		<div id="UploadStuff">
			<div id="UploadStuff_message"></div>
			<p><b><u>Reguli fișier:</u></b><br />
			<ul>
				<li><p>format: .CSV</p></li>
				<li><p>separator de coloane: <span class="kik_code">,</span> (virgulă)</p></li>
				<li><p>separator de linii: <span class="kik_code">CRLF</span> (linie nouă)</p></li>
				<li><p>caracterul <span class="kik_code">"</span> (ghilimele) trebuie dublat - <span class="kik_code">O "adresa" exemplu.</span> devine <span class="kik_code">O ""adresa"" exemplu.</span></p></li>
				<li><p>câmpurile care conțin <span class="kik_code">,</span> (virgulă), <span class="kik_code">"</span> (ghilimele) sau <span class="kik_code">CRLF</span> (linie nouă) trebuie puse între <span class="kik_code">""</span> (ghilimele) - <span class="kik_code">O ""adresa"", de exemplu.</span> devine <span class="kik_code">"O ""adresa"", de exemplu."</span></p></li>
				<li><p>mai multe informații despre formatul CSV: <a target="_blank" href="http://profs.info.uaic.ro/~alaiba/mw/index.php?title=Formatul_CSV">http://profs.info.uaic.ro/~alaiba/mw/index.php?title=Formatul_CSV</a></p></li>
				<li><p><b><u>coloane (8):</u></b></p>
					<ol>
						<li><p>CUI/CIF Companie</p></li>
						<li><p>Nume</p></li>
						<li><p>Prenume</p></li>
						<li><p>Functie</p></li>
						<li><p>CNP</p></li>
						<li><p>Adresa</p></li>
						<li><p>Data incepere contract (format: "AAAA-LL-ZZ")</p></li>
						<li><p>Data incetare contract (format: "AAAA-LL-ZZ")</p></li>
					</ol>
				</p></li>
				<li><p><b><u>reguli de upload:</u></b></p>
					<ul>
						<li><p>angajații cu același CNP existenți deja la compania țintă vor fi suprascriși</p></li>
						<li><p>angajații cu același CNP existenți deja la o altă companie vor fi introduși separat și la compania țintă</p></li>
					</ul>
				</p></li>
			</ul>
			&nbsp;<br />
			&nbsp;<br />
			Descarcă fișier exemplu: <button id="UploadAngajati_example" onclick="window.location.href = '<?php echo KIK_PLUGIN_URLPATH . 'docs/download.php?filename=csv_example_angajati.csv'; ?>';">Descarcă fișier exemplu</button><br />
			&nbsp;<br />
			<form>Alege fișier: <input type="file" id="UploadAngajati_choose" required /></form><br />
			&nbsp;<br />
			Import: <button id="UploadAngajati_submit">IMPORT</button> <span id="UploadAngajati_button_message"></span><br />
			&nbsp;<br />
			&nbsp;<br />
			&nbsp;<br />
			&nbsp;<br />
		</div>
	</div>
	
<?php










/**/

?>