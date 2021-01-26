document.addEventListener("keydown", (e)=>{
    if(e.code === "Escape"){
        hideSettingsPopup(e);
    }
});

window.addEventListener("load", ()=>{
    popupInit();
});

function popupInit(){
    let e = document.querySelectorAll(".popup-window");
    for(let i of e) {
        i.addEventListener("click", hidePopup);
        i.children[0].addEventListener("click", (e) => e.stopPropagation());
    }
}

function showPopup(id){
    let e = document.getElementById(id);
    if(e && !e.classList.contains("show"))
        e.classList.add("show");
}

function hidePopup(event){
    if(event)
        event.stopPropagation();

    let e = document.querySelectorAll(".popup-window");
    for(let i of e){
        i.classList.remove("show");
    }
}