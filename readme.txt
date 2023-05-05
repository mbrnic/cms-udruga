
	Prilikom izrade korišten XAMPP
	MySQL database dump -> cms-udruga.sql

    1.	- u .htaccess file je zapisano da sve posjete preusmjeri na ROOT index.php

    2.	- index.php poziva autoloader.php

    3.	- autoloader.php
	- uèitavanje frontenda Boostrap
	- definiranje konstanti sa lokacijama
	- pozivanje database.php i postavljanje DB kontrolera

    4.	- database.php
	- definiranje DB konstanti za spajanje na bazu

    5.	- routes.php
	- pozivanje rutera iz libs-a
	- postavljanje Navigacijskog kontrolera
	- definiranje ruta ovisno o metodama (GET i/ili POST) i pozivanje Views/...

    6.	- Views/index.view.php
	- prva stranica koja se otvori prilikom posjete
	- preuzima postavke za navigaciju pod order id 1, ako postoji

    7.	- Log in (/user/login)
	- da bi se napravile promjene na stranici, potrebno se logirati
	- ako korisnik ne postoji, može se registrirati (/user/register)

    8.	- Dashboard (user/dashboard)
	- nakon logiranja, umjesto njega pojavi se gumb za pristup dashboard-u
	- ovdje se može pristupiti linkovima za:
		- korisnici, vidjeti sve (/users)
		- articles, napravi novi (/article/create)
		- articles, vidjeti sve (/articles)
		- navigacije, napravi novu (/navigation/create)
		- navigacije, vidjeti sve (/navigations)
		- account, promjena profila (/user/update)
		- account, logout (/user/logout)

    9.	- Users (/users)
	- pregled svih korisnika
	- moguænost editiranja podataka o korisniku - TRENUTNO NIJE FUNKCIONALNO
		- korisnik može editirati svoje podatke Account->Profile (/user/update)
	- moguænost brisanje korisnika - TRENUTNO NIJE FUNKCIONALNO
		- korisnik može obrisati svoje podatke Account->Profile (/user/update)
	- ureðivanje uloga koje korisnik ima

   10.	- Articles (/articles)
	- pregled svih èlanaka
	- moguænost editiranja podataka u èlanku
	- moguænost brisanja èlanka
	- moguænost unosa novog èlanka

   11.	- Navigations (/navigations)
	- pregled svih navigacija
	- moguænost zamjene redoslijeda izmeðu dva susjedna èlanka
	- moguænost editiranja podataka u navigaciji
	- moguænost brisanja navigacije
	- moguænost unosa nove navigacije

   12.	- OGRANIÈENI PRISTUP STRANICAMA
	- odreðenim stranicama može se pristupiti samo uz posebna prava
		- korisnik mora biti logira i mora imati dodjeljen roles
		- NIJE POTPUNO FUNKCIONALNO
	- trenutna ogranièenja vrijede samo za Article->Create
		- korisnik se mora logirati i mora imati prava da bi mogao napraviti èlanak