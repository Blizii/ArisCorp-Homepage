
<?php
// C2 HERCULES STARLIFTER
$json = file_get_contents('https://api.starcitizen-api.com/fa36fd91b9c62b2aeccc06741ecde9ce/v1/live/ships?name=C2&20Hercules');
$obj = json_decode($json);

// Schiff Werte
$c2cargo = $obj->data[0]->cargocapacity;
$c2lenght = $obj->data[0]->length;
$c2beam = $obj->data[0]->beam;
$c2height = $obj->data[0]->height;
$c2mass = $obj->data[0]->mass;
$c2scm = $obj->data[0]->scm_speed;
$c2url = $obj->data[0]->url;
$c2afterburner = $obj->data[0]->afterburner_speed;
$c2zacc = $obj->data[0]->zaxis_acceleration;
$c2xacc = $obj->data[0]->xaxis_acceleration;
$c2yacc = $obj->data[0]->yaxis_acceleration;
?>
<?php
$crusaderexcurs = 'https://www.ariscorp.de/sites/excurs/firmen/herrsteller/schiffe/Crusader_Industries.php';
?>
<html>
<!-- //// HEAD INCLUDE //// -->
    <?php include('https://www.ariscorp.de/php/includes/head.php'); ?>
    <?php include('http://dev.ariscorp.de/assets/css/shipdatabase.php'); ?>
<!-- //// END HEAD INCLUDE //// -->
    <body>

        <!-- //// HEADER INCLUDE //// -->
            <?php include('https://www.ariscorp.de/php/includes/header.php'); ?>
        <!-- //// END HEADER INCLUDE //// -->

        <!-- /// Main Container /// -->
    <div class="container" style="max-width: 1500px">

<!-- /// EXCURS SECTION /// -->

<div id="excurs" class='large-margin'>
    <a href="excurs"></a><!-- Nav Anchor -->
    <div class="row heading tiny-margin">
    </div>
    <div class="row medium-margin tab-manifesto">
        <!-- Site Text -->
        <div>
        <div id="mw-content-text" lang="en" dir="ltr" class="mw-content-ltr">
  <div class="mw-parser-output">
    <table class="infobox mw-collapsible floatright" style="width:450px;">
      <tbody style="background-color: #101010;">
        <tr class="infobox-image">
          <td colspan="2" style="text-align:center;"><a href="/File:C2Starlifter_FrontTop_Concept.png" class="image"><img alt="C2Starlifter FrontTop Concept.png" src="http://dev.ariscorp.de/assets/img/excurs/shipdatabase/cover/hercules/c2/C2Starlifter_FrontTop_Concept.png" width="450" height="253" class="lazy" loading="lazy" data-src="/images/thumb/9/99/C2Starlifter_FrontTop_Concept.png/450px-C2Starlifter_FrontTop_Concept.png" data-srcset="/images/thumb/9/99/C2Starlifter_FrontTop_Concept.png/675px-C2Starlifter_FrontTop_Concept.png 1.5x, /images/thumb/9/99/C2Starlifter_FrontTop_Concept.png/900px-C2Starlifter_FrontTop_Concept.png 2x" data-file-width="1920" data-file-height="1080" /></a></td>
        </tr>
        <tr class="infobox-title">
          <th colspan="2" style="text-align:center"><a target="_blank" href="https://robertsspaceindustries.com/pledge/ships/crusader-starlifter/C2-Hercules" style="color: white;">C2 Hercules</a><style data-mw-deduplicate="TemplateStyles:r136813">
              .mw-parser-output .infobox-title-container {
                display: flex;
                justify-content: space-between;
                align-items: center
              }

              .mw-parser-output .infobox-title-container img {
                opacity: .7
              }

              .mw-parser-output .infobox-title-container img.inverted {
                filter: invert(1)hue-rotate(180deg)
              }

              @media(prefers-color-scheme:dark) {
                .mw-parser-output .infobox-title-container img {
                  filter: invert(1)hue-rotate(180deg)
                }

                .mw-parser-output .infobox-title-container img.inverted {
                  filter: none
                }
              }

            </style>
          </th>
        </tr>
        <tr class="data-manufacturer infobox-data infobox-col2">
          <th scope="row">Hersteller</th>
          <td><a href="<?php print_r($crusaderexcurs); ?>" title="Crusader Industries">Crusader Industries</a><span class="nowrap">&#160;</span>(CRUS)</td>
        </tr>
        <tr class="data-role infobox-data infobox-col2">
          <th scope="row">Rolle</th>
          <td>Schwertransport</td>
        </tr>
        <tr class="data-size infobox-data infobox-col2">
          <th scope="row">Größe</th>
          <td><a href="/Category:Large_ships" title="Category:Large ships">Groß (Large)</a></td>
        </tr>
        <tr class="data-crew infobox-data infobox-col2">
          <th scope="row">Crew</th>
          <td>1 – 2</td>
        </tr>
        <tr class="data-productionstate infobox-data infobox-col2">
          <th scope="row">Serie</th>
          <td><a href="/Category:Hercules_series" title="Category:Hercules series">Hercules</a></td>
        </tr>
        
        <tr class="data-cargocapacity infobox-data infobox-col2">
          <th scope="row">Fracht Menge</th>
          <td><?php print_r($c2cargo); ?></td>
        </tr>
        <tr class="data-productionstate infobox-data infobox-col2">
          <th scope="row">Produktionsstatus</th>
          <td>
            <div class="plainlist">
              <ul>
                <li>* In produktion <br> (release map: 3.13)</li>
              </ul>
            </div>
          </td>
        </tr>
        <tr class="data-loanervehicle infobox-data infobox-col2">
          <th scope="row">Loaner Schiff</th>
          <td><a href="/Mercury_Star_Runner" title="Mercury Star Runner">Mercury Star Runner</a>, <a href="/Caterpillar" title="Caterpillar">Caterpillar</a></td>
        </tr>
        

        <tr class="infobox-header">
          <th colspan="2" style="text-align:center">Pledge</th>
        </tr>
        <tr class="data-pledgecost infobox-data infobox-col4">
          <th scope="row">Standalone</th>
          <td>US$360</td>
        </tr>
        <tr class="data-originalpledgecost infobox-data infobox-col4">
          <th scope="row">Original</th>
          <td>US$360</td>
        </tr>
        <tr class="data-warbondcost infobox-data infobox-col4">
          <th scope="row">Warbond</th>
          <td>US$300</td>
        </tr>
        <tr class="data-originalwarbondcost infobox-data infobox-col4">
          <th scope="row">Original</th>
          <td>US$300</td>
        </tr>
        <tr class="data-pledgeavailability infobox-data infobox-col2">
          <th scope="row">Erhältlichkeit</th>
          <td>Nur zu Sale-Zeiten verfügbar</td>
        </tr>
        <tr class="infobox-header">
          <th colspan="2" style="text-align:center">Spezifikationen</th>
        </tr>
        <tr class="data-length infobox-data infobox-col4">
          <th scope="row">Länge</th>
          <td><?php print_r($c2lenght); ?> m</td>
        </tr>
        <tr class="data-beam infobox-data infobox-col4">
          <th scope="row">Breite</th>
          <td><?php print_r($c2beam); ?> m</td>
        </tr>
        <tr class="data-height infobox-data infobox-col4">
          <th scope="row">Höhe</th>
          <td><?php print_r($c2height); ?> m</td>
        </tr>
        <tr class="data-height infobox-data infobox-col4">
          <th scope="row">Gewicht</th>
          <td><?php print_r($c2mass); ?> kg</td>
        </tr>
        <tr class="data-combatspeed infobox-data infobox-col2">
          <th scope="row">S.C.M. Geschwindigkeit</th>
          <td><?php print_r($c2scm); ?> m/s</td>
        </tr>
        <tr class="data-combatspeed infobox-data infobox-col2">
          <th scope="row">Afterburner Geschwindigkeit</th>
          <td><?php print_r($c2afterburner); ?> m/s</td>
        </tr>
        <br>
        <tr class="data-combatspeed infobox-data infobox-col3">
          <th scope="row">X-Achse Beschleunigung</th>
          <td><?php print_r($c2xacc); ?> m/s</td>
        </tr>
        <tr class="data-combatspeed infobox-data infobox-col3">
          <th scope="row">Y-Achse Beschleunigung</th>
          <td><?php print_r($c2yacc); ?> m/s</td>
        </tr>
        <tr class="data-combatspeed infobox-data infobox-col3">
          <th scope="row">Z-Achse Beschleunigung</th>
          <td><?php print_r($c2zacc); ?> m/s</td>
        </tr>
        <tr class="infobox-button-bar">
          <th colspan="2" style="text-align:center">
            <div class="infobox-button noprint"><span>Mehr Informationen</span>
              <div class="infobox-extlink-list">
                <p>
                  <span class="infobox-extlink-title infobox-extlink-title-rsi">Offizielle Seiten</span>
                </p>
                <ul class="infobox-extlink-list-rsi">

                  <li class="infobox-extlink" id="rsistore"><a target="_blank" rel="nofollow noreferrer noopener" class="external text" href="https://robertsspaceindustries.com/pledge/ships/crusader-starlifter/C2-Hercules">Pledge store</a></li>
                  <li class="infobox-extlink" id="presentation"><a target="_blank" rel="nofollow noreferrer noopener" class="external text" href="https://robertsspaceindustries.com/comm-link/transmission/16550-Introducing-The-Hercules-Crusaders-Premier-Tactical-Starlifter">Presentation</a></li>
                  <li class="infobox-extlink" id="brochure"><a target="_blank" rel="nofollow noreferrer noopener" class="external text" href="https://robertsspaceindustries.com/media/rsmrf96ceweoir/source/Crusader-Hercules-Starlifter.pdf">Brochure</a></li>
                </ul>
                <p>
                  <span class="infobox-extlink-title infobox-extlink-title-community">Community Seiten</span>
                </p>
                <ul class="infobox-extlink-list-community">


                  <li class="infobox-extlink" id="starship42"><a target="_blank" rel="nofollow noreferrer noopener" class="external text" href="https://www.starship42.com/fleetview/single/?source=Star%20Citizen%20Wiki&amp;type=matrix&amp;style=colored&amp;s=C2+Hercules">StarShip 42</a></li>
                  <li class="infobox-extlink" id="fleetyards"><a target="_blank" rel="nofollow noreferrer noopener" class="external text" href="https://fleetyards.net/ships/c2-hercules">FleetYards</a></li>
                </ul>
              </div>
            </div>
          </th>
        </tr>
      </tbody>
    </table>
    <div id="tabber-8f2a9ec7099a0bdb7d947a4796a4a506" class="tabber">
			<div class="tabbertab" title="Avionics &amp; Systems">
				<p class="mw-empty-elt">
</p><table class="wikitable" style="margin-bottom:4px">
<tbody><tr>
<th id="sehreindutigeid" colspan="5"> <b>Avionics</b> </th>
</tr>
<tr>
<th> Komponenten</th>
<th> Hersteller</th>
<th> Modell</th>
<th> Größe (Maximal)</th>
<th> # per mount x total</th>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Radarnav.svg" class="image"><img alt="Radarnav.svg" src="https://starcitizen.tools/images/9/95/Radarnav.svg" width="15" height="15" /></a></div><a href="/Radars" class="mw-redirect" title="Radars">Radars</a></div></td>
<td> TBD</td>
<td> L Radar</td>
<td> Large (Large)</td> 
<td> 1 x 1</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Computernav.svg" class="image"><img alt="Computernav.svg" src="https://starcitizen.tools/images/8/8a/Computernav.svg" width="15" height="15" /></a></div><a href="/Computers" class="mw-redirect" title="Computers">Computers</a></div></td>
<td> TBD</td>
<td> M Computer</td>
<td> Medium (Medium)</td> 
<td> 1 x 1</td>
</tr>
</tbody></table>
<table class="wikitable" style="margin-bottom:4px">
<tbody><tr>
<th id="sehreindutigeid" colspan="5"> <b>Systems</b> </th>
</tr>
<tr>
<th> Komponenten</th>
<th> Hersteller</th>
<th> Modell</th>
<th> Größe (Maximal)</th>
<th> # per mount x total</th>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Powerplantnav.svg" class="image"><img alt="Powerplantnav.svg" src="https://starcitizen.tools/images/0/01/Powerplantnav.svg" width="15" height="15" /></a></div>Power Plants</div></td>
<td> TBD</td>
<td> C Power Plant</td>
<td> Capital (Capital)</td> 
<td> 1 x 2</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Coolernav.svg" class="image"><img alt="Coolernav.svg" src="https://starcitizen.tools/images/3/39/Coolernav.svg" width="15" height="15" /></a></div><a href="/Cooler" class="mw-redirect" title="Cooler">Coolers</a></div></td>
<td> TBD</td>
<td> L Cooler</td>
<td> Large (Large)</td> 
<td> 1 x 4</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Shieldgeneratornav.svg" class="image"><img alt="Shieldgeneratornav.svg" src="https://starcitizen.tools/images/3/35/Shieldgeneratornav.svg" width="15" height="15" /></a></div><a href="/Shields" class="mw-redirect" title="Shields">Shield Generators</a></div></td>
<td> TBD</td>
<td> L Shield Generator</td>
<td> Large (Large)</td>
<td> 1 x 3</td> 
</tr>
</tbody></table>
<p class="mw-empty-elt"></p>
			</div>
			<div class="tabbertab" title="Propulsion &amp; Thrusters">
				<p class="mw-empty-elt">
</p><table class="wikitable" style="margin-bottom:4px">
<tbody><tr>
<th id="sehreindutigeid" colspan="5"> <b>Propulsion</b> </th>
</tr>
<tr>
<th> Komponenten</th>
<th> Hersteller</th>
<th> Modell</th>
<th> Größe (Maximal)</th>
<th> # per mount x total</th>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Fuelintakenav.svg" class="image"><img alt="Fuelintakenav.svg" src="https://starcitizen.tools/images/5/5f/Fuelintakenav.svg" width="15" height="15" /></a></div>Fuel Intakes</div></td>
<td> TBD</td>
<td> L Fuel Intake</td>
<td> Large (Large)</td> 
<td> 1 x 2</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Fueltanknav.svg" class="image"><img alt="Fueltanknav.svg" src="https://starcitizen.tools/images/6/68/Fueltanknav.svg" width="15" height="15" /></a></div>Fuel Tanks</div></td>
<td> </td>
<td> L Fuel Tank</td>
<td> Large (Large)</td> 
<td> 1 x 2</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Quantumdrivenav.svg" class="image"><img alt="Quantumdrivenav.svg" src="https://starcitizen.tools/images/b/bb/Quantumdrivenav.svg" width="15" height="15" /></a></div>Quantum Drives</div></td>
<td> TBD</td>
<td> L Quantum Drive</td>
<td> Large (Large)</td>
<td> 1 x 1</td> 
</tr><tr> 
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Jumpdrivenav.svg" class="image"><img alt="Jumpdrivenav.svg" src="https://starcitizen.tools/images/c/cd/Jumpdrivenav.svg" width="15" height="15" /></a></div>Jump Modules</div></td>
<td> TBD</td>
<td> L Jump Module</td>
<td> Large (Large)</td> 
<td> 1 x 1</td>
</tr><tr> 
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Quantumfueltanknav.svg" class="image"><img alt="Quantumfueltanknav.svg" src="https://starcitizen.tools/images/b/b8/Quantumfueltanknav.svg" width="15" height="15" /></a></div>Quantum Fuel Tanks</div></td>
<td> </td>
<td> C Quantum Fuel Tank</td>
<td> Capital (Capital)</td> 
<td> 1 x 1</td>
</tr>
</tbody></table>
<table class="wikitable" style="margin-bottom:4px">
<tbody><tr>
<th id="sehreindutigeid" colspan="5"> <b>Thrusters</b> </th>
</tr>
<tr>
<th> Komponenten</th>
<th> Hersteller</th>
<th> Modell</th>
<th> Größe (Maximal)</th>
<th> # per mount x total</th>
</tr><tr>
<td rowspan="2"> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Mainthrusternav.svg" class="image"><img alt="Mainthrusternav.svg" src="https://starcitizen.tools/images/f/f4/Mainthrusternav.svg" width="15" height="15" /></a></div>Main Thrusters</div></td>
<td> </td>
<td> Main Thruster</td>
<td> Main </td>
<td>  x 4</td>
</tr><tr>
<td> </td>
<td> Retro Thrusters</td>
<td> Retro </td>
<td>  x 2</td>
</tr><tr>
<td> <div style="display:flex;align-items:center"><div style="margin-right:8px"><a href="/File:Maneuveringthrusternav.svg" class="image"><img alt="Maneuveringthrusternav.svg" src="https://starcitizen.tools/images/c/c1/Maneuveringthrusternav.svg" width="15" height="15" /></a></div>Maneuvering Thrusters</div></td>
<td> </td>
<td> Fixed Maneuvering Thruster</td>
<td> Fixed </td>
<td>  x 20</td>
</tr>
</tbody></table>
<p class="mw-empty-elt"></p>
			</div>
			<div class="tabbertab" title="Weaponry">
				<p class="mw-empty-elt">
</p><table class="wikitable" style="margin-bottom:4px">
<tbody><tr>
<th id="sehreindutigeid" colspan="5"> <b>Weaponry</b> </th>
</tr>
<tr>
<th> Komponenten</th>
<th> Hersteller</th>
<th> Modell</th>
<th> Größe (Maximal)</th>
<th> # per mount x total</th>
</tr><tr>
<td> <div style="display:flex;align-items:center;white-space:nowrap"><div style="margin-right:8px"><a href="/File:Turretnav.svg" class="image"><img alt="Turretnav.svg" src="https://starcitizen.tools/images/1/17/Turretnav.svg" width="15" height="15" /></a></div>Turrets</div></td>
<td> TBD</td>
<td> TBD</td>
<td> Remote</td>
<td> TBD (5)</td> 
<td> 2 x 2</td>
</tr><tr> 
<td rowspan="2"> <div style="display:flex;align-items:center;white-space:nowrap"><div style="margin-right:8px"><a href="/File:Utilityitemnav.svg" class="image"><img alt="Utilityitemnav.svg" src="https://starcitizen.tools/images/2/24/Utilityitemnav.svg" width="15" height="15" /></a></div>Utility Items</div></td>
<td> </td>
<td> Tractor Beam</td>
<td> </td>
<td> 3 (3)</td> 
<td> 1 x 2</td>
</tr>
<tr>
<td> </td>
<td> Mining Laser</td>
<td> </td>
<td> 4 (4)</td> 
<td> 1 x 2</td>
</tr>
</tbody></table>
<p class="mw-empty-elt"></p>
			</div></div>
    <p>Die <a href="<?php print_r($crusaderexcurs); ?>" title="Crusader Industries">Crusader</a> <b>C2 Hercules</b> oder <b>Hercules Starlifter</b> ist ein ziviler Schwertransporter. Die C2 nutzt den patentierten Hercules- Konstruktionsrahmen in Militärqualität und erweitert die Ladekapazität, während sie kaum Feuerkraft einbüßt. Hat sie den privaten Sektor im Sturm erobert. Sie ist zum Industriestandard für Rennteams, Schiffshändler und -hersteller, Bauunternehmen, Bergbauunternehmen und sogar große Reisegesellschaften geworden.<sup id="cite_ref-1" class="reference"><a href="#cite_note-1">&#91;1&#93;</a></sup>
    </p>
    <div id="toc" class="toc">
      <div class="toctitle" lang="en" dir="ltr">
        <h2>Contents</h2>
      </div>
      <ul>
        <li class="toclevel-1 tocsection-1"><a href="#Specifications"><span class="tocnumber">1</span> <span class="toctext">Specifications</span></a></li>
        <li class="toclevel-1 tocsection-2"><a href="#Model"><span class="tocnumber">2</span> <span class="toctext">Model</span></a>
          <ul>
            <li class="toclevel-2 tocsection-3"><a href="#Series_variants"><span class="tocnumber">2.1</span> <span class="toctext">Series variants</span></a></li>
          </ul>
        </li>
        <li class="toclevel-1 tocsection-4"><a href="#Development"><span class="tocnumber">3</span> <span class="toctext">Development</span></a></li>
        <li class="toclevel-1 tocsection-5"><a href="#Trivia"><span class="tocnumber">4</span> <span class="toctext">Trivia</span></a></li>
        <li class="toclevel-1 tocsection-6"><a href="#Gallery"><span class="tocnumber">5</span> <span class="toctext">Gallery</span></a></li>
        <li class="toclevel-1 tocsection-7"><a href="#See_also"><span class="tocnumber">6</span> <span class="toctext">See also</span></a></li>
        <li class="toclevel-1 tocsection-8"><a href="#References"><span class="tocnumber">7</span> <span class="toctext">References</span></a></li>
      </ul>
    </div>

        </div>
        
    </div>
    </div>
    </div>
    </div>
        <!-- /// CONTACT SECTION /// -->
    </div><!-- Main Container End -->
    <p>Die <a href="<?php print_r($crusaderexcurs); ?>" title="Crusader Industries">Crusader</a> <b>C2 Hercules</b> oder <b>Hercules Starlifter</b> ist ein ziviler Schwertransporter. Die C2 nutzt den patentierten Hercules- Konstruktionsrahmen in Militärqualität und erweitert die Ladekapazität, während sie kaum Feuerkraft einbüßt. Hat sie den privaten Sektor im Sturm erobert. Sie ist zum Industriestandard für Rennteams, Schiffshändler und -hersteller, Bauunternehmen, Bergbauunternehmen und sogar große Reisegesellschaften geworden.<sup id="cite_ref-1" class="reference"><a href="#cite_note-1">&#91;1&#93;</a></sup>
    </p>
    <div id="toc" class="toc">
      <div class="toctitle" lang="en" dir="ltr">
        <h2>Contents</h2>
      </div>
      <ul>
        <li class="toclevel-1 tocsection-1"><a href="#Specifications"><span class="tocnumber">1</span> <span class="toctext">Specifications</span></a></li>
        <li class="toclevel-1 tocsection-2"><a href="#Model"><span class="tocnumber">2</span> <span class="toctext">Model</span></a>
          <ul>
            <li class="toclevel-2 tocsection-3"><a href="#Series_variants"><span class="tocnumber">2.1</span> <span class="toctext">Series variants</span></a></li>
          </ul>
        </li>
        <li class="toclevel-1 tocsection-4"><a href="#Development"><span class="tocnumber">3</span> <span class="toctext">Development</span></a></li>
        <li class="toclevel-1 tocsection-5"><a href="#Trivia"><span class="tocnumber">4</span> <span class="toctext">Trivia</span></a></li>
        <li class="toclevel-1 tocsection-6"><a href="#Gallery"><span class="tocnumber">5</span> <span class="toctext">Gallery</span></a></li>
        <li class="toclevel-1 tocsection-7"><a href="#See_also"><span class="tocnumber">6</span> <span class="toctext">See also</span></a></li>
        <li class="toclevel-1 tocsection-8"><a href="#References"><span class="tocnumber">7</span> <span class="toctext">References</span></a></li>
      </ul>
    </div>

        </div>
        
    </div>
    </div>
    </div>
    </div>
        <!-- /// CONTACT SECTION /// -->
    </div><!-- Main Container End -->


    
                
    <!-- /// FOOTER INCLUDE /// -->
        <?php include('https://www.ariscorp.de/php/includes/footer.php'); ?>
    <!-- /// END FOOTER INCLUDE /// -->


    <!-- //// SCRIPTS //// -->
    <script src="https://www.ariscorp.de/assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/popper.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/bootstrap.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/blazy.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/isotope.pkgd.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/lightbox.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/jquery-modal-video.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/validator.min.js"></script>
    <script src="https://www.ariscorp.de/assets/js/strider.js"></script>

</html>

<!--
    <div class="l-sheet__cell l-sheet__cell--icon">
      <div class="c-iconed">
      <span class="c-iconed__icon c-iconed__icon--fuel_tanks v-primary-fill" style="background-image: none; visibility: visible;"><svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" viewBox="0 0 29.74 34.76"><title>fuel_tanks</title><path d="M27.06,0H11.83L7.3,4.53h-1L5.93,4.2V3.65L4.52,2.23H4l-4,4v.56L1.42,8.16H2l.33.33v1l-.76.76V32.08l2.68,2.68H27.06l2.68-2.68V2.61ZM15.19,30.74A7.42,7.42,0,0,1,9,19.19H9a7.43,7.43,0,0,1,.47-.62c3.19-3.66,3.38-7.68,6.73-10-1,3.9,2.09,7,4.63,10a7.44,7.44,0,0,1,.47.62h0a7.42,7.42,0,0,1-6.15,11.56Zm12-26.14H9.92l2.81-2.81H25.81l1.36,1.36ZM14.78,15.78a14.6,14.6,0,0,0,2.71,3.81c.29.33.58.65.86,1a4.14,4.14,0,1,1-6.33,0,16.13,16.13,0,0,0,2.62-4.49l.14-.32M15.19,13c-1.39,1.63-1.73,4.41-3.93,6.94a5.14,5.14,0,0,0-.32.43h0a5.13,5.13,0,1,0,8.51,0h0a5.16,5.16,0,0,0-.33-.43C17.36,17.85,15.19,16,15.19,13Z"></path></svg></span>
    </div>
    </div>
    <style>
      .v-primary-fill {
    fill: #00ffe8 !important;
    stroke: #00ffe8 !important;
    }
    </style> -->