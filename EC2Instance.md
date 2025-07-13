> ## **Membuat dan menyiapkan EC2 Instance** 

> ### **Membuat EC2 Instance**

1. Akses EC2 Console [https://console.aws.amazon.com/ec2/home](https://console.aws.amazon.com/ec2/home)

2. Klik tombol **Launch instance**

3. Pada **Name and tags**, di bagian **Name** masukkan nama **EC2 Instance** sebagai contoh `latihanLKSEC2Instance`

4. Pada **Application and OS Images (Amazon Machine Image)** pilih **OS Images** yang akan digunakan pada contoh ini digunakan **Ubuntu**

5. Pada **Key Pair (login)**, buat Key Pair yang nanti kita gunakan untuk mengakses server instance EC2. Klik tombol **Create new key pair**. Masukkan nama key pair **"Key pair name"** sebagai contoh `latihanLKSKeyPair`. Pada **Key pair type**, pilih **RSA** dan **Private key file format** pilih **.pem**. Terakhir klik tombol **Create key pair**

6. Pada bagian **Network settings**, di bagian **Firewall (security groups)**, Pilih **Create security group** dan checklist **Allow SSH traffic from**, **Allow HTTPS traffic from the internet**, **Allow HTTP traffic from the internet**

7. Terakhir klik tombol **Launch instance**

> ### **Instalasi Server Apache2 dan PHP**

1. Akses **EC2 Instance** yang telah dibuat sebelumnya

2. Lakukan update dan upgrade **Instance** dengan perintah berikut:
    ```bash
    sudo apt update && sudo apt upgrade -y
    ```

3. Instal **Apach2**, **PHP**, **Composer** dan **Git** dengan perintah berikut:
    ```bash
    sudo apt install apache2 php php-common php-xml php-mysqli -y composer git
    ```

4. Pindah ke lokasi direktori server dengan perintah berikut:
    ```bash 
    cd /var/www
    ```

5. Lihat info akses kepemilikan pada direktori `/var/www` dengan perintah berikut:

    ```bash
    ls -l
    ```

6. Ubah akses kepemilikan pada pada direktori `html` di di dalam `/var/www`dengan perintah berikut:  

    ```bash
    sudo chown -R ubuntu:ubuntu html
    ```

    ```bash
    sudo chmod -R 755 html
    ```

    Lihat info akses kepemilikan yang telah diubah sebelumnya 
    ```bash
    ls -l
    ```

7. Pindah ke direktori `html` dengan perintah berikut:
    ```bash
    cd html 
    ```

8. Setelah pindah ke direktor `html` ketikan perintah berikut:
    ```bash
    echo "<?php phpinfo() ?>" > phpinfo.php
    ```

9. Uji server `Instance` yang telah dibuat dengan cara berikut [http://public_ip/phpinfo.php](http://public_ip/phpinfo.php) sebagai contoh [http://3.107.174.59/phpinfo.php](http://3.107.174.59/phpinfo.php)

