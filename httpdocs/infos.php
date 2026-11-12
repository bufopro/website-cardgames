<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Deine Webseite</title>
<style>
  body {
    background: url(verlauf.jpg);
    margin: 0;
    padding: 0;
    color: white; /* Textfarbe auf weiß ändern */
  }
  .container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 20px;
  }
  .title {
    font-family: Verdana, Arial, sans-serif;
    font-size: 64px;
    font-variant: small-caps;
    text-align: center;
    color: white; /* Überschriftsfarbe auf weiß ändern */
    font-weight: bold; /* Fett */
  }
  .title span {
    font-size: 0.6em; /* Größe der Kleinbuchstaben */
    vertical-align: top; /* Vertikale Ausrichtung */
  }
  .title span:first-letter {
    text-transform: capitalize; /* Erste Buchstabe groß */
  }
  .cards-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }
  .card {
    margin: 10px;
  }
  .card img {
    width: 450px;
    height: 259px;
  }
  .footer {
    background-color: white;
    width: 100%;
    padding: 20px 0;
  }
</style>
</head>
<body>

<div class="container">
  <div align=center>
  <h1 class="title" style="font-weight: 550; text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9);">Classic Card Games 3D</h1>
    <a href="https://store.steampowered.com/app/941920/" target="_blank">
      <img src=img.jpg>
    </a>
  </div>

  <div align=center>
    <font face="Verdana, Arial, sans-serif">
    <p><h2 style="font-weight: 550; text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.7);">Premium Card Games with LAN and Online Multiplayer</h3></p>
    </font>
  </div>
  <div class="cards-container">
    <!-- Premium-Kartenspiele hier -->
    <div class="card">
      <a href="https://store.steampowered.com/app/1178520/" target="_blank">
        <img src="kapsel4_hearts.jpg" width="450" height="259" alt="Hearts">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/1029900/" target="_blank">
        <img src="kapsel4_rummy.jpg" width="450" height="259" alt="Rummy">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/966090/" target="_blank">
        <img src="kapsel4_canasta.jpg" width="450" height="259" alt="Canasta">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/1178510/" target="_blank">
        <img src="kapsel4_ginrummy.jpg" width="450" height="259" alt="Gin Rummy">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/1070770/" target="_blank">
        <img src="kapsel4_skat.jpg" width="450" height="259" alt="Skat">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/1178500/" target="_blank">
        <img src="kapsel4_crazy8s.jpg" width="450" height="259" alt="Crazy 8s">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/1178530/" target="_blank">
        <img src="kapsel4_thirtyone.jpg" width="450" height="259" alt="Thirty One">
      </a>
    </div>
    <div class="card">
      <a href="https://store.steampowered.com/app/662230/" target="_blank">
        <img src="kapsel4_tp3dce.jpg" width="450" height="259" alt="Trendpoker">
      </a>
    </div>
  
  </div>
</div>

<br>
<!-- Footer -->
<div class="footer" align=center>
  <table cellpadding=10 cellspacing=10 bgcolor=#ffffff wdith=100%>
    <tr width=100%><td width=100%>
      <font color=#000000 face="Verdana, Arial, sans-serif">
<div align=center>
  <font face=Arial size=3>- Website under construction -</font><br /><br />  
</div>
<br />
<div align=center>
  <font face=Arial size=3><b>News and info will appear soon.</b></font><br /><br />  
</div>

<div class=textbox>
<div align=center>
        <font face=Arial size=3>
            Send your request to our team <a href="mailto:support@bufopro.de">support@bufopro.de</a>
        </font>
    </div>

    <br><br>

    <div align=center><a href="http://www.bufopro.de/" target="_blank"><img src="logo_bp.jpg" border="0"/></a>&nbsp;&nbsp;&nbsp;</div>
    <div align=center>
        <font face=Arial size=2>
            <span>&#9400; 2018 - <?= date('Y') ?> <a href="http://www.bufopro.de" target=_blank>BufoProject</a>. All rights reserved.</span>
            <!--  <label for="tab4"><a href="">Imprint</a></label> -->
        </font>
    </div>
  </div> 
  </td></tr>
</table>
</div>
<!-- End Footer -->

</body>
</html>
