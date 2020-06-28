@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata"-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("/images/about.png");
  min-height: 75%;
}

.menu {
  display: none;
}


.oc {
    
    margin-left: 50%;
    text-align: center;
}

.title{

    text-align:center;
    

}

.sub{

    margin-top: 25px; 
    margin-left: 10px; 
    color: white;
}

.about{

    text-align: center;
    background-color: white;
    opacity: 0.8;
    padding: 50px;
}
</style>
<body>




<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  

  <div class="title">
    <span class="" style="font-size:70px">Big<br>Brother</span>
  </div>

  <div class="sub">
    <span class="">A Professional<br> Software Company</span>
  </div>

</header>

<!-- Add a background color and large text to the whole page -->

<!-- About Container -->
<div class="about">
  	<br>
  	<br>
    <h2 class="w3-center w3-padding-64"><span class="text-center" style="background-color:white;">ABOUT US</span></h2>
    <br><br>

    <p>We are Big Brother, a professional software company in multiple industry sectors including retail, finance, education, and more. Our vast technology expertise enable us to focus on cutting-edge softwares with the aim to develop scalable, secure and easy-to-use web applications. We believe that the judicious use of technology, together with a good design can reduce complexity, connect individuals, and provide valuable insights, all of which ultimately help businesses succeed.</p>
    <br><br>
    <h2 class="w3-center w3-padding-64"><span class="text-center" style="background-color:white;"><hr width="100%" color="black"><br>About our app</hr></span></h2>
    <br><br>

    <p>Our software was made with the passion to deliver the best business software model for an affordable price. 
User-friendly, always renewed with updates that are easily accessible, it is also made to be easy to use, so you don’t need upfront knowledge to use our Survey Editor along with the Analyser.</p>
    <p>Our Survey Editor allows the creation of surveys with suggested answers to created questions. Questions might answered be through multiple choice method or by filling in the blanks with any type of answers.</p>

    </p>
    <p>Big Brother Survey Analyser get answers to more than 20 million questions. Together, those answers make up feedback that drives companies to grow, succeed, and innovate to solve today’s most pressing challenges. We’re committed to building new ways for people to share their voices and opinions. 
Join the family now and see the new innovative world of next-generation business softwares!</p>
    
    <br><br>
    <div class = "oc"><p><strong>Opening hours:</strong> everyday from 6am to 5pm.</p>
    <p><strong>Address:</strong> 15 Aston Martin Av. | 69420. </p></div>
  </div>





</footer>


</body>
</html>





@endsection