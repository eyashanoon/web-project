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
    <link rel="stylesheet" href="../style/Investerinfo.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="../script/InvesterInfo.js"></script>
</head>

<body>

<div class="page">
    <div class="head">

        <div class="logo"><img src="../images/img.png" ></div>

        <ul >
            <li><a href="InvesterInfo.php">Investor Info</a></li>
            <li><a href="offersmade.php">Offers Made</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href= "../log-out.php">Log Out</a></li>


        </ul>




    </div>
    <div class="center">
        <h2>Pearson's information:</h2>
        <form id="ff" class="formperinfo" action="../php/inester.php" method="post" enctype="multipart/form-data">
        <div class="Perso-Info">
            <div >
                <div>

                    <div>
                        <label>First Name:</label>
                        <input type="text" value="" required name="first_name" id="first_name">
                    </div>
                    <div>
                        <label>Last Name:</label >
                        <input type="text" value="" required name="last_name" id="last_name">
                    </div>
                    <div>
                        <label>Gender :</label>
                        <label for="genderM" class="Gender" onclick="ChangeBGColorofG()" id="GenderM">M</label>
                        <input type="radio" name="gender" id="genderM" value="M" required>
                        <label for="genderF" class="Gender" onclick="ChangeBGColorofG()" id="GenderF">F</label>
                        <input type="radio" name="gender" id="genderF" value="F" required>
                    </div>
                    <div>
                        <label>Birthday:</label>
                        <input type="date" value="" required name="birth_day" id="birth_day">
                    </div>
                    <div>
                        <label>Qualification :</label>
                        <label for="High-School" class="Qualification" onclick="ChangeBGColorofQ()" >High School</label>
                        <input type="radio" name="qualification" id="High-School" value="0" required>
                        <label for="Bachelor’s" class="Qualification" onclick="ChangeBGColorofQ()">Bachelor’s</label>
                        <input type="radio" name="qualification" id="Bachelor’s" value="1" required>
                        <label for="Master’s’s" class="Qualification" onclick="ChangeBGColorofQ()">Master’s</label>
                        <input type="radio" name="qualification" id="Master’s’s" value="2" required>
                        <label for="Doctorate" class="Qualification" onclick="ChangeBGColorofQ()">Doctorate</label>
                        <input type="radio" name="qualification" id="Doctorate" value="3" required>
                        <label for="none" class="Qualification" onclick="ChangeBGColorofQ()">None</label>
                        <input type="radio" name="qualification" id="none" value="4" required>

                    </div>
                    <div class="fileupload" id="fileupload">
                        <label>Upload file documenting your qualifications :</label>
                        <img src="../images/fileicon.png" class="fileicon" onclick="uploadfiles('fileinput')">
                        <input type="file" id="fileinput"  class="fileinput" name="qualification_file"  >
                    </div>
                    
                    <div>
                        <input type="submit" name="form1">
                    </div>
                </div>



            </div>
            <figure>
                <img id="PrsImg"  onclick="changeimge()"  >
                <input type="file" id="fileimg" class="fileimge" accept=".jpg, .jpeg, .png" onchange="FileImageSelect()" name="image"  >
                <figcaption>Click the image to change</figcaption>
            </figure>


         </div>
         </form>

        <form class="forminvsworth" enctype="multipart/form-data" action="../php/inester.php" method="post" id="sf">

        <h2>Investor worth:</h2>
          <div class="InvsterWorth">
              <div>
             <div>
                 <label> Approximate total investor worth:</label>
                 <div>
                     <input type="number" id="Nwrth" step="10" min="10" max="999" name="total_worth">
                     <div class="snaperdiv">
                         <button type="button" onclick="increment('Nwrth')">▲</button>
                         <button type="button" onclick="decrement('Nwrth')">▼</button>
                     </div>
                 </div>



                 <select class="weight" name="weight_total_worth" id="totalweight">
                     <option value="1">-</option>
                     <option value="1000">K</option>
                     <option value="1000000">M</option>
                     <option value="1000000000">B</option>
                 </select>
             </div>
                  <input type="submit" name="form2">

              </div>



             <div>
                 <div class="cashdiv">
                     <h4>Cash and Valuable collectibles</h4>
                     <div>
                         <div>
                             <label>Cash % of the total worth:</label>
                             <input type="number" min="0" max="100" class="number" id="cash%" name="cash">
                             <div class="snaperdiv1">
                                 <button type="button" onclick="increment('cash%')">▲</button>
                                 <button type="button"onclick="decrement('cash%')">▼</button>
                             </div>
                             <span class="marks">%</span>
                         </div>

                         <div>
                             <label>Valuable collectibles worth:</label>
                             <input type="number" step="10" class="number" id="collw" name="collectibles">

                             <div class="snaperdiv1">
                                 <button type="button" onclick="increment('collw')">▲</button>
                                 <button type="button"onclick="decrement('collw')">▼</button>
                             </div>
                             <span class="marks">$</span>

                             <select class="weight" name="weight_collectibles" id="weight_collectibles">
                                 <option value="1">-</option>
                                 <option value="1000">K</option>
                                 <option value="1000000">M</option>
                                 <option value="1000000000">B</option>
                             </select>
                         </div>

                     </div>



                 </div>
                 <div class="real-estatediv">
                     <h4>Real Estate</h4>
                     <div>
                         <div>
                             <label>Real Estate % of total worth:</label>
                             <input type="number" min="0" max="100" id="real-estate%" class="number" name="real_estate">
                             <div class="snaperdiv1">
                                 <button type="button" onclick="increment('real-estate%')">▲</button>
                                 <button type="button" onclick="decrement('real-estate%')">▼</button>
                             </div>
                             <span class="marks">%</span>
                         </div>

                         <div>
                             <label>Files documenting part of these properties:</label>
                             <img src="../images/fileicon.png" class="fileicon" onclick="uploadfiles('fileinput1')">
                             <input type="file" id="fileinput1"  class="fileinput" name="real_estate_file"   >

                         </div>
                     </div>

                 </div>




                 <div class="Investmentsdiv">
                     <h4>Investments</h4>
                     <div>
                         <div>
                             <label>Investments % of total worth:</label>
                             <input type="number" min="0" max="100" id="Investments%" class="number" name="investments">
                             <div class="snaperdiv1">
                                 <button type="button" onclick="increment('Investments%')">▲</button>
                                 <button type="button" onclick="decrement('Investments%')">▼</button>
                             </div>
                             <span class="marks">%</span>
                         </div>

                         <div>
                             <label>Name of prominent investment firms:</label>
                              <input type="text" name="name_investment" id="name_investment">

                         </div>
                         <div>
                             <label>Files documenting part of these Investments:</label>
                             <img src="../images/fileicon.png" class="fileicon" onclick="uploadfiles('fileinput2')">
                             <input type="file" id="fileinput2"  class="fileinput" name="investments_file"   >

                         </div>
                     </div>


                 </div>


             </div>

        </div>
        </form>
<form class="formexperiences" action="../php/inester.php" method="post" id="tf">
<h2>Investor life experiences</h2>
        <div class="Investor-experiences">
            <textarea name="investor_experiences" id="investor_experiences">
            </textarea>
            <input type="submit" name="form3" class="experiencesbutton">

        </div>
    </form>


        <form class="formaddinfo" action="../php/inester.php" method="post" id="frthf">
        <h2>Additional Info:</h2>
        <div class="add-Info">
            <div >
                <div>

                    <div>
                        <label>Email:</label>
                        <input type="email" value="" name="email" id="email">
                    </div>
                    <div>
                        <label>Phone Number:</label>
                        <input type="text" value="" name="phone" id="phone">
                    </div>
                    <div>
                        <label>Password:</label>
                        <input type="text" value="" name="password" id="password">
                    </div>
                    <div><input type="submit" name="form4"></div>

                </div>


        </div>
        </div>
        </form>
</div>


    <?php
    // Focus on the element if specified
    if (!empty($focusElement)) {
        echo "<script>document.getElementById('$focusElement').focus();</script>";
    }
    ?>
</body>
</html>