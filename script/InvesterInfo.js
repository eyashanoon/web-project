window.onload=function (){

    var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object

    // Configure the request
    xhr.open("GET", "../php/load_to_investor.php" , true); // Specify the URL of your server-side script

    // Define what happens on successful data retrieval
    xhr.onload = function() {
        if (xhr.status == 200) { // Check if request was successful
            var userData = JSON.parse(xhr.responseText); // Parse JSON response into JavaScript object

            // Update HTML elements with fetched data
            document.getElementById("first_name").value = userData.first_name;
            document.getElementById("last_name").value = userData.last_name;
            let g=userData.gender;

            if(g==='M'){
                document.getElementById("GenderM").click();
            }
            else {
                document.getElementById("GenderF").click();
            }
            document.getElementById("birth_day").value=userData.birth_date;
            let a=document.querySelectorAll(".Qualification");
            let i=userData.qualification;
            console.log(i);
             a[i].click();
              let timestamp = new Date().getTime();
              document.getElementById("PrsImg").src="../uploads/investor/Image/"+userData.image + '?t=' + timestamp;
              let worth=userData.total_worth;
              let weight=Math.log10(worth);
              weight/=3;
              weight=Math.floor(weight);
               document.getElementById("Nwrth").value= worth/Math.pow(10,weight*3);
              document.getElementById("totalweight").selectedIndex=weight;
              document.getElementById("cash%").value=userData.cash;
              worth=userData.collectibles;
              weight=Math.log10(worth);
              weight/=3;
              weight=Math.floor(weight);
              document.getElementById("collw").value= worth/Math.pow(10,weight*3);
              document.getElementById("weight_collectibles").selectedIndex=weight;
              document.getElementById("real-estate%").value=userData.real_estate;
              document.getElementById("Investments%").value=userData.investments;
              document.getElementById("name_investment").value=userData.prominent;
              document.getElementById("investor_experiences").value=userData.Investor_experiences;
              document.getElementById("email").value=userData.email;
              document.getElementById("phone").value=userData.phone;
              document.getElementById("password").value=userData.password;







        } else {
            console.error("Request failed. Status: " + xhr.status); // Log error if request fails
        }
    };

    // Define what happens in case of an error
    xhr.onerror = function() {
        console.error("Request failed."); // Log error if request fails
    };

    xhr.send(); // Send the request to the server
}



function fun(){
    var div=document.getElementById('projects');
    div.style.height='81%';
    var div2=document.getElementById('specification');
    div2.style.height='18%';
    div2.style.background='none';
    div2.style.overflow='visible'
    var v=div2.querySelectorAll('*');
    for(var i =0;i <v.length;i++){
        v[i].style.visibility='visible';
    }

}
function f(){
    var div=document.getElementById('projects');
    div.style.height='97%';
    var div2=document.getElementById('specification');
    div2.style.height='3%';
    div2.style.background='rgba(50,50,50,0.8)';
    div2.style.overflow='hidden'
    var v=div2.querySelectorAll('*');
    for(var i =0;i <v.length;i++){
        v[i].style.visibility='hidden';
    }

}
function ChangeBGColorofG(){
        let i=setTimeout(function(){
        let radios=document.querySelectorAll('input[name=gender]');
        for(let i=0;i<radios.length;i++){
            let label=document.querySelector(`label[for="${radios[i].id}"]`)
            if(radios[i].checked){
                 label.style.background='rgba(100,100,100,0.5)';
             }
             else {
                label.style.background='none';
            }
        }},5);

}
function ChangeBGColorofQ(){
    let i=setTimeout(function(){
        let radios=document.querySelectorAll('input[name=qualification]');
        for(let i=0;i<radios.length;i++){
            let label=document.querySelector(`label[for="${radios[i].id}"]`)
            if(radios[i].checked){
                label.style.background='rgba(100,100,100,0.5)';
                if(radios[i].id!=='none'){
                    document.getElementById('ff').classList.add('formperinfo1');

                    let i=setTimeout(function (){document.getElementById('fileupload').classList.remove('fileupload');},200);

                }
                else {
                    let classset=document.getElementById('fileupload').classList
                    if(classset.length===0)classset.add('fileupload');
                    let v= document.getElementById('ff');
                    let i=setTimeout(function (){
                        if(v.classList.contains('formperinfo1'))v.classList.remove('formperinfo1');

                    },10);
                }
            }
            else {
                label.style.background='none';
            }



        }},5);

}
function uploadfiles(fileinput){
    document.getElementById(fileinput).click();
}
function changeimge(){
   let fileopen=document.getElementById('fileimg');
   fileopen.click();

}
function FileImageSelect(){
    let image=document.getElementById('PrsImg');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

}
function increment(id) {
    const input = document.getElementById(id);
    input.stepUp();
}

function decrement(id) {
    const input = document.getElementById(id);
    input.stepDown();
}




