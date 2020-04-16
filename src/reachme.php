<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
      Blog
    </title>
    <script>
      function preview()
      {
        //object to define properties of map
        var mapproperty =
        {
          //center: LatLng defines latitude and longtitude of center of map
          center:new google.maps.LatLng(28.6143845,77.3587834),
          //zoom starts from 0 (whole earth) and zooms in with increasing value
          zoom:16,
          //4 types of map- ROADMAP, SATELLITE, HYBRID, TERRAIN
          mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        //object to create a new map in div with id "college"
          var map = new google.maps.Map(document.getElementById("college"),mapproperty);
      }
      function load()
      {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyD6YMawC9G-GGd1k276XmGibZBxcmscYns&callback=preview";
        document.body.appendChild(script);
      }
      window.onload = load;
    </script>
  </head>
  <body>
    <header>

    </header>
    <section>
    <button class="waves-effect waves-light btn" onclick="goBack()" style="z-index:2; position:absolute; margin-top:6.5vh; margin-left:0.5vw; height:6vh; width:8vw;">Back</button>
      <div id="college" style="width:100vw;height:91vh;
    min-height: 90%;
    max-height: 90%;
    min-width: 100%;
    max-width: 100%;
">
      </div>
    </section>
    <footer style="height:5vh;font-size:2vh;">
    <ul id="names" style="weight:20vw;">
    <li><a target="_blank" href="https://www.linkedin.com/in/anuragpandey3744">ANURAG PANDEY</a></li>
    <li><a target="_blank" href="https://www.facebook.com/coolarchit15">ARCHIT BHATNAGAR</a></li>
    <li><a target="_blank" href="https://twitter.com/atinsinghal8997">ATIN SINGHAL</a></li>
    <li><a target="_blank" href="https://www.linkedin.com/in/codehimanshu">HIMANSHU AGRAWAL</a></li>
    <li><a target="_blank" href="https://www.twitter.com/hrithiksirohi01">HRITHIK CHAUDHARY</a></li>

</ul>
    </footer>
      <!--Import jQuery before materialize.js-->
      <script>
     function goBack() {
      window.history.back();
}
</script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <style>
     ul#names li {
    display:inline;
}
#names li a {
  text-decoration: none;
  color: #FFFFFF;
  display: block;
}

#names li a:hover {
  text-decoration: none;
  color: #000000;
  background-color: #33B5E5;
}
#names li {
  float: left;
  list-style: none;
  text-align: center;
  background-color: #000000;
  margin-right:1vw;
  margin-left: 1vw;
  width: 17.5vw;
  line-height: 60px;
}
    </style>
  </body>
</html>
