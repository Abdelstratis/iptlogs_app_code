<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<style type="text/css">
		body {
  background: #1150a3;
  font-size: 62.5%;
}

a{
	text-decoration: none;
}
/* GENERAL BUTTON STYLING */
button,
button::after {
  -webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
  -o-transition: all 0.3s;
	transition: all 0.3s;
}

button {
  background: none;
  border: 3px solid #fff;
  border-radius: 5px;
  color: #fff;
  display: block;
  font-size: 1.6em;
  font-weight: bold;
  margin: 1em auto;
  padding: 2em 6em;
  position: relative;
  text-transform: uppercase;
}

button::before,
button::after {
  background: #fff;
  content: '';
  position: absolute;
  z-index: -1;
}

button:hover {
  color: black;
}

</style>



	
	<div id="section">
		<a href="./log.php"><button>1°) Insértion des informations</button></a><br>
		<a href="./analyseData.php"><button>2°) Analyse des données</button></a><br>
		<a href="./ihm.php"><button>3°) IHM</button></a><br>
	</div>

</body>

 </html>