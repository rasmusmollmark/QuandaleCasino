<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    session_set_cookie_params(0);
    session_start(); 
    if(!isset($_SESSION['USERID'])){
    header("Location: ./logOut.php");
    exit();
    }?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
       function navigateTo(url) {
           window.location.href = url;
       }
</script>

    <link rel="stylesheet" href="homepage.css">

</head>
<body>
<?php if(isset($_SESSION['USERID'])):?>
        <aside id="topbar">
       <div class="topbar-container">
           <img src="NyaQuandale.gif" alt="Qandale Casino Logo" class="topbar-logo" href="./index.php">
           <h1>Välkommen till Quandale Casino</h1>
           <div class="button-container">
               <button onclick="navigateTo('weather.php')">Spela</button>
               <button onclick="navigateTo('profile.php')">Profil</button>
               <button onclick="navigateTo('displaycomments.php')">Kommentarer</button>
           </div>
       </div>
   </aside>
	

    <div id="content">
        <section class="info-section">
            <h2>Meddelande från utvecklarna och investerarna</h2>
            <p>Välkomna, ärade besökare, till världens främsta bettingsajt! <br> <br> Hos oss kan ni delta i ett av historiens mest klassiska spel, blackjack – ett spel som har bestått genom tidens alla prövningar, från kulturskiften till världskrig. Vår ambition är att, med hjälp av vår toppmoderna mjukvara, förflytta er i tid och rum till ett autentiskt casino, där varje insats känns lika verklig som i det fysiska livet. Utöver denna extraordinära upplevelse erbjuder vi också en levande och engagerande kommentarsfält, där ni kan ta del av både hettande debatter och underhållande konversationer. <br> <br>  Vi tackar ödmjukast för att ni valt oss och påminner er om att ingen kommer ihåg en fegis – så spela som om det inte fanns någon morgondag!</p>
        </section>
        <section class="info-section">
            <h2>Lär dig spela Blackjack</h2>
            <p>Blackjack är ett kortspel där målet är att få en hand som är så nära 21 som möjligt, utan att överstiga det. Varje spelare får två kort och kan välja att "ta kort" för att ta emot ytterligare ett kort, eller "stanna" för att behålla sin nuvarande hand. Ess räknas som antingen 1 eller 11, klädda kort räknas som 10 och alla andra kort räknas som sitt nominella värde. Om din hand överstiger 21, förlorar du omedelbart. Målet är att slå dealern genom att ha en högre hand som inte överstiger 21.</p>
        </section>
    </div>

    <section id="testimonials" class="testimonials-section">
    <h2>Vad våra kunder säger</h2>
    <div class="testimonial">
        <p>"Bästa casinot jag någonsin har spelat på. Fantastisk upplevelse!"</p>
        <h4>- Maria S.</h4>
    </div>
    <div class="testimonial">
        <p>"Oslagbara erbjudanden och en engagerande kommentarsfält."</p>
        <h4>- Johan L.</h4>
    </div>
    <!-- Add more testimonials as needed -->
</section>
<div>  <p> <br> </p>  </div>


<footer id="footer" class="footer-section">
    <div class="footer-container">
        <p>&copy; 2024 Quandale Casino. All rights reserved.</p>
        <nav class="footer-nav">
            <a href="about.php">Om Oss</a>
            <a href="contact.php">Kontakt</a>
            <a href="terms.php">Villkor</a>
            <a href="privacy.php">Integritetspolicy</a>
        </nav>
    </div>

</footer>


<?php endif?>
<?php if(!isset($_SESSION['USERID'])):?>
    <section>
        <h2>DU ÄR INTE INLOGGAD</h2>
        <button>Gå tillbaka</button>
    </section>
<?php endif?>
</body>
</html>
