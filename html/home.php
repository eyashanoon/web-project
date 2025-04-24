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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/first.css">
    <script src="../script/home.js"></script>

</head>
<body>

<div class="page">
    <div class="head">

           <div class="logo"><img src="../images/img.png" onclick="loade_projects();"></div>

        <ul >
            <li><a href="InvesterInfo.php">Investor Info</a></li>
            <li><a href="offersmade.php">Offers Made</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href= "../log-out.php">Log Out</a></li>


        </ul>




    </div>



    <div class="center">
        <div id="outinfo" class="outinfo1">
        <div class="arrow" id="arrow" onclick="infoshow()">
            <img src="../images/rightarrow.png">
        </div>
        <div class="investerinfo display" id="investerinfo">
            


            <div class="coip">
                <div class="ip">
                    <img  id="image">
                </div>
            </div>
            <div class="info">

                <ul>
                    <li id="name"></li>
                    <li id="gender"></li>
                    <li id="birth_date"> </li>
                    <li id="email"> </li>
                    <li id="phone"></li>
                    <li id="prominent"></li>

                    <li id="Rate">
                        <span class="fa fa-star  " id="1thstar"></span>
                        <span class="fa fa-star  " id="2ndstar"></span>
                        <span class="fa fa-star  " id="3rdstar"></span>
                        <span class="fa fa-star" id="4thstar"></span>
                        <span class="fa fa-star" id="5thstar"></span>
                    </li>
                </ul>

            </div>

        </div>
        </div>

        <div class="content" id="content">
            <div class="extra" id="extra"><video src="../mmm.mp4" autoplay loop muted id="ll">

                </video> </div>


            <div class="specification" id="specification" onclick="fun()" >
                    <div class="con">
                    <div>
                      <table  >
                          <tr> <td> <label for="type" class="label">type of investment :</label> </td></tr>
                          <tr> <td>
                          <select id="type" name="type"  onchange="load_project()">
                              <option>--</option>
                              <option>Technology</option>
                              <option>Engineering</option>
                              <option>Construction</option>
                              <option>Healthcare</option>
                              <option>Education</option>
                              <option>Environmental</option>
                              <option>Social and Community</option>
                              <option>Arts and Culture</option>
                              <option>Business</option>
                              <option>Research</option>
                              <option>Innovation</option>
                              <option>Public Sector</option>
                              <option>Government</option>
                              <option>Financial</option>
                              <option>Manufacturing and Industrial</option>
                              <option>Others</option>
                          </select> </td></tr>
                      </table>
                    </div>


                    <div>
                        <table>
                            <tr> <td> <label for="country" class="label"  >country :</label> </td></tr>
                            <tr> <td>
                            <select class="selectpicker countrypicker  " data-flag="true"  name="country"></select>
                                <script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
                                <script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
                                <script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
                                <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script>
                            </td></tr>
                        </table>
                    </div>
                        <div class="spediv">

                            <label class="label">range:</label>
                            <table  class="range">
                                <tr> <td  > <label  class="label1">min:</label> </td>
                                    <td  > <label class="label1">max:</label> </td>
                                </tr>
                            </table>
                             <table>
                                <tr> <td>

                                    <div class="num">
                                        <input type="number"   step="10" min="10" max="999" class="number" id="value_min" oninput="load_project()" >
                                        <div class="snaperdiv1">
                                            <button type="button" onclick="increment('value_min');load_project()">▲</button>
                                            <button type="button" onclick="decrement('value_min');load_project()">▼</button>
                                        </div></div>


                                </td>
                                    <td>
                                    <select class="weight" id="weight_min" onchange="load_project()">
                                        <option value="1">-</option>
                                        <option value="1000">K</option>
                                        <option value="1000000">M</option>
                                        <option value="1000000000">B</option>
                                    </select>
                                    <td><span></span></td>
                                    <td><span></span></td>


                                    </td>
                                    <td>
                                        <div class="num">
                                        <input type="number"   step="10" min="10" max="999" class="number" id="value_max" oninput="load_project()">
                                        <div class="snaperdiv1">
                                            <button type="button" onclick="increment('value_max');load_project()">▲</button>
                                            <button type="button" onclick="decrement('value_max');load_project()">▼</button>
                                        </div></div>
                                    </td>
                                    <td>
                                        <select class="weight" id="weight_max" onchange="load_project()" >
                                            <option value="1">-</option>
                                            <option value="1000">K</option>
                                            <option value="1000000">M</option>
                                            <option value="1000000000">B</option>
                                        </select>

                                    </td></tr>
                            </table>
                        </div>
                        <div class="search">
                            <table >
                                <tr><td><label for="search" class="label">search for project </label> </td></tr>
                                <tr><td><input type="text" id="search" name="search" oninput="load_project()"></td></tr>
                            </table>


                        </div>
                        <div class="upicon" id="upicon">
                            <img src="../images/upicon.png" >
                        </div>

                    </div>


                    </div>
            <div class ="projects" id="projects">
                <div class="projects-iner" id="projects-iner">





                </div>


            </div>


            </div>

        </div>
    </div>

 </body>
</html>