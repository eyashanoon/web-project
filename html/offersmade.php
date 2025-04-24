<?php
session_start();

if(!isset($_SESSION['id']) || $_SESSION['type'] != 'investor'){
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css" />
  <link rel="stylesheet" href="../style/offersmade.css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <script src="../script/offersmade.js"></script>
</head>
<body>

<div class="page">
  <div class="head">

    <div class="logo"><img src="../images/img.png" ></div>

    <ul >
      <li><a href="InvesterInfo.php">Investor Info</a></li>
      <li><a href="offersmade.html">Offers Made</a></li>
      <li><a href="home.php">Home</a></li>
        <li><a href= "../log-out.php">Log Out</a></li>



    </ul>





  </div>
  <div class="center">
    <div class="uperbar"></div>
    <div id="gridcon">
      <div class="projects" id="projects">

          <div class="project" id="pro1"  onclick="expand('pro1')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/rejected.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/rejected.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>

          <div class="project" id="pro2"  onclick="expand('pro2')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/rejected.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/rejected.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>

          <div class="project" id="pro3"  onclick="expand('pro3')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/accepted.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/accepted.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>

          <div class="project" id="pro4"  onclick="expand('pro4')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/rejected.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/rejected.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>

          <div class="project" id="pro5"  onclick="expand('pro5')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/rejected.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/rejected.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>

          <div class="project" id="pro6"  onclick="expand('pro6')">

              <div class="shortdiv">
                  <label>project name</label>
                  <label>date</label>
                  <img src="../images/rejected.png">

              </div>
              <div class="pro display"  >

                  <div>
                      <div>
                          <div class="proname"><label>project name</label></div>
                          <div class="prodisc"><p>project description project description project description project description project description project description project description project description </p></div>
                          <div class="proemail"><label>project email </label></div>
                      </div>
                      <div><img src="../images/img_4.png"></div>
                  </div>
                  <div>
                      <div>
                          <div><label>% of the equity</label></div>
                          <div><label>/////</label></div>
                      </div>
                      <div>
                          <div><label>price</label></div>
                          <div><label>/////</label></div>
                      </div>
                  </div>
                  <div>
                      <img src="../images/rejected.png">
                      <a>go to the offer page</a>

                  </div>


              </div>
          </div>



















      </div>

    </div>






  </div>
</div>

</body>
</html>