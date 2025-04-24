window.onload=function (){

    var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object

    // Configure the request
    xhr.open("GET", "../php/load_project_detales.php" , true); // Specify the URL of your server-side script

    // Define what happens on successful data retrieval
    xhr.onload = function() {
        if (xhr.status == 200) { // Check if request was successful
            let userData = JSON.parse(xhr.responseText); // Parse JSON response into JavaScript object
            document.getElementById("project_name").innerText=userData[0].name;
            document.getElementById("Project_Description").innerText=userData[0].description;
            document.getElementById("Project_Type").innerText=userData[0].type;
            document.getElementById("Project_Stage").innerText=userData[0].stage;
            document.getElementById("Funding_Goal").innerText=userData[0].fund_goal;
            document.getElementById("Use_of_Fund").innerText=userData[0].fund_use;
            document.getElementById("Company_Name").innerText=userData[0].company_name;
            document.getElementById("Industry").innerText=userData[0].industry;
            document.getElementById("Website_URL").innerText=userData[0].website_url;
            document.getElementById("Email_Address").innerText=userData[0].email
            document.getElementById("Phone_Number").innerText=userData[0].phone_number;
            document.getElementById("Business_Plan").href="../uploads/project/business_plan/"+userData[0].business_plan;
            document.getElementById("Pitch_Deck").href="../uploads/project/pitch_deck/"+userData[0].pitch_deck;
            document.getElementById("Market_Analysis").innerText=userData[0].market_analysis;
            document.getElementById("Revenue_Model").innerText=userData[0].revenue_model;
            document.getElementById("Legal_Documentation").href="../uploads/project/legal_docs/"+userData[0].legal_doc;
            document.getElementById("Milestones_Achieved").innerText=userData[0].milestones;
            document.getElementById("Expected_Timeline").innerText=userData[0].expected_timeline;
            document.getElementById("Legal_Entity").innerText=userData[0].legal_entity;
            document.getElementById("location").innerText=userData[0].location;
            document.getElementById("video").src="../uploads/project/videos/"+userData[0].video_ver;
            document.getElementById("project_image").src="../uploads/project/pictures/"+userData[0].picture;
            let value=userData[0].project_value;
            let weight="";
            if(value>1000000000){
                value/=1000000000;
                weight=" B";
            }
            else if (value>1000000){
                value/=1000000;
                weight=" M"
            }
            else if (value>1000){
                value/=1000;
                weight=" K";
            }

            document.getElementById("value").innerText=value+weight;
            document.getElementById("percentage").innerText=userData[0].equity_percentage;

            value=userData[0].asking_for;
            weight="";
            if(value>1000000000){
                value/=1000000000;
                weight=" B";
            }
            else if (value>1000000){
                value/=1000000;
                weight=" M"
            }
            else if (value>1000){
                value/=1000;
                weight=" K";
            }
            document.getElementById("price").innerText=value+weight;




            if(userData[1]){
                let worth=userData[1].price;
                let weight=Math.log10(worth);
                weight/=3;
                weight=Math.floor(weight);
                 document.getElementById("weight").selectedIndex=weight;
                document.getElementById("Fund-Amount").value=worth/Math.pow(10,weight*3);


                document.getElementById("Percentage").value=userData[1].percentage;
                document.getElementById("details-notes").value=userData[1].notes;
                if(userData[1].status==="y" || userData[1].status==="n"){
                    document.getElementById("submit").style.display="none";
                }




            }


        }
    };

    // Define what happens in case of an error
    xhr.onerror = function() {
        console.error("Request failed."); // Log error if request fails
    };

    xhr.send();






    let div=document.getElementById('short');
    let width=div.offsetWidth;
     document.documentElement.style.setProperty('--width-value',width*0.49999+'px');
     let y=div.getBoundingClientRect();
     document.documentElement.style.setProperty('--offsetY-value',y.top);
 }



function expand(id){

    let div=document.getElementById(id);
    let div1=document.getElementById(id+'-data');
    let con=document.getElementById('short');
    for(let i=0;i<6;i++){
        if( con.children[i].classList.contains('project-specification2')){
            con.children[i].classList.remove('project-specification2');
            con.children[i].classList.remove('project-specification1');
            con.children[i].classList.remove('project-specification');
            let s=con.children[i].id+'-data';
             let condiv=document.getElementById(s);
            condiv.classList.remove('data1');
            condiv.style.display='none';
            if(con.children[i]===div)return;
            break;
         }
    }


    div.classList.add('project-specification');
        let i=setTimeout(function (){

              div.classList.add('project-specification1');
            },500);

    let y=div.getBoundingClientRect();
    let r = document.querySelector(':root');
    var rs = getComputedStyle(r);

    let d=-(y.top-rs.getPropertyValue('--offsetY-value')-11);
    document.documentElement.style.setProperty('--heigh-value',d+'px');
       i=setTimeout(function (){
        div.classList.add('project-specification2');
    },520);

       i=setTimeout(function (){
           div1.style.display='grid';
            let j=setTimeout(function (){ div1.classList.add('data1');},100);

       },500);

}
function gotooffer(){
    let div1=document.getElementById('picturediv');
    let div2=document.getElementById('offerdiv');
    let form=document.getElementById("form");
    div1.classList.add('picture1');
    let i=setTimeout(function (){div1.classList.add('display')
    },490);
     div2.classList.remove('display');
     form.classList.remove('display');
    i=setTimeout(function (){
        div2.classList.add('offer1');
        form.classList.add('form1');
        },100);
}
function video(){
    let div1=document.getElementById('infodiv');
    let div2=document.getElementById('picturediv');
    let div3=document.getElementById('projectinfo');

    let g=document.getElementById('videodiv');
    div1.children[2].style.display='block';
    for(let i=3;i<div1.children.length;i++){
        div1.children[i].classList.add('display');
    }

    div1.classList.add('info1');
    div2.classList.add('picture2');
    div3.classList.add('projectinfo1');

    let i=setTimeout(function (){
        div2.classList.add('display');
    },500);
    g.classList.remove('display');
}
function outfromvideo(){
    let div1=document.getElementById('infodiv');
    let div2=document.getElementById('picturediv');
    let div3=document.getElementById('projectinfo');
    let g=document.getElementById('videodiv');
    g.classList.add('display');

    div1.children[2].style.display='none';
    for(let i=3;i<div1.children.length;i++){
        div1.children[i].classList.remove('display');
    }

     div1.classList.remove('info1');
    div2.classList.remove('picture2');
    div3.classList.remove('projectinfo1');
    div2.classList.remove('display');

}
function outofoffer(){
    let div1=document.getElementById('picturediv');
    let div2=document.getElementById('offerdiv');
    let form=document.getElementById("form");

     form.classList.remove('form1');

    let i=setTimeout(function (){
         form.classList.add('display');

        },490);
     div1.classList.remove('display');

    i=setTimeout(function (){
        div1.classList.remove('picture1');},100);
}
function increment(id) {
    const input = document.getElementById(id);
    input.stepUp();
}

function decrement(id) {
    const input = document.getElementById(id);
    input.stepDown();
}