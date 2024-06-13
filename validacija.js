document.getElementById("slanje").onclick = function(event) {
    var slanjeForme = true;

    // Validacija naslova
    var poljeTitle = document.getElementById("title");
    var title = poljeTitle.value;
    if (title.length < 5 || title.length > 30) {
        slanjeForme = false;
        poljeTitle.style.border = "1px dashed red";
        document.getElementById("porukaTitle").innerHTML = "Naslov vijesti mora imati između 5 i 30 znakova!<br>";
    } else {
        poljeTitle.style.border = "1px solid green";
        document.getElementById("porukaTitle").innerHTML = "";
    }

    // Validacija kratkog sadržaja
    var poljeAbout = document.getElementById("about");
    var about = poljeAbout.value;
    if (about.length < 10 || about.length > 100) {
        slanjeForme = false;
        poljeAbout.style.border = "1px dashed red";
        document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
    } else {
        poljeAbout.style.border = "1px solid green";
        document.getElementById("porukaAbout").innerHTML = "";
    }

    // Validacija sadržaja
    var poljeContent = document.getElementById("content");
    var content = poljeContent.value;
    if (content.length == 0) {
        slanjeForme = false;
        poljeContent.style.border = "1px dashed red";
        document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
    } else {
        poljeContent.style.border = "1px solid green";
        document.getElementById("porukaContent").innerHTML = "";
    }

    // Validacija slike
    var poljeSlika = document.getElementById("pphoto");
    var pphoto = poljeSlika.value;
    if (pphoto.length == 0) {
        slanjeForme = false;
        poljeSlika.style.border = "1px dashed red";
        document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
    } else {
        poljeSlika.style.border = "1px solid green";
        document.getElementById("porukaSlika").innerHTML = "";
    }

    // Validacija kategorije
    var poljeCategory = document.getElementById("category");
    if (poljeCategory.selectedIndex == 0) {
        slanjeForme = false;
        poljeCategory.style.border = "1px dashed red";
        document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
    } else {
        poljeCategory.style.border = "1px solid green";
        document.getElementById("porukaKategorija").innerHTML = "";
    }

    if (!slanjeForme) {
        event.preventDefault();
    }
};
