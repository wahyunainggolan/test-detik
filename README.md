# test-detik
How to run
1. install docker 
    - referensi yang saya gunakan untuk instalasi docker 
        https://www.ionos.com/digitalguide/server/configuration/install-docker-compose-on-windows/
2. docker-compose up --build
3. create database dengan nama detik.sql atau bisa menggunakan db yg ada di file migration
4. untuk soal no 3 php cli format file : php transaction-cli.php {references_id} {status}
    contoh php transaction-cli.php ref-001 Paid