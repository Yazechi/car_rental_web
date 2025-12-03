-- Database Schema untuk Rental Mobil dengan Role System dan Content Management
CREATE DATABASE IF NOT EXISTS rental_db2;
USE rental_db2;

-- Tabel users (update dengan role)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(20),
    alamat TEXT,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin dan user
INSERT INTO users (username, password, nama_lengkap, email, role) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@nusantararent.com', 'admin'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'User Demo', 'user@example.com', 'user');
-- Password admin: admin
-- Password user: user

-- Tabel cars (sudah ada, pastikan struktur)
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_mobil VARCHAR(100) NOT NULL,
    jenis VARCHAR(50),
    harga INT NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    status ENUM('tersedia', 'disewa') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel bookings (pemesanan)
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    durasi_hari INT NOT NULL,
    total_harga INT NOT NULL,
    dengan_supir ENUM('ya', 'tidak') DEFAULT 'tidak',
    keperluan VARCHAR(100),
    catatan TEXT,
    status ENUM('pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
);

-- Tabel login_logs (log aktivitas login)
CREATE TABLE IF NOT EXISTS login_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(50),
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(50),
    user_agent TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabel articles (sudah ada, pastikan struktur)
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    tanggal DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel content_pages (untuk mengelola konten website)
CREATE TABLE IF NOT EXISTS content_pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) UNIQUE NOT NULL,
    page_title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT,
    FOREIGN KEY (updated_by) REFERENCES users(id)
);

-- Insert default content
INSERT INTO content_pages (page_key, page_title, content) VALUES
('home_welcome_title', 'Judul Sambutan Home', 'Selamat Datang di Nusantara Rent Car'),
('home_welcome_subtitle', 'Sub Judul Home', 'Partner Transportasi Terpercaya Sejak 2015'),
('home_welcome_desc', 'Deskripsi Home', 'Kami hadir untuk memberikan solusi transportasi yang aman, nyaman, dan terjangkau bagi masyarakat Indonesia. Baik untuk keperluan dinas kantor, wisata, pernikahan, maupun antar-jemput bandara, Nusantara Rent Car siap memberikan pelayanan prima.'),
('about_history', 'Sejarah Perusahaan', '<strong>Nusantara Rent Car</strong> didirikan pada tanggal 10 Januari 2015 di Jakarta. Bermula dari garasi kecil dengan hanya bermodalkan 2 unit Toyota Avanza, pendiri kami memiliki visi untuk menyediakan transportasi yang memanusiakan penumpangnya.\n\nBerkat kepercayaan pelanggan, kini kami telah berkembang pesat. Kami telah melayani ribuan perjalanan, mulai dari kunjungan kenegaraan, event internasional, hingga perjalanan mudik lebaran keluarga Indonesia.\n\nKami telah memiliki badan hukum resmi <strong>PT. Nusantara Transportasi Abadi</strong> sejak tahun 2018, sehingga legalitas dan keamanan transaksi Anda terjamin 100%.'),
('visi_text', 'Visi Perusahaan', 'Menjadi perusahaan penyedia jasa transportasi darat terdepan di Indonesia yang berbasis teknologi, mengutamakan keselamatan, dan memberikan pengalaman perjalanan tak terlupakan.'),
('misi_text', 'Misi Perusahaan', '1. Menyediakan armada kendaraan yang selalu dalam kondisi prima, bersih, dan wangi.|2. Meningkatkan kualitas sumber daya manusia (driver & staff) secara berkala melalui pelatihan hospitality.|3. Memberikan kemudahan pemesanan melalui integrasi sistem teknologi informasi.|4. Menawarkan harga yang kompetitif dan transparan tanpa biaya tersembunyi (hidden cost).|5. Membangun hubungan jangka panjang dengan mitra bisnis dan pelanggan perorangan.'),
('contact_office', 'Alamat Kantor', 'Gedung Menara Batavia Lt. 5\nJl. KH. Mas Mansyur Kav. 126\nJakarta Pusat, 10220'),
('contact_phone', 'Telepon Kantor', '(021) 5789-1234 (Hunting)'),
('contact_whatsapp', 'WhatsApp 24 Jam', '0812-3456-7890'),
('contact_email', 'Email', 'cs@nusantararent.com'),
('company_name', 'Nama Perusahaan', 'Nusantara Rent Car'),
('company_tagline', 'Tagline', 'Partner Perjalanan Aman, Nyaman, dan Terpercaya Sejak 2015');

-- Tabel gallery_images (untuk mengelola gambar gallery)
CREATE TABLE IF NOT EXISTS gallery_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default gallery
INSERT INTO gallery_images (title, image, description, urutan) VALUES
('Layanan Wedding Car Mewah', 'wedding_car_event.png', 'Layanan Wedding Car Mewah', 1),
('Wisata Gunung Bromo', 'tour_wisata_event.png', 'Wisata Gunung Bromo', 2),
('Pengawalan Tamu VVIP', 'tamu_vip_event.png', 'Pengawalan Tamu VVIP', 3),
('Family Gathering PT. Maju', 'family_gathering_event.png', 'Family Gathering PT. Maju', 4),
('Serah Terima Unit Lepas Kunci', 'serah_terima_event.png', 'Serah Terima Unit Lepas Kunci', 5),
('Toyota HiAce Commuter', 'hiAce_event.png', 'Toyota HiAce Commuter', 6);
