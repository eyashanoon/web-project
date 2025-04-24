window.onload=function (){
    let div=document.getElementById('gridcon');
    let y=div.offsetHeight;
    y*=0.2;
    let s=y+'px';
    document.documentElement.style.setProperty('--heigh-value',s);
    if(div.children[0].children.length>0){
        let project=div.children[0].children[0];
        s=1.2*project.offsetWidth+'px'
        document.documentElement.style.setProperty('--width-project',s);

    }
    load_offers()

 }
function expand(){
    if (event.target && (event.target.closest('.project'))|| event.target.closest('a')) {


         let div = event.target.closest('.project')
         div.children[0].classList.add('display');
        console.log( div.children[0].style.display);
        let con = document.getElementById('projects');
        let prediv = document.querySelector('.project2')
        if (prediv !== null) {
            prediv.children[1].classList.add('display');
            prediv.children[0].classList.remove('display');

            prediv.classList.remove('project2');
            let temp1 = document.getElementById('temp');
            const containerRect = con.getBoundingClientRect();
            const elementRect = div.getBoundingClientRect();

            const relativeX = 0;
            const relativeY = elementRect.top - containerRect.top;
            document.documentElement.style.setProperty('--x', relativeX + 'px');
            document.documentElement.style.setProperty('--y', relativeY + 'px');

            con.removeChild(temp1);

            prediv.classList.remove('project1');
            if(prediv===div)return;

        } else {
            const containerRect = con.getBoundingClientRect();
            const elementRect = div.getBoundingClientRect();

            const relativeX = 0;
            const relativeY = elementRect.top - containerRect.top;
            document.documentElement.style.setProperty('--x', relativeX + 'px');
            document.documentElement.style.setProperty('--y', relativeY + 'px');
        }

        let temp = document.createElement('div');


        temp.classList.add('temp');
        temp.style.visibility = 'hidden';
        temp.id = 'temp';




        let i = setTimeout(function () {

            div.classList.add('project1');
            con.insertBefore(temp, div);
            div.classList.add('project2');
            div.children[1].classList.remove('display');

        }, 10);
    }
event.stopPropagation();

}

function load_offers(){
    var xhr = new XMLHttpRequest();
    var url = '../php/load_offers.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                var container = document.getElementById('projects');
                while (container.firstChild) {
                    container.removeChild(container.firstChild);
                }

                // Fetch the HTML template
                var templateRequest = new XMLHttpRequest();
                templateRequest.open('GET', '../html/offer.html', true);
                templateRequest.onreadystatechange = function() {
                    if (templateRequest.readyState === XMLHttpRequest.DONE) {
                        if (templateRequest.status === 200) {
                            let template = templateRequest.responseText;
                            let blocks=[];
                              data[1].forEach(function(offer) {
                                // Create a new DOM element from the template
                                let templateElement = document.createElement('div');
                                templateElement.innerHTML = template.trim();
                                block = templateElement.firstChild;

                                // Replace placeholders with actual data
                                block.querySelector('.shortdiv>label:first-child').innerText =offer.name;
                                block.querySelector('.proname>label').innerText=offer.name;
                                block.querySelector('.prodisc>p').innerText = offer.description;
                                block.querySelector('.proemail>label').innerText = offer.email;
                                block.querySelector( '.img7').src = "../uploads/project/pictures/"+offer.picture;
                                blocks.push(block);

                            });

                            let i=0;
                            data[0].forEach(function(offer) {
                                 let block= blocks[i++];
                                 block.querySelector('.shortdiv>label:nth-child(2)').innerText = offer.date;
                                console.log(offer.status);
                                let y='y';
                                let n='n';
                                if(offer.status===y){
                                    block.querySelector('.shortdiv>img').src="../images/accepted.png";
                                    block.querySelector('.status').src="../images/accepted.png";
                                }
                                else if(offer.status===n){
                                    block.querySelector('.shortdiv>img').src="../images/rejected.png";
                                    block.querySelector('.status').src="../images/rejected.png";


                                }
                                else {
                                    block.querySelector('.shortdiv>img').src = "../images/on-hold.png";
                                    block.querySelector('.status').src = "../images/on-hold.png";
                                }
                                block.querySelector('.pers').innerText=offer.percentage;
                                block.querySelector('.price').innerText=offer.price;
                                container.appendChild(block);


                            });


                        }
                    }
                };
                templateRequest.send();
            }
        }
    };



    xhr.send( );
}
function gotoproject(){
    event.stopPropagation();
    let email=event.target.parentElement.parentElement.querySelector('.proemail').innerText;
    console.log(email);

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



    window.location.href="../html/projectdetals.php"
}