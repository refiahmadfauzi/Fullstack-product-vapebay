# Proyek Ujian Teknis: Manajemen Produk Full-Stack

Proyek ini adalah aplikasi full-stack yang dibangun untuk memenuhi ujian teknis. Aplikasi ini memungkinkan pengguna untuk melihat daftar produk, menambahkan produk baru melalui antarmuka web, dan mengelola semua produk melalui panel admin.

## Tumpukan Teknologi (Tech Stack)

Berikut adalah teknologi yang digunakan dalam proyek ini sesuai dengan persyaratan:

* **Frontend:** Nuxt.js
* **Backend (API):** NestJS
* **Backend (Admin Panel):** Laravel Filament
* **Database:** PostgreSQL
* **CI/CD:** GitLab CI
* **Infrastruktur:** Digital Ocean & Terraform

## Struktur Proyek

Repositori ini menggunakan pendekatan **monorepo** untuk mengelola semua layanan dalam satu tempat.

## Panduan Setup dan Instalasi

Berikut adalah langkah-langkah untuk menyiapkan dan menjalankan keseluruhan proyek secara lokal.

### Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut di sistem Anda:
* Node.js (v18 atau lebih baru)
* NPM atau Yarn
* PHP (v8.1 atau lebih baru)
* Composer
* PostgreSQL
* Git

###  Kloning Repositori
```bash
git clone [https://github.com/refiahmadfauzi/Fullstack-product-vapebay.git](https://github.com/refiahmadfauzi/Fullstack-product-vapebay.git)
cd fullstack-product-vapebay
```
###  Run setiap folder
Open folder digithub web untuk liat caranya

### Buat database vapebay_test
schema public
lalu import table-table nya
sesuiakan di beckend-api/src/app.module.ts
sesuikan juga di admin-app/.env

Terimakasih

