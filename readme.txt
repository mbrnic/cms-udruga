
	Prilikom izrade kori�ten XAMPP
	MySQL database dump -> cms-udruga.sql

    1.	- u .htaccess file je zapisano da sve posjete preusmjeri na ROOT index.php

    2.	- index.php poziva autoloader.php

    3.	- autoloader.php
	- u�itavanje frontenda Boostrap
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
	- ako korisnik ne postoji, mo�e se registrirati (/user/register)

    8.	- Dashboard (user/dashboard)
	- nakon logiranja, umjesto njega pojavi se gumb za pristup dashboard-u
	- ovdje se mo�e pristupiti linkovima za:
		- korisnici, vidjeti sve (/users)
		- articles, napravi novi (/article/create)
		- articles, vidjeti sve (/articles)
		- navigacije, napravi novu (/navigation/create)
		- navigacije, vidjeti sve (/navigations)
		- account, promjena profila (/user/update)
		- account, logout (/user/logout)

    9.	- Users (/users)
	- pregled svih korisnika
	- mogu�nost editiranja podataka o korisniku - TRENUTNO NIJE FUNKCIONALNO
		- korisnik mo�e editirati svoje podatke Account->Profile (/user/update)
	- mogu�nost brisanje korisnika - TRENUTNO NIJE FUNKCIONALNO
		- korisnik mo�e obrisati svoje podatke Account->Profile (/user/update)
	- ure�ivanje uloga koje korisnik ima

   10.	- Articles (/articles)
	- pregled svih �lanaka
	- mogu�nost editiranja podataka u �lanku
	- mogu�nost brisanja �lanka
	- mogu�nost unosa novog �lanka

   11.	- Navigations (/navigations)
	- pregled svih navigacija
	- mogu�nost zamjene redoslijeda izme�u dva susjedna �lanka
	- mogu�nost editiranja podataka u navigaciji
	- mogu�nost brisanja navigacije
	- mogu�nost unosa nove navigacije

   12.	- OGRANI�ENI PRISTUP STRANICAMA
	- odre�enim stranicama mo�e se pristupiti samo uz posebna prava
		- korisnik mora biti logira i mora imati dodjeljen roles
		- NIJE POTPUNO FUNKCIONALNO
	- trenutna ograni�enja vrijede samo za Article->Create
		- korisnik se mora logirati i mora imati prava da bi mogao napraviti �lanak