# Crud School Management

Proiect pentru managementul unei școli.

## Seeding

Rulați comenzile
```bash
php artisan migrate
php artisan db:seed --class=UserSeeder
php artisan serve
```

## Autentificare

Pentru Admin:
```bash
Email: admin@mail.com
Parola: admin@mail.com
```
Pentru Profesor:
```bash
Email: teacher@mail.com
Parola: teacher@mail.com
```
Un profesor poate creea o clasă si adăuga elevi in clasă, dar nu o poate șterge.
Directorul vede toate clasele, toți profesorii, toti elevii, dacă elevii nu sunt înrolați in vreo clasă acesta poate decide să le dea permisiune de profesor, în caz ca un profesor nou și-a făcut cont. Directorul poate scoate elevi din clasă, poate șterge elevi sau profesori, poate șterge clase. Elevul poate fi doar membru al unei clase, și el are acces la lista elevilor din clasa respectivă.

