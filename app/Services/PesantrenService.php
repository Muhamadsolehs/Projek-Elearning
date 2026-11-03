<?php

namespace App\Services;

class PesantrenService
{
    private static ?array $data = null;

    public static function getData(): array
    {
        if (self::$data !== null) {
            return self::$data;
        }

        self::$data = self::generateComprehensiveData();
        return self::$data;
    }

    public static function getStudents(array $filters = []): array
    {
        $students = self::getData()['students'];

        if (!empty($filters['search'])) {
            $s = strtolower($filters['search']);
            $students = array_filter($students, function ($item) use ($s) {
                return str_contains(strtolower($item['nis']), $s) ||
                       str_contains(strtolower($item['name']), $s) ||
                       str_contains(strtolower($item['class']), $s) ||
                       str_contains(strtolower($item['dorm']), $s);
            });
        }

        if (!empty($filters['level'])) {
            $students = array_filter($students, fn($item) => $item['level'] === $filters['level']);
        }

        if (!empty($filters['class'])) {
            $students = array_filter($students, fn($item) => $item['class'] === $filters['class']);
        }

        if (!empty($filters['status'])) {
            $students = array_filter($students, fn($item) => $item['status'] === $filters['status']);
        }

        return array_values($students);
    }

    public static function findStudent(string $idOrNis): ?array
    {
        $students = self::getData()['students'];
        foreach ($students as $student) {
            if ($student['id'] === $idOrNis || $student['nis'] === $idOrNis) {
                return $student;
            }
        }
        return null;
    }

    public static function getAdmissions(string $status = ''): array
    {
        $admissions = self::getData()['admissions'];
        if ($status) {
            return array_values(array_filter($admissions, fn($a) => $a['status'] === $status));
        }
        return $admissions;
    }

    public static function getBooks(): array
    {
        return self::getData()['books'];
    }

    public static function getBookCopies(): array
    {
        return self::getData()['copies'];
    }

    public static function getCirculations(): array
    {
        return self::getData()['circulations'];
    }

    public static function getBills(): array
    {
        return self::getData()['bills'];
    }

    public static function getPermissions(): array
    {
        return self::getData()['permissions'];
    }

    public static function getTeachers(): array
    {
        return self::getData()['teachers'];
    }

    public static function getAuditLogs(): array
    {
        return self::getData()['audit_logs'];
    }

    private static function generateComprehensiveData(): array
    {
        // 1. Data Asrama
        $dorms = [
            ['id' => 'DRM-01', 'name' => 'Gedung Al-Fatih (Putra)', 'gender' => 'L', 'capacity' => 60, 'occupied' => 54, 'rooms_count' => 6],
            ['id' => 'DRM-02', 'name' => 'Gedung Al-Faruq (Putra)', 'gender' => 'L', 'capacity' => 50, 'occupied' => 45, 'rooms_count' => 5],
            ['id' => 'DRM-03', 'name' => 'Gedung Ibnu Sina (Putra)', 'gender' => 'L', 'capacity' => 40, 'occupied' => 38, 'rooms_count' => 4],
            ['id' => 'DRM-04', 'name' => 'Gedung Khadijah (Putri)', 'gender' => 'P', 'capacity' => 70, 'occupied' => 65, 'rooms_count' => 7],
            ['id' => 'DRM-05', 'name' => 'Gedung Az-Zahra (Putri)', 'gender' => 'P', 'capacity' => 60, 'occupied' => 52, 'rooms_count' => 6],
        ];

        // 2. Data Kelas
        $classes = [
            ['id' => 'CLS-7A', 'name' => 'Kelas VII-A (Putra)', 'level' => 'SMP', 'grade' => 7, 'homeroom' => 'Ustadz Ahmad Fauzi, S.Pd.I', 'students_count' => 28],
            ['id' => 'CLS-7B', 'name' => 'Kelas VII-B (Putri)', 'level' => 'SMP', 'grade' => 7, 'homeroom' => 'Ustadzah Siti Maryam, S.Pd', 'students_count' => 26],
            ['id' => 'CLS-8A', 'name' => 'Kelas VIII-A (Putra)', 'level' => 'SMP', 'grade' => 8, 'homeroom' => 'Ustadz Ridwan Hakim, M.Pd', 'students_count' => 27],
            ['id' => 'CLS-8B', 'name' => 'Kelas VIII-B (Putri)', 'level' => 'SMP', 'grade' => 8, 'homeroom' => 'Ustadzah Nurul Hidayah, S.Ag', 'students_count' => 25],
            ['id' => 'CLS-9A', 'name' => 'Kelas IX-A (Putra)', 'level' => 'SMP', 'grade' => 9, 'homeroom' => 'Ustadz Zainal Abidin, Lc', 'students_count' => 24],
            ['id' => 'CLS-9B', 'name' => 'Kelas IX-B (Putri)', 'level' => 'SMP', 'grade' => 9, 'homeroom' => 'Ustadzah Fatimah Zahra, M.Ag', 'students_count' => 25],
            ['id' => 'CLS-10A', 'name' => 'Kelas X-MIPA (Putra)', 'level' => 'SMA', 'grade' => 10, 'homeroom' => 'Ustadz Drs. H. Mulyadi', 'students_count' => 25],
            ['id' => 'CLS-11A', 'name' => 'Kelas XI-MIPA (Putri)', 'level' => 'SMA', 'grade' => 11, 'homeroom' => 'Ustadzah Aminah Salim, M.Pd', 'students_count' => 24],
        ];

        // 3. Guru & Ustadz
        $teachers = [
            ['id' => 'TCH-001', 'nip' => '198501102010011001', 'name' => 'Ustadz Ahmad Fauzi, S.Pd.I', 'subject' => 'Fiqih & Ushul Fiqih', 'phone' => '081234567801', 'role' => 'Wali Kelas VII-A', 'status' => 'Aktif'],
            ['id' => 'TCH-002', 'nip' => '198803152012022002', 'name' => 'Ustadzah Siti Maryam, S.Pd', 'subject' => 'Bahasa Arab & Nahwu', 'phone' => '081234567802', 'role' => 'Wali Kelas VII-B', 'status' => 'Aktif'],
            ['id' => 'TCH-003', 'nip' => '198205202008011003', 'name' => 'Ustadz Ridwan Hakim, M.Pd', 'subject' => 'Tahfidz Al-Quran', 'phone' => '081234567803', 'role' => 'Wali Kelas VIII-A', 'status' => 'Aktif'],
            ['id' => 'TCH-004', 'nip' => '199007252015022004', 'name' => 'Ustadzah Nurul Hidayah, S.Ag', 'subject' => 'Akidah Akhlak', 'phone' => '081234567804', 'role' => 'Wali Kelas VIII-B', 'status' => 'Aktif'],
            ['id' => 'TCH-005', 'nip' => '198011122005011005', 'name' => 'Ustadz Zainal Abidin, Lc', 'subject' => 'Hadits & Tarikh Islam', 'phone' => '081234567805', 'role' => 'Wali Kelas IX-A', 'status' => 'Aktif'],
            ['id' => 'TCH-006', 'nip' => '198609082011012006', 'name' => 'Ustadzah Fatimah Zahra, M.Ag', 'subject' => 'Tafsir Al-Quran', 'phone' => '081234567806', 'role' => 'Wali Kelas IX-B', 'status' => 'Aktif'],
            ['id' => 'TCH-007', 'nip' => '197504031999031007', 'name' => 'Ustadz Drs. H. Mulyadi', 'subject' => 'Matematika Umum', 'phone' => '081234567807', 'role' => 'Wali Kelas X-MIPA', 'status' => 'Aktif'],
            ['id' => 'TCH-008', 'nip' => '198902142014022008', 'name' => 'Ustadzah Aminah Salim, M.Pd', 'subject' => 'Bahasa Inggris', 'phone' => '081234567808', 'role' => 'Wali Kelas XI-MIPA', 'status' => 'Aktif'],
            ['id' => 'TCH-009', 'nip' => '199201012018011009', 'name' => 'Ustadz Muhammad Ilham, S.Kom', 'subject' => 'Teknologi Informasi & Komputer', 'phone' => '081234567809', 'role' => 'Guru Mapel', 'status' => 'Aktif'],
            ['id' => 'TCH-010', 'nip' => '198406182009011010', 'name' => 'Ustadz Syamsul Hadi, S.Si', 'subject' => 'Fisika & IPA Terpadu', 'phone' => '081234567810', 'role' => 'Guru Mapel', 'status' => 'Aktif'],
        ];

        // 4. Data 150 Santri Realistis
        $firstNamesL = ['Muhammad', 'Ahmad', 'Fauzan', 'Rizky', 'Hafizh', 'Farhan', 'Wildan', 'Ibrahim', 'Zuhdi', 'Yusuf', 'Ali', 'Bilal', 'Habib', 'Hamzah', 'Rayhan', 'Dani', 'Fikri', 'Taufiq', 'Arif', 'Salman'];
        $firstNamesP = ['Aisyah', 'Fatimah', 'Khadijah', 'Zahra', 'Salma', 'Nabila', 'Hana', 'Yasmin', 'Maryam', 'Rania', 'Safira', 'Syifa', 'Zulfa', 'Lathifah', 'Nadhira', 'Anisa', 'Fariha', 'Mutia', 'Wardah', 'Alya'];
        $lastNames = ['Pratama', 'Hidayat', 'Saputra', 'Ramadhan', 'Kurniawan', 'Hakim', 'Al-Ghifari', 'Al-Fatih', 'Siregar', 'Nugroho', 'Wibowo', 'Santoso', 'Utomo', 'Firdaus', 'Kusuma', 'Mahendra', 'Zulkarnaen', 'Arifin'];
        $cities = ['Jakarta Selatan', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Surakarta', 'Malang', 'Cirebon', 'Tasikmalaya', 'Bogor', 'Bekasi', 'Medan', 'Palembang', 'Padang'];

        $students = [];
        $studentIndex = 1;

        // Generate 150 santri terstruktur
        for ($i = 0; $i < 150; $i++) {
            $isMale = ($i % 2 === 0);
            $gender = $isMale ? 'L' : 'P';
            $fn = $isMale ? $firstNamesL[array_rand($firstNamesL)] : $firstNamesP[array_rand($firstNamesP)];
            $ln = $lastNames[array_rand($lastNames)];
            $name = "$fn $ln";
            $nis = sprintf("2024%04d", $studentIndex);
            
            // Assign class & level
            $clsIdx = $i % count($classes);
            $classObj = $classes[$clsIdx];
            $level = $classObj['level'];
            $className = $classObj['name'];
            
            // Assign dorm
            $dormName = $isMale ? ($i % 3 === 0 ? 'Gedung Al-Fatih / Kmr 101' : ($i % 3 === 1 ? 'Gedung Al-Faruq / Kmr 202' : 'Gedung Ibnu Sina / Kmr 301'))
                                : ($i % 2 === 0 ? 'Gedung Khadijah / Kmr 102' : 'Gedung Az-Zahra / Kmr 203');

            $parentName = 'H. ' . $lastNames[array_rand($lastNames)] . ', S.E.';
            $parentPhone = '081' . rand(11111111, 99999999);
            $city = $cities[array_rand($cities)];
            
            // Status distribution: mostly active
            $status = ($i === 148) ? 'Alumni' : (($i === 149) ? 'Mutasi' : 'Aktif');

            $students[] = [
                'id' => "STU-$studentIndex",
                'nis' => $nis,
                'nisn' => '008' . rand(1000000, 9999999),
                'name' => $name,
                'gender' => $gender,
                'level' => $level,
                'class' => $className,
                'dorm' => $dormName,
                'parent_name' => $parentName,
                'parent_phone' => $parentPhone,
                'parent_job' => 'Wiraswasta / Pegawai Swasta',
                'birth_place' => $city,
                'birth_date' => date('d F Y', strtotime('-' . (12 + ($classObj['grade'] - 7)) . ' years -' . rand(10, 300) . ' days')),
                'join_year' => '2024/2025',
                'status' => $status,
                'avatar' => '/assets/images/avatar/avatar-s-' . (($i % 26) + 1) . '.png',
                'qr_token' => 'KTS-' . md5($nis . 'pesantren_salt_2026'),
                'attendance_summary' => [
                    'hadir' => rand(85, 98),
                    'izin' => rand(1, 4),
                    'sakit' => rand(1, 3),
                    'alfa' => rand(0, 1),
                ],
                'violations_count' => rand(0, 2),
                'achievements_count' => rand(1, 4),
            ];
            $studentIndex++;
        }

        // 5. Data Calon Santri (PSB) - 20 Calon Santri dengan Pipeline
        $admissionStatuses = [
            'Menunggu Verifikasi', 'Menunggu Verifikasi', 'Perlu Perbaikan Berkas',
            'Terverifikasi', 'Terverifikasi', 'Menunggu Tes', 'Sudah Mengikuti Tes',
            'Lulus', 'Lulus', 'Lulus', 'Diterima', 'Diterima', 'Tidak Lulus', 'Draft'
        ];
        $admissions = [];
        for ($k = 1; $k <= 20; $k++) {
            $isM = ($k % 2 === 1);
            $fn = $isM ? $firstNamesL[array_rand($firstNamesL)] : $firstNamesP[array_rand($firstNamesP)];
            $ln = $lastNames[array_rand($lastNames)];
            $status = $admissionStatuses[($k - 1) % count($admissionStatuses)];
            $regNo = sprintf("PSB-2026-%04d", $k);

            $admissions[] = [
                'id' => "ADM-$k",
                'registration_number' => $regNo,
                'name' => "$fn $ln",
                'gender' => $isM ? 'L' : 'P',
                'level_target' => ($k % 3 === 0) ? 'SMA' : 'SMP',
                'batch' => 'Gelombang 1 (Reguler)',
                'origin_school' => ($k % 3 === 0) ? 'MTs Negeri 1 Surabaya' : 'SD Islam Terpadu Nurul Fikri',
                'parent_name' => 'Drs. ' . $ln,
                'parent_phone' => '082' . rand(11111111, 99999999),
                'register_date' => date('d F Y', strtotime('-' . rand(2, 45) . ' days')),
                'status' => $status,
                'test_score' => in_array($status, ['Sudah Mengikuti Tes', 'Lulus', 'Diterima', 'Tidak Lulus']) ? [
                    'quran' => rand(70, 95),
                    'arabic' => rand(65, 92),
                    'academic' => rand(72, 90),
                    'interview' => rand(75, 95),
                    'average' => rand(73, 93),
                ] : null,
                'documents' => [
                    'kartu_keluarga' => 'Terverifikasi',
                    'akta_kelahiran' => 'Terverifikasi',
                    'rapor_terakhir' => in_array($status, ['Draft', 'Perlu Perbaikan Berkas']) ? 'Perlu Perbaikan' : 'Terverifikasi',
                    'surat_sehat' => 'Terverifikasi',
                ],
            ];
        }

        // 6. Data Katalog Buku (250 Judul & 500 Eksemplar)
        $bookTitles = [
            // Kitab & Keislaman
            ['title' => 'Matan Taqrib (Ghayah wa Taqrib)', 'author' => 'Al-Qadhi Abu Syuja', 'category' => 'Fiqih & Ibadah', 'publisher' => 'Darul Kutub Al-Ilmiyah', 'year' => 2021, 'isbn' => '978-979-24-1101-1'],
            ['title' => 'Fathul Qorib Al-Mujib', 'author' => 'Ibnu Qasim Al-Ghazi', 'category' => 'Fiqih & Ibadah', 'publisher' => 'Darul Minhaj', 'year' => 2020, 'isbn' => '978-979-24-1102-8'],
            ['title' => 'Al-Jurumiyah fi Ilmi An-Nahwi', 'author' => 'Ibnu Ajurrum Ash-Shanhaji', 'category' => 'Bahasa Arab', 'publisher' => 'Maktabah Al-Madani', 'year' => 2019, 'isbn' => '978-979-24-1103-5'],
            ['title' => 'Al-Imrithi: Nadzom Jurumiyah', 'author' => 'Syaikh Syarafuddin Yahya Al-Imrithi', 'category' => 'Bahasa Arab', 'publisher' => 'Penerbit Harokah', 'year' => 2022, 'isbn' => '978-979-24-1104-2'],
            ['title' => 'Safinatun Najah fi Ushuliddin', 'author' => 'Salim bin Sumair Al-Hadhrami', 'category' => 'Fiqih & Ibadah', 'publisher' => 'Pustaka Amani', 'year' => 2020, 'isbn' => '978-979-24-1105-9'],
            ['title' => 'Ta\'limul Muta\'allim Thariqat Ta\'allum', 'author' => 'Al-Imam Az-Zarnuji', 'category' => 'Akhlak & Tasawuf', 'publisher' => 'Darul Fikr', 'year' => 2018, 'isbn' => '978-979-24-1106-6'],
            ['title' => 'Riyadhus Shalihin min Kalami Sayyidil Mursalin', 'author' => 'Imam An-Nawawi', 'category' => 'Hadits', 'publisher' => 'Darussalam Riyadh', 'year' => 2021, 'isbn' => '978-979-24-1107-3'],
            ['title' => 'Al-Arba\'in An-Nawawiyyah', 'author' => 'Imam An-Nawawi', 'category' => 'Hadits', 'publisher' => 'Pustaka Imam Syafii', 'year' => 2022, 'isbn' => '978-979-24-1108-0'],
            ['title' => 'Tafsir Jalalain (Juz 1 - Juz 30)', 'author' => 'Jalaluddin Al-Mahalli & Jalaluddin As-Suyuthi', 'category' => 'Tafsir Al-Quran', 'publisher' => 'Darul Ma\'rifah', 'year' => 2023, 'isbn' => '978-979-24-1109-7'],
            ['title' => 'Bidayatul Hidayah', 'author' => 'Hujjatul Islam Imam Al-Ghazali', 'category' => 'Akhlak & Tasawuf', 'publisher' => 'Darul Minhaj', 'year' => 2020, 'isbn' => '978-979-24-1110-3'],
            // Buku Pendidikan Formal
            ['title' => 'Matematika Terpadu untuk SMP/MTs Kelas VII', 'author' => 'M. Cholik Adinawan', 'category' => 'Sains & Matematika', 'publisher' => 'Erlangga Edukasi', 'year' => 2023, 'isbn' => '978-602-298-501-2'],
            ['title' => 'IPA Terpadu: Biologi & Fisika untuk Kelas VIII', 'author' => 'Marthen Kanginan', 'category' => 'Sains & Matematika', 'publisher' => 'Yrama Widya', 'year' => 2022, 'isbn' => '978-602-298-502-9'],
            ['title' => 'Bahasa Inggris: English in Focus for Grade IX', 'author' => 'Artono Wardiman', 'category' => 'Bahasa & Sastra', 'publisher' => 'Pusat Perbukuan Kemdikbud', 'year' => 2021, 'isbn' => '978-602-298-503-6'],
            ['title' => 'Fisika Dasar untuk SMA/MA Kelas X', 'author' => 'Prof. Peter Soedojo', 'category' => 'Sains & Matematika', 'publisher' => 'Gadjah Mada University Press', 'year' => 2022, 'isbn' => '978-602-298-504-3'],
            ['title' => 'Sejarah Kebudayaan Islam Nusantara', 'author' => 'Dr. H. Agus Sunyoto', 'category' => 'Sejarah & Tarikh', 'publisher' => 'LKiS Yogyakarta', 'year' => 2020, 'isbn' => '978-602-298-505-0'],
        ];

        // Buat daftar lengkap 250 buku dengan variasi judul
        $categoriesList = ['Fiqih & Ibadah', 'Bahasa Arab', 'Akhlak & Tasawuf', 'Hadits', 'Tafsir Al-Quran', 'Sains & Matematika', 'Bahasa & Sastra', 'Sejarah & Tarikh', 'Teknologi & Informasi'];
        $books = [];
        $copies = [];
        $copyGlobalId = 1;

        for ($b = 1; $b <= 250; $b++) {
            $baseBook = $bookTitles[($b - 1) % count($bookTitles)];
            $edition = ($b > count($bookTitles)) ? " (Jilid " . (intval($b / count($bookTitles)) + 1) . ")" : "";
            $bookId = "BK-" . sprintf("%04d", $b);

            $books[] = [
                'id' => $bookId,
                'isbn' => $baseBook['isbn'] . "-$b",
                'title' => $baseBook['title'] . $edition,
                'author' => $baseBook['author'],
                'category' => $baseBook['category'],
                'publisher' => $baseBook['publisher'],
                'year' => $baseBook['year'],
                'total_copies' => 2,
                'available_copies' => ($b % 5 === 0) ? 1 : 2,
                'cover' => '/assets/images/samples/modern-teaching-concept-P7BTJU7.jpg',
                'synopsis' => 'Buku referensi kajian santri di Pondok Pesantren Terpadu, wajib bagi santri tingkat tsanawiyah dan aliyah.',
            ];

            // Setiap buku memiliki 2 eksemplar fisik unik (total 500 eksemplar)
            for ($c = 1; $c <= 2; $c++) {
                $barcode = sprintf("INV-BK-%04d-%02d", $b, $c);
                $isBorrowed = ($b % 5 === 0 && $c === 1);
                $isDamaged = ($b % 37 === 0);
                
                $status = $isBorrowed ? 'Dipinjam' : ($isDamaged ? 'Rusak' : 'Tersedia');
                $condition = $isDamaged ? 'Rusak Ringan' : 'Baik';

                $copies[] = [
                    'id' => "CPY-$copyGlobalId",
                    'inventory_code' => $barcode,
                    'book_id' => $bookId,
                    'book_title' => $baseBook['title'] . $edition,
                    'category' => $baseBook['category'],
                    'call_number' => sprintf("297.%02d %s", ($b % 90) + 10, substr($baseBook['author'], 0, 3)),
                    'status' => $status,
                    'condition' => $condition,
                    'procurement_date' => '15 Juli 2024',
                    'qr_token' => 'CPY_TOKEN_' . sha1($barcode . 'salt_pesantren_secure_2026'),
                    'borrower' => $isBorrowed ? [
                        'student_id' => 'STU-' . (($b % 50) + 1),
                        'student_name' => $students[($b % 50)]['name'],
                        'student_nis' => $students[($b % 50)]['nis'],
                        'borrow_date' => date('d F Y', strtotime('-' . rand(2, 10) . ' days')),
                        'due_date' => date('d F Y', strtotime('+' . rand(1, 4) . ' days')),
                    ] : null,
                ];
                $copyGlobalId++;
            }
        }

        // 7. Transaksi Peminjaman Perpustakaan (Circulations)
        $circulations = [];
        for ($cr = 1; $cr <= 75; $cr++) {
            $st = $students[$cr % count($students)];
            $cp = $copies[$cr * 3 % count($copies)];
            $isOverdue = ($cr % 4 === 0);
            $isReturned = ($cr > 25);

            $borrowDate = date('d F Y', strtotime('-' . ($isReturned ? rand(15, 60) : rand(1, 12)) . ' days'));
            $dueDate = date('d F Y', strtotime('-' . ($isOverdue ? rand(1, 5) : 0) . ' days +' . rand(1, 7) . ' days'));
            $returnDate = $isReturned ? date('d F Y', strtotime('-' . rand(1, 14) . ' days')) : null;

            $circulations[] = [
                'id' => "TRX-CIRC-" . sprintf("%04d", $cr),
                'student_id' => $st['id'],
                'student_name' => $st['name'],
                'student_nis' => $st['nis'],
                'student_class' => $st['class'],
                'copy_code' => $cp['inventory_code'],
                'book_title' => $cp['book_title'],
                'borrow_date' => $borrowDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'status' => $isReturned ? 'Selesai Dikembalikan' : ($isOverdue ? 'Terlambat' : 'Sedang Dipinjam'),
                'condition' => $isReturned ? 'Baik' : '-',
                'fine' => $isOverdue ? (rand(1, 4) * 2000) : 0,
            ];
        }

        // 8. Tagihan Keuangan (Bills)
        $bills = [];
        for ($bl = 1; $bl <= 40; $bl++) {
            $st = $students[$bl % count($students)];
            $billType = ($bl % 3 === 0) ? 'Uang Masuk & Pangkal' : (($bl % 3 === 1) ? 'SPP & Uang Makan (November 2026)' : 'Biaya Ujian & Kegiatan Santri');
            $amount = ($bl % 3 === 0) ? 4500000 : (($bl % 3 === 1) ? 1250000 : 350000);
            $statuses = ['Lunas', 'Lunas', 'Belum Dibayar', 'Menunggu Verifikasi', 'Terlambat'];
            $billStatus = $statuses[$bl % count($statuses)];

            $bills[] = [
                'id' => "INV-2026-" . sprintf("%04d", $bl),
                'student_id' => $st['id'],
                'student_name' => $st['name'],
                'student_nis' => $st['nis'],
                'student_class' => $st['class'],
                'title' => $billType,
                'amount' => $amount,
                'formatted_amount' => 'Rp ' . number_format($amount, 0, ',', '.'),
                'due_date' => '10 November 2026',
                'status' => $billStatus,
                'paid_date' => in_array($billStatus, ['Lunas', 'Menunggu Verifikasi']) ? '02 November 2026' : null,
                'payment_method' => in_array($billStatus, ['Lunas', 'Menunggu Verifikasi']) ? 'Transfer Bank Syariah Indonesia (BSI)' : null,
            ];
        }

        // 9. Perizinan Santri Keasramaan
        $permissions = [];
        $permTypes = ['Izin Pulang (Keluarga)', 'Izin Berobat ke RS', 'Izin Lomba / Ekstrakurikuler', 'Izin Belanja Perlengkapan Santri'];
        for ($p = 1; $p <= 25; $p++) {
            $st = $students[$p % count($students)];
            $pStatuses = ['Disetujui', 'Menunggu Persetujuan', 'Disetujui', 'Selesai Kembali', 'Ditolak'];
            $permStatus = $pStatuses[$p % count($pStatuses)];

            $permissions[] = [
                'id' => "PRM-2026-" . sprintf("%04d", $p),
                'student_id' => $st['id'],
                'student_name' => $st['name'],
                'student_nis' => $st['nis'],
                'student_class' => $st['class'],
                'dorm' => $st['dorm'],
                'type' => $permTypes[$p % count($permTypes)],
                'reason' => 'Keperluan keluarga mendesak dan kontrol kesehatan berkala.',
                'departure_date' => date('d F Y', strtotime('-' . rand(0, 3) . ' days')),
                'return_plan' => date('d F Y', strtotime('+' . rand(1, 4) . ' days')),
                'status' => $permStatus,
                'approver' => ($permStatus !== 'Menunggu Persetujuan') ? 'Ustadz Ridwan Hakim, M.Pd (Pengasuh)' : '-',
                'gate_checked_out' => in_array($permStatus, ['Disetujui', 'Selesai Kembali']),
                'gate_checked_in' => ($permStatus === 'Selesai Kembali'),
            ];
        }

        // 10. Audit Log Aktivitas
        $auditLogs = [
            ['user' => 'Ustadz Ahmad Fauzi (Guru)', 'role' => 'Guru / Ustadz', 'action' => 'Input Presensi Kelas VII-A', 'module' => 'Akademik', 'time' => '10 menit yang lalu', 'ip' => '192.168.1.45'],
            ['user' => 'Ustadzah Siti Maryam (Perpus)', 'role' => 'Petugas Perpustakaan', 'action' => 'Sirkulasi Peminjaman: INV-BK-0012-01 ke Muhammad Pratama', 'module' => 'Perpustakaan', 'time' => '25 menit yang lalu', 'ip' => '192.168.1.12'],
            ['user' => 'H. Suherman, S.E. (Bendahara)', 'role' => 'Bendahara / Keuangan', 'action' => 'Verifikasi Pembayaran SPP INV-2026-0004 (BSI)', 'module' => 'Keuangan', 'time' => '42 menit yang lalu', 'ip' => '192.168.1.8'],
            ['user' => 'Ustadz Ridwan Hakim (Pengasuh)', 'role' => 'Admin Keasramaan', 'action' => 'Approval Izin Pulang PRM-2026-0002', 'module' => 'Keasramaan', 'time' => '1 jam yang lalu', 'ip' => '192.168.1.19'],
            ['user' => 'Ustadz Zainal Abidin (PSB)', 'role' => 'Admin PSB', 'action' => 'Verifikasi Berkas Calon Santri PSB-2026-0003', 'module' => 'PSB', 'time' => '2 jam yang lalu', 'ip' => '192.168.1.15'],
            ['user' => 'Super Administrator', 'role' => 'Super Admin', 'action' => 'Backup Database & Sinkronisasi Sistem', 'module' => 'Sistem', 'time' => '3 jam yang lalu', 'ip' => '127.0.0.1'],
        ];

        return [
            'dorms' => $dorms,
            'classes' => $classes,
            'teachers' => $teachers,
            'students' => $students,
            'admissions' => $admissions,
            'books' => $books,
            'copies' => $copies,
            'circulations' => $circulations,
            'bills' => $bills,
            'permissions' => $permissions,
            'audit_logs' => $auditLogs,
        ];
    }
}
