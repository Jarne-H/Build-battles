/**on press of buttom with id #overworld change src of iframe element to http://176.31.207.12:7848/?worldname=world */
let map = document.getElementById("map");
let overworld = document.getElementById("overworld");
let nether = document.getElementById("nether");
let end = document.getElementById("end");

overworld.addEventListener("click", function () {
    map.src = "http://176.31.207.12:7848/?worldname=world";
});

nether.addEventListener("click", function () {
    map.src = "http://176.31.207.12:7848/?worldname=world_nether";
});

end.addEventListener("click", function () {
    map.src = "http://176.31.207.12:7848/?worldname=world_the_end";
});

frame.addEventListener("load", ev => {
    const new_stylesheet = document.createElement("link");
    new_stylesheet.src = "/src/public/css/dynmap-style.css"
    ev.target.contentDocument.head.appendChild(new_stylesheet);
});