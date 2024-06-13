
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    about TEXT NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL
);
INSERT INTO articles (title, about, content, category, image) VALUES
('Nogometni derbi privukao tisuće gledatelja', 'Napeta utakmica završila je neriješeno.', 'Na stadionu je vladala nevjerojatna atmosfera dok su ekipe igrale do zadnjeg daha. Golovi su padali s obje strane, a publika je bila u transu.', 'sport', 'nogomet.jpg'),
('Košarkaški tim osvojio prvenstvo', 'Fantastična sezona krunisana titulom.', 'Nakon naporne sezone, košarkaški tim je konačno podigao trofej pred domaćom publikom. Trener je pohvalio trud svih igrača.', 'sport', 'kosarka.jpg'),
('Otvorenje nove izložbe u muzeju', 'Posjetitelji uživali u modernim umjetničkim djelima.', 'Muzej je sinoć otvorio vrata nove izložbe koja sadrži radove suvremenih umjetnika. Izložba je privukla veliki broj ljubitelja umjetnosti.', 'kultura', 'izlozba.jpg'),
('Kazališna predstava oduševila publiku', 'Nova predstava dobila je odlične kritike.', 'Premijera nove kazališne predstave bila je veliki uspjeh. Glumci su oduševili publiku svojom izvedbom, a kritike su bile iznimno pozitivne.', 'kultura', 'kazaliste.jpg');

-- Kreiraj tablicu korisnici
CREATE TABLE korisnici (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(30) NOT NULL,
    prezime VARCHAR(30) NOT NULL,
    korisnicko_ime VARCHAR(30) NOT NULL UNIQUE,
    lozinka VARCHAR(255) NOT NULL,
    razina INT(1) NOT NULL DEFAULT 0,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Kreiraj tablicu vijesti
CREATE TABLE vijesti (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    naslov VARCHAR(100) NOT NULL,
    sazetak TEXT NOT NULL,
    tekst TEXT NOT NULL,
    slika VARCHAR(100) NOT NULL,
    kategorija VARCHAR(50) NOT NULL,
    arhiva BOOLEAN NOT NULL DEFAULT 0,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);