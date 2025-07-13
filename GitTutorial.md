
> ### **Initialisasi Git dengan** `git init`

```bash
git init
```

> ### **Menambahkan perubahan repositori lokal Git dengan** `git add`

Menambhakan perubahan pada file tertentu dengan perintah berikut
`git add nama_file`
sebagai contoh:

```bash
git add index.html
```

Dapat juga menggunakan perintah berikut `git add .` untuk menambahkan keseluruhan perubahan pada repository.

```bash
git add .
```

> ### **Melakukan commit pada repository lokal git dengan** `git commit`

Untuk melakukan commit untuk perubahan repositori lokal git gunakan perintah `git commit -m "Catatan Perubahan Repositori"` sebagai contoh:

```bash
git commit -m "Menambahkan file index.html"
```

> ### **Melakukan update dari repositori lokal Git ke GitHub dengan** `git push`

Untuk melakukan update dari repositori lokal Git ke GitHub gunakan perintah berikut:

```bash
git push -u origin main
```

> ### **Melakukan update dari repositori GitHub ke repositori Lokal (Git) dengan** `git pull`

Untuk melakukan update dari repositori Github ke repositori Lokal (Git) gunakan perintah berikut:

```bash
git pull origin main
```

> ### **Melakukan update dari repositori GitHub ke repositori Lokal (Git) dengan** `git fetch`

```bash
git fetch origin main
```

> ### **Mendownload Repositori Github** dengan `git clone`

`git clone [link_repository]`
sebagai contoh

```bash
git clone https://github.com/AyundaRisuCh/latihanLKS.git
```