# test-detik
OS : Windows
DB : My Sql
Env Development: Docker Composer

How to run
1. install docker 
    - referensi yang saya gunakan untuk instalasi docker 
        https://www.ionos.com/digitalguide/server/configuration/install-docker-compose-on-windows/
2. run di command line project : docker-compose up --build
3. create database dengan nama detik.sql atau bisa menggunakan db yg ada di file migration
4. untuk soal no 3 php cli, step :
    - masuk ke directory file : cd src
    - run di command line, format file : php transaction-cli.php {references_id} {status}
        contoh php transaction-cli.php ref-001 Paid