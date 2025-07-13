
#### 3. **Buat file buildspec.yml**
a. Buka project pada Visual Studio Code:

b. Buat file baru dengan nama buildspec.yml di root folder proyek:

```bash
version: 0.2

phases:
  install:
    runtime-versions:
      php: 8.2
    commands:
      - echo "📦 Installing dependencies..."
      - sudo apt install php-cli php-json php-mbstring php-xml php-pcov php-xdebug
  pre_build:
    commands:
      - echo "🔐 Setting up SSH private key"

  build:
    commands:
      - echo "✅ Running unit tests..."

  post_build:
    commands:
      - echo "🚀 Deploying to EC2..."

artifacts:
  files:
    - '**/*'
```

c. Simpan kode pada file buildspec.yml

d. tambahkan pada git dengan perintah berikut:
```bash
git add buildspec.yml
```

e. Buat commit pada git dengan perintah berikut:
```bash
git commit -m "Create file buildspec.yml"
```

f. Push ke GitHub dengan perintah berikut:
```bash
git push -u origin main
```

#### Buat connection

1. Masuk ke service CodeCommit

2. Disebelah kiri paling bawah klik Setings dan klik Connections

3. Create Connection

4. Select providernya GitHub dan masukkan nama connectionnya, dan connect to GitHub

5. Pada app instalations buat repository access menjadi all repositories, klik save

6. Kemudian connect

7. Masuk ke CodeBuild

8. Klik create project

9. Buat nama projectnya, source ubah menjadi github jika belum ada akun dikaitkan dulu akunnya, pilih "repository in my GitHub account" dan pilih repositorynya.

10. Build typenya single build

11. Pada Environment OS nya buat ubuntu, pada service rolenya buat new role jika belum punya role (buat permision policiesnya AmazonEC2RoleforAWSCodeDeploy)

12. Build specifications pilih Use a buildspec file dan masukkan namanya "buildspec.yml" (buat dulu filenya di vscode)

13. Artifact primarynya pilih "Amazon S3", dan pilih bucket name yang dibuat tadi

14. Klik Create build project

15. Masuk ke code deploy

16. Pilih application, dan creat application

17. Buat namanya dan platformnya pilih EC2, dan klik Create application
