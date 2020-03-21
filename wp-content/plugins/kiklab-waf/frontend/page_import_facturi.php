<?php


#####------------------------------------
##### PAGE import_facturi
#####------------------------------------?>
		
	<div class="kik_company_fields_title">Import facturi</div>
	
	<div id="UploadStuff">
		<div id="UploadFacturi_message"></div>
		<p><b><u>Reguli fișier:</u></b><br />
		<ul>
			<li><p>format: .CSV</p></li>
			<li><p>separator de coloane: <span class="kik_code">,</span> (virgulă)</p></li>
			<li><p>separator de linii: <span class="kik_code">CRLF</span> (linie nouă)</p></li>
			<li><p>caracterul <span class="kik_code">"</span> (ghilimele) trebuie dublat - <span class="kik_code">O "adresa" exemplu.</span> devine <span class="kik_code">O ""adresa"" exemplu.</span></p></li>
			<li><p>câmpurile care conțin <span class="kik_code">,</span> (virgulă), <span class="kik_code">"</span> (ghilimele) sau <span class="kik_code">CRLF</span> (linie nouă) trebuie puse între <span class="kik_code">""</span> (ghilimele) - <span class="kik_code">O ""adresa"", de exemplu.</span> devine <span class="kik_code">"O ""adresa"", de exemplu."</span></p></li>
			<li><p>mai multe informații despre formatul CSV: <a target="_blank" href="http://profs.info.uaic.ro/~alaiba/mw/index.php?title=Formatul_CSV">http://profs.info.uaic.ro/~alaiba/mw/index.php?title=Formatul_CSV</a></p></li>
			<li><p><b><u>coloane (5):</u></b></p>
				<ol>
					<li><p>CUI/CIF Companie</p></li>
					<li><p>Data</p></li>
					<li><p>Număr</p></li>
					<li><p>Valoare</p></li>
					<li><p>Achitat ("DA" / "NU")</p></li>
				</ol>
			</p></li>
			<li><p><b><u>reguli de upload:</u></b></p>
				<ul>
					<li><p>facturile cu același număr existente deja la compania țintă vor fi suprascrise</p></li>
					<li><p>facturile cu același număr existente deja la o altă companie vor fi ignorate</p></li>
				</ul>
			</p></li>
		</ul>
		&nbsp;<br />
		&nbsp;<br />
		Descarcă fișier exemplu: <button id="UploadFacturi_example" onclick="window.location.href = '<?php echo KIK_PLUGIN_URLPATH . 'docs/download.php?filename=csv_example_facturi.csv'; ?>';">Descarcă fișier exemplu</button><br />
		&nbsp;<br />
		<form>Alege fișier: <input type="file" id="UploadFacturi_choose" required /></form><br />
		&nbsp;<br />
		Import: <button id="UploadFacturi_submit">IMPORT</button> <span id="UploadFacturi_button_message"></span><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<br />
	</div>
