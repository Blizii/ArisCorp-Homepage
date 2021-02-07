<div class="" style="padding: 6px 12px; border: 1px solid transparent; border-top: none;">
    <div id="technologien" class="tabcontent">
        <div class="img-gameplays-line">
            <hr class="animation-element extend">
        </div>

        <div id="technologien" class="tabcontent">
        <div class="row">
            <div class="column">
                <a href="https://www.ariscorp.de/sites/excurs/technologien/Plasmatriebwerke.php" class="button-ships"><img src="https://www.ariscorp.de/assets/img/excurs/logos/technologien/Triebwerke.webp" alt="Aegis Dynamics" style="width:100%" onclick="myFunction(this);"></a>
            </div>
            <div class="column">
                <a href="https://www.ariscorp.de/sites/excurs/technologien/QuantumDrive_und_JumpDrive.php" class="button-ships"><img src="https://www.ariscorp.de/assets/img/excurs/logos/technologien/quantum.webp" alt="Anvil Aerospace" style="width:100%" onclick="myFunction(this);"></a>
            </div>
            <div class="column">
                <a href="https://www.ariscorp.de/sites/excurs/technologien/Komponenten_und_Subkomponenten.php" class="button-ships"><img src="https://www.ariscorp.de/assets/img/excurs/logos/technologien/compo.webp" alt="AopoA" style="width:100%" onclick="myFunction(this);"></a>
            </div>
            <div class="column">
                <a href="https://www.ariscorp.de/sites/excurs/technologien/Treibstoffmechanik.php" class="button-ships"><img src="https://www.ariscorp.de/assets/img/excurs/logos/technologien/intake.webp" alt="Argo Astronautics" style="width:100%" onclick="myFunction(this);"></a>
            </div>


            <div class="column">
                <a href="https://www.ariscorp.de/sites/excurs/technologien/Schilde_und Schild_Manegment.php" class="button-ships"><img src="https://www.ariscorp.de/assets/img/excurs/logos/technologien/schild.webp" alt="Banu" style="width:100%" onclick="myFunction(this);"></a>
            </div>
        </div>
            
            </div>
        </div>
    </div>
</div>

<script>
        function openExcurs(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();
</script>


<style>
    /* The grid: Four equal columns that floats next to each other */
    .column {
    float: left;
    width: 25%;
    padding: 10px;
    }

    /* Style the images inside the grid */
    .column img {
    opacity: 0.8; 
    cursor: pointer; 
    }

    .column img:hover {
    opacity: 1;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }
</style>