### Buat user data pada

## Langkah Install APACHE dan PHP
### Update dan upgrade version repository linux/ubuntu
```bash
sudo yum update
```
### Install Apache2 dan PHP beserta module php-mysqli 
```bash
sudo yum install httpd php php-mysqli php-common php-xml php-unzip
```
```bash
sudo systemctl enable httpd
sudo systemctl start httpd
sudo systemctl status httpd
```
```bash
php -v
```
### Install git unzip composer 
```bash
sudo yum install git unzip composer
```
### Mengubah kepemilikan directory /var/www/html
```bash
sudo chown -R ec2-user:ec2-user /var/www/html
sudo chmod -R 775 /var/www/html
```
### Menghapus file index.html
```bash
sudo rm index.html
```
```bash
git clone https://github.com/AyundaRisuCh/belajarLKS.git .
```
## Langkah install phpMyAdmin
### Download phpMyAdmin
```bash
sudo wget https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.tar.gz
```
```bash
sudo mkdir /var/www/html/phpmyadmin
```
```bash
sudo tar xvf phpMyAdmin-latest-all-languages.tar.gz --strip-components=1 -C /var/www/html/phpmyadmin
```
``` bash
sudo cp /var/www/html/phpmyadmin/config.sample.inc.php /var/www/html/phpmyadmin/config.inc.php
```
``` bash
sudo nano /var/www/html/phpmyadmin/config.inc.php
```
``` bash
$cfg['blowfish_secret'] = 'My_Secret_Passphras3!';
```
``` bash
sudo chmod 775 /var/www/html/phpmyadmin/config.inc.php
```
``` bash
sudo chown -R ec2-user:ec2-user /var/www/html/phpmyadmin
```
``` bash
sudo systemctl restart httpd
```

``` bash
-- Membuat database sederhana
CREATE DATABASE IF NOT EXISTS sigap_db;

-- Menggunakan database
USE sigap_db;

-- Membuat tabel users sederhana
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    no_hp VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'user' NOT NULL
);
```
``` bash
-- Data admin (password dalam plain text - HANYA UNTUK BELAJAR)
INSERT INTO users (nama, email, no_hp, password, role)
VALUES (
    'admin', 
    'admin@sigap.id', 
    '081122334455', 
    'admin123',  -- Password dalam plain text
    'admin'
);

-- Data user biasa (password dalam plain text - HANYA UNTUK BELAJAR)
INSERT INTO users (nama, email, no_hp, password, role)
VALUES (
    'user', 
    'user@test.com', 
    '085678901234', 
    'user123',  -- Password dalam plain text
    'user'
);
```
``` bash
-- Buat di sql phpMyAdmin untuk bencana

CREATE TABLE data_bencana (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_bencana VARCHAR(50) NOT NULL,
    lokasi VARCHAR(100) NOT NULL,
    waktu_kejadian DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

Membuat replica di aws

- klik dashboard RDS
- klik db instance
- centang database lalu klik action klik create read replica
- buat nama, single AZ, IPv4, publicly accessible, enable auto minor, lalu create read replica dan tunggu sampai available
- jika sudah klik replica yang dibuat tadi dan copy endpointnya, pastekan endpointnya di tampil.php

