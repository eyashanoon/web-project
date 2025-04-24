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
  <link rel="stylesheet" href="../style/projectdetales.css">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <script src="../script/projectdetals.js"></script>
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
    <div class="projectinfo" id="projectinfo">
      <div class="info" id="infodiv">
        <div><header id="project_name">project name</header></div>
         <div class="financ">
          <div>
            <div><label>value of the project:</label></div>
            <label id="value" class="value">1000k $</label>
          </div>
          <div>
            <div><label>percentage of  equity to invest in </label></div>
            <label id="percentage" class="value"> </label>
          </div>
          <div>
           <div><label>asking for</label></div>
           <div><label id="price" class="value"> </label> </div>
          </div>
        </div>
        <div class="upicon"><img src="../images/upicon.png" onclick="outfromvideo()"></div>

        <div class="short" id="short">
          <div id="project-info" onclick="expand('project-info')" class="project-shot"><label>Project Info</label></div>
          <div id="prfessional-info" class="project-shot" onclick="expand('prfessional-info')" ><label>Prfessional Info</label></div>
          <div id="contact-info" class="project-shot" onclick="expand('contact-info')" ><label>Contact Info</label></div>
          <div id="detailed-project-insights" class="project-shot" onclick="expand('detailed-project-insights')" ><label>Detailed Project Insights</label></div>
          <div id="legal-info" class="project-shot" onclick="expand('legal-info')" ><label>Legal Info</label></div>
          <div id="additional-info" class="project-shot" onclick="expand('additional-info')"><label>Additional Info</label></div>


          <div class="data" id="project-info-data">
            <div><label>Project Description:</label> <label id="Project_Description">/////////</label></div>
              <div><label>Project Type:</label> <label id="Project_Type">/////////</label></div>
              <div><label>Project Stage:</label> <label id="Project_Stage">/////////</label></div>
            <div><label>Funding Goal:</label> <label id="Funding_Goal">/////////</label></div>
            <div><label>Use of Fund:</label> <label id="Use_of_Fund">/////////</label></div>

          </div>


          <div class="data" id="prfessional-info-data">
            <div><label>Company Name:</label> <label id="Company_Name">/////////</label></div>
            <div><label>Industry:</label> <label id="Industry">/////////</label></div>
            <div><label>Website URL:</label> <label id="Website_URL">/////////</label></div>


          </div>
          <div class="data" id="contact-info-data">
            <div><label>Email Address:</label> <label id="Email_Address">/////////</label></div>
            <div><label>Phone Number:</label> <label id="Phone_Number">/////////</label></div>


          </div>
          <div class="data" id="detailed-project-insights-data">
            <div><label>Business Plan:</label> <label><a  id="Business_Plan" download><img src="../images/downloadicon.png"></a></label></div>
            <div><label>Pitch Deck:</label> <label><a id="Pitch_Deck" download><img src="../images/downloadicon.png"></a></label></div>
            <div><label>Market Analysis:</label> <p id="Market_Analysis">/////////</p></div>
            <div><label>Revenue Model:</label> <label id="Revenue_Model">/////////</label></div>



          </div>
          <div class="data" id="legal-info-data">
            <div><label>Legal Documentation:</label> <label><a id="Legal_Documentation" download><img src="../images/downloadicon.png"></a></label></div>

          </div>
          <div class="data" id="additional-info-data">
            <div><label>Milestones Achieved:</label> <p id="Milestones_Achieved">sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf vsfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsfsfjvskfvsfjvnsfjvsfsfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsf sfjvskfvsfjvnsfjvsfsfjvskfvsfjvnsfjvsfsfjvskfvsfjvnsfjvsf</p></div>
              <div><label>Expected Timeline:</label> <label id="Expected_Timeline">/////////</label></div>
            <div><label>Legal Entity:</label> <label id="Legal_Entity">/////////</label></div>
            <div><label>location:</label> <label id="location">/////////</label></div>


          </div>


        </div>


      </div>
        <div class="picture" id="picturediv">
          <div >
          <img id="project_image">
        </div>
         <div>
           <div><label>Offer Details</label><img src="../images/arrowicon.png" onclick="gotooffer()"></div>
           <div><label>Video</label><img src="../images/downicon.png" onclick="video()"></div></div>


        </div>
        <form class="form display" id="form" action="../php/insert_offer.php" method="post" >
      <div class="offer display" id="offerdiv">
        <div>
          <div class="offerpro">
            <label>Fund Amount:</label>
            <div>
              <input type="number" min="1" max="999" id="Fund-Amount" step="1" class="number" name="Fund_Amount" required>
              <div class="snaperdiv1">
                <button type="button" onclick="increment('Fund-Amount')">▲</button>
                <button type="button" onclick="decrement('Fund-Amount')">▼</button>
              </div>
              <span class="marks">$</span>
            </div>

            <select class="weight" name="weight_Fund_Amount" id="weight">
              <option value="1">-</option>
              <option value="1000">K</option>
              <option value="1000000">M</option>
              <option value="1000000000">B</option>
            </select>


           </div>

          <div class="offerpro">
            <label>Equity Percentage:</label>
            <div>
              <input type="number" min="0" max="100" id="Percentage" class="number" name="Percentage" required>
              <div class="snaperdiv1">
                <button type="button" onclick="increment('Percentage')">▲</button>
                <button type="button" onclick="decrement('Percentage')">▼</button>
              </div>
              <span class="marks">%</span></div>


           </div>

          <div class="details-notes">
            <label>Other details and notes:</label>
               <textarea id="details-notes"  name="notes">

              </textarea>

          </div>

        </div>

        <div class="bottom">
          <input type="submit" value="submit" name="form" id="submit">
          <img src="../images/arrowicon1.png" onclick="outofoffer()">
        </div>

        <div>

        </div>




      </div>
        </form>

    </div>
    <div class="videodiv display" id="videodiv">
      <video controls   preload="auto" id="video">
         Your browser does not support the video tag.
      </video>
    </div>

</div>
</div>
</body>
</html>