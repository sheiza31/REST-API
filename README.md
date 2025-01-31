# Belajar REST API E-commerce dengan Laravel & Implementasi JWT Auth

Proyek ini adalah latihan dalam membangun **REST API** menggunakan framework **Laravel** serta mengimplementasikan autentikasi berbasis **JWT (JSON Web Token)** untuk keamanan.

## 🚀 Fitur
- CRUD (Create, Read, Update, Delete) untuk resource API
- Autentikasi pengguna menggunakan JWT
- Middleware untuk proteksi API endpoint
- Validasi request data
- Struktur project yang rapi dan terorganisir

## 🛠️ Teknologi yang Digunakan
- **Laravel** - Framework PHP untuk backend
- **JWT Auth** - Library untuk autentikasi berbasis token
- **MySQL** - Database management system
- **Postman** - Untuk testing API

## 📌 Instalasi & Konfigurasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/USERNAME/REPO_NAME.git
   cd REPO_NAME
   ```

2. Install dependensi menggunakan Composer:
   ```bash
   composer install
   ```

3. Copy file `.env.example` menjadi `.env` dan atur konfigurasi database:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

6. Install package JWT dan generate secret key:
   ```bash
   php artisan jwt:secret
   ```

7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

## 🔑 Autentikasi dengan JWT
API ini menggunakan **JWT Auth** untuk autentikasi. Berikut beberapa endpoint penting:

- **Register User**
  ```http
  POST /api/register
  ```
  **Body:**
  ```json
  {
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password"
  }
  ```

- **Login User**
  ```http
  POST /api/login
  ```
  **Body:**
  ```json
  {
    "email": "johndoe@example.com",
    "password": "password"
  }
  ```
  **Header:**
  ```
  Authorization: Bearer <your-token>
  ```

- **Logout User**
  ```http
  POST /api/logout
  ```
  **Header:**
  ```
  Authorization: Bearer <your-token>
  ```

## 🔥 Testing API
Gunakan **Postman** atau **cURL** untuk menguji endpoint yang telah dibuat.
