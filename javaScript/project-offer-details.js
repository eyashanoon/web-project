async function loadComponent(url, elementId) {
    const response = await fetch(url);
    document.getElementById(elementId).innerHTML = await response.text();
}
let widthCounter;
let heightCounter;
let interval;
let widthCounterButton;
let expShr = 1;

function expShrClicked(){
    if(expShr > 0)
        expandClicked();
    if(expShr < 0)
        shrinkClicked();
    expShr *= -1;
}
function expandClicked(){
    widthCounter = 25;
    heightCounter = 500;
    widthCounterButton = 347;
    interval = setInterval(expandMainBar, 1);
}
function expandMainBar(){
    if (widthCounter <= 0 && heightCounter >= 100 && widthCounterButton >=1407){
        clearInterval(interval);
        return;
    }
    if(widthCounter > 0)
        widthCounter -= 0.2;
    if(heightCounter < 100)
        heightCounter += 5;
    if(widthCounterButton < 1408)
        widthCounterButton += 10;
    if(widthCounterButton > 1408)
        widthCounterButton = 1408;
    let sidebar = document.getElementById('sidebar');
    let mainBar = document.getElementById('investment-details');
    let moreBar = document.getElementById('more-bar');
    let button = document.getElementById('expand-shrink-button');
    button.innerText= '🡡';
    button.style.width=widthCounterButton+'px';
    button.style.borderRadius='10px 10px 0 0';
    button.style.marginTop='20px';
    sidebar.style.width = widthCounter+'%';
    mainBar.style.width = (100-widthCounter)+'%';
    mainBar.style.marginLeft='-20px';
    moreBar.style.height = heightCounter+'100%';
}

function shrinkClicked(){
    widthCounter = 0;
    heightCounter = 500;
    widthCounterButton = 1408;
    interval = setInterval(expandSidebar, 1);
}
function expandSidebar(){
    if (widthCounter >= 25 && heightCounter <= 0 && widthCounterButton <=348) {
        clearInterval(interval)
        return;
    }
    if(widthCounter <= 25)
        widthCounter += 0.2;
    if(heightCounter >= 0)
        heightCounter -= 10;
    if(widthCounterButton >= 348)
        widthCounterButton -= 10;
    if(widthCounterButton < 347)
        widthCounterButton = 347;
    let sidebar = document.getElementById('sidebar');
    let mainBar = document.getElementById('investment-details');
    let moreBar = document.getElementById('more-bar');
    let button = document.getElementById('expand-shrink-button');
    button.innerText= '🡣';
    button.style.width = widthCounterButton+'px';
    button.style.borderRadius='0 0 10px 10px';
    button.style.marginTop='0';
    mainBar.style.width = (100-widthCounter)+'%';
    mainBar.style.borderRadius='10px';
    sidebar.style.width = widthCounter+'%';
    mainBar.style.marginLeft='10px';
    moreBar.style.height = heightCounter+'px';
}
function offerAccepted() {
    let accepted = confirm("Are you sure you want to accept this offer? Once accepted, all the other offers will be declined automatically. This cannot be undone.");
    if (accepted) {
        document.getElementById('accept_form').submit();
        document.getElementById('accept-decline').innerHTML = "<h2 style='color: Lime'> This offer was accepted.</h2>";
    }
}
function offerDeclined(){
    let declined = confirm("Are you sure you want to decline this offer? This cannot be undone.");
    if(declined){
        document.getElementById('decline_form').submit();
        document.getElementById('accept-decline').innerHTML = "<h2 style='color: red'> This offer was declined.</h2>";
    }
}
function loadOffer(){
    let status = '<?php echo $status ?>';
    if(status === "y"){
        document.getElementById('accept-decline').innerHTML = "<h2 style='color: Lime'> This offer was accepted.</h2>";
    }
    if(status === "n"){
        document.getElementById('accept-decline').innerHTML = "<h2 style='color: red'> This offer was declined.</h2>";
    }
}