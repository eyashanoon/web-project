window.onload=function (){

    let xhr = new XMLHttpRequest();

     xhr.open("GET", "../php/load_to_home.php" , true);


    xhr.onload = function() {
        if (xhr.status == 200) {
            var userData = JSON.parse(xhr.responseText);

            document.getElementById("name").innerText = "Name:" + userData.first_name + " " + userData.last_name;
            let t=(userData.gender === 'M') ? "Male" : "Female";
            document.getElementById("gender").innerText = "Gender:"+t;
            document.getElementById("birth_date").innerText = "Birth Date:" + userData.birth_date;
            document.getElementById("email").innerText = "Email:" + userData.email;
            document.getElementById("phone").innerText = "Phone:" + userData.phone;
            document.getElementById("prominent").innerText = "M I:" + userData.prominent;
            document.getElementById("image").src="../uploads/investor/Image/"+userData.image;
         } else {
            console.error("Request failed. Status: " + xhr.status);
        }
    };

     xhr.onerror = function() {
        console.error("Request failed.");
    };

    xhr.send();



    let div2=document.getElementById('specification');
    for(let i=0;i<div2.children[0].children.length-1;i++){
        div2.children[0].children[i].classList.add('display');
    }
    let xhr1 = new XMLHttpRequest();
    xhr1.open("GET", "../php/rate.php" , true);
    xhr1.onload = function() {
        if (xhr1.status == 200) {
            let num = JSON.parse(xhr1.responseText);
            num*=5;
            for (let i=0;i<num;i++)ChangeRate();

        }
    };

    xhr1.onerror = function() {
        console.error("Request failed.");
    };

    xhr1.send();




}
function fun(){
    let ext=document.getElementById('extra');
    let div=document.getElementById('projects');
    let div2=document.getElementById('specification');
    ext.classList.add('extra1');
    let i=setTimeout(function (){
        div.classList.add('projects1');
        div2.classList.add('specification1');
     let upicon=document.getElementById('upicon');
     upicon.onclick=f;

        for(let i =0;i <div2.children[0].children.length-1;i++){
            div2.children[0].children[i].classList.remove('display');
        }
    },500);

}
function f(){
    let div=document.getElementById('projects');
     let div2=document.getElementById('specification');
    let ext=document.getElementById('extra');
    let upicon=document.getElementById('upicon');
    upicon.onclick=null;
    event.stopPropagation();
    div.classList.remove('projects1');
     div2.classList.remove('specification1')

    for(let i =0;i <div2.children[0].children.length-1;i++){
        div2.children[0].children[i].classList.add('display');

    }
    let i=setTimeout(function (){
        ext.classList.remove('extra1');

    },500);


}
function ChangeRate(){
    var j=document.getElementById('Rate');
    var Rate=j.children;
    let i = 0;

    for( ;i<Rate.length;i++){

        if( Rate[i].classList.length===3)continue;
       else break;
    }
    Rate[i].classList.add('checked');
}

function project_hover(){

      let div=event.target.querySelector('.projectinerdiv');

      div.classList.remove('projectinerdiv')
      div.classList.add('projectinerdiv1');

}
function projectout(){
     let div= event.target.querySelector('.projectinerdiv1')
         div.classList.remove('projectinerdiv1');
         div.classList.add('projectinerdiv');
  }
function increment(id) {
    const input = document.getElementById(id);
    input.stepUp();
}

function decrement(id) {
    const input = document.getElementById(id);
    input.stepDown();
}

function gotoptoject(){

     if (event.target && event.target.closest( '.project'))  {
        let project = event.target.closest('.project');
         let email = project.querySelector('.ul>li:nth-child(5)').innerText;

         event.preventDefault();

         const xhr = new XMLHttpRequest();
         xhr.open('POST', '../php/store_email.php', true);
         xhr.setRequestHeader('Content-Type', 'application/json');
         xhr.onreadystatechange = function() {
             if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                 console.log('Email stored in session:', xhr.responseText);
             }
         };
         const data = JSON.stringify({ email: email });
         xhr.send(data);

        window.location.href = '../html/projectdetals.php';
    }
}
function infoshow(){
    let arrow=document.getElementById('arrow');
    let info=document.getElementById('investerinfo');
    let content=document.getElementById('content');
    let outinfo=document.getElementById('outinfo');
     info.classList.remove('display');

    arrow.onclick=null;
    arrow.onclick=infohide;

     let i=setTimeout(function () {

         arrow.classList.add('arrow1');
         outinfo.classList.add('outinfo');
         content.classList.add('content1');
         info.classList.add('investerinfo1');
     },10);


}
function infohide(){
    let arrow=document.getElementById('arrow');
    let info=document.getElementById('investerinfo');
    let content=document.getElementById('content');
    let outinfo=document.getElementById('outinfo');
    arrow.onclick=null;
    arrow.onclick=infoshow;

     arrow.classList.remove('arrow1');
    outinfo.classList.remove('outinfo');
    content.classList.remove('content1');
    info.classList.remove('investerinfo1');

    let i=setTimeout(function () {
        info.classList.add('display');


    },500);

}
function load_project(){
    var xhr = new XMLHttpRequest();
    var url = '../php/load_projects.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var container = document.getElementById('projects-iner');
                while (container.firstChild) {
                    container.removeChild(container.firstChild);
                }

                // Fetch the HTML template
                var templateRequest = new XMLHttpRequest();
                templateRequest.open('GET', '../html/project.html', true);
                templateRequest.onreadystatechange = function() {
                    if (templateRequest.readyState === XMLHttpRequest.DONE) {
                        if (templateRequest.status === 200) {
                            var template = templateRequest.responseText;

                            data.forEach(function(project) {
                                // Create a new DOM element from the template
                                var templateElement = document.createElement('div');
                                templateElement.innerHTML = template.trim();
                                var block = templateElement.firstChild;

                                // Replace placeholders with actual data
                                block.querySelector('img').src = "../uploads/project/pictures/" + project.picture;
                                block.querySelector('.projectinerdiv').innerText = project.description;
                                block.querySelector('ul >li:nth-child(1)').innerText = project.name;
                                block.querySelector('ul >li:nth-child(2)').innerText = project.type;
                                block.querySelector('ul >li:nth-child(3)').innerText = project.location;
                                block.querySelector('ul >li:nth-child(4)').innerText = project.project_value+"$";
                                block.querySelector('ul >li:nth-child(5)').innerText = project.email;


                                // Append the populated template to the container
                                container.appendChild(block);
                            });
                        }
                    }
                };
                templateRequest.send();
            }
        }
    };


    let search=document.getElementById("search");
    let type=document.getElementById("type");
    let min =document.getElementById("value_min");
    let min_weight =document.getElementById("weight_min");
    let max =document.getElementById("value_max");
    let max_weight =document.getElementById("weight_max");
    let location=document.querySelector('.btn.dropdown-toggle.btn-default>.filter-option.pull-left');


    let conditions={};
    conditions['search']=search.value;
    conditions['type']=type.value;
    if(min.value!==0) {
        conditions['min'] = min.value * min_weight.value;
        console.log("jkkk");
    }
    else conditions['min']=min.value;
    if(max.value!=="")conditions['max']=min.value*max_weight.value;
    else conditions['max']=min.value;
    conditions['location']=location.textContent.trimStart();
    if(conditions['location']==="--")conditions['location']="";


    xhr.send(JSON.stringify(conditions));

}
$(document).ready(function (){
    let i=setTimeout(function (){
        let element=document.querySelector(".dropdown-menu.inner");
        let afg=document.querySelector('li[data-original-index="0"]');

        let block=`<li data-original-index="250" ><a tabindex="0" class="option-with-flag" data-tokens="--" role="option" aria-disabled="false" aria-selected="true"> <span class="text">--</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>`;
        element.innerHTML+=block;
        let aa =document.querySelector('.selectpicker.countrypicker.f16');
        block2 = `<option data-tokens="--"   className="option-with-flag" value="--">--</option>`
        aa.innerHTML+=block2;
        let location=document.querySelector('.btn.dropdown-toggle.btn-default>.filter-option.pull-left');
        location.innerText="--";
        let kk=document.querySelector('.dropdown-menu.inner')
        kk.addEventListener('click',load_project);

        load_project();
    },1000);

});