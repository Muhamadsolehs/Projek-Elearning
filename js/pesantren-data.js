/**
 * SIM-PESANTREN TERINTEGRASI - MASTER CLIENT-SIDE DATASET
 * Berisi 150 data santri, 20 pendaftar PSB, 250 judul buku, 500 eksemplar, transaksi sirkulasi, tagihan, dan perizinan.
 */

window.SIM_PESANTREN_DATA = (function() {
  const dorms = [
    { id: 'DRM-01', name: 'Gedung Al-Fatih (Putra)', gender: 'L', capacity: 60, occupied: 54, rooms_count: 6 },
    { id: 'DRM-02', name: 'Gedung Al-Faruq (Putra)', gender: 'L', capacity: 50, occupied: 45, rooms_count: 5 },
    { id: 'DRM-03', name: 'Gedung Ibnu Sina (Putra)', gender: 'L', capacity: 40, occupied: 38, rooms_count: 4 },
    { id: 'DRM-04', name: 'Gedung Khadijah (Putri)', gender: 'P', capacity: 70, occupied: 65, rooms_count: 7 },
    { id: 'DRM-05', name: 'Gedung Az-Zahra (Putri)', gender: 'P', capacity: 60, occupied: 52, rooms_count: 6 },
  ];

  const classes = [
    { id: 'CLS-7A', name: 'Kelas VII-A (Putra)', level: 'SMP', grade: 7, homeroom: 'Ustadz Ahmad Fauzi, S.Pd.I', students_count: 28 },
    { id: 'CLS-7B', name: 'Kelas VII-B (Putri)', level: 'SMP', grade: 7, homeroom: 'Ustadzah Siti Maryam, S.Pd', students_count: 26 },
    { id: 'CLS-8A', name: 'Kelas VIII-A (Putra)', level: 'SMP', grade: 8, homeroom: 'Ustadz Ridwan Hakim, M.Pd', students_count: 27 },
    { id: 'CLS-8B', name: 'Kelas VIII-B (Putri)', level: 'SMP', grade: 8, homeroom: 'Ustadzah Nurul Hidayah, S.Ag', students_count: 25 },
    { id: 'CLS-9A', name: 'Kelas IX-A (Putra)', level: 'SMP', grade: 9, homeroom: 'Ustadz Zainal Abidin, Lc', students_count: 24 },
    { id: 'CLS-9B', name: 'Kelas IX-B (Putri)', level: 'SMP', grade: 9, homeroom: 'Ustadzah Fatimah Zahra, M.Ag', students_count: 25 },
    { id: 'CLS-10A', name: 'Kelas X-MIPA (Putra)', level: 'SMA', grade: 10, homeroom: 'Ustadz Drs. H. Mulyadi', students_count: 25 },
    { id: 'CLS-11A', name: 'Kelas XI-MIPA (Putri)', level: 'SMA', grade: 11, homeroom: 'Ustadzah Aminah Salim, M.Pd', students_count: 24 },
  ];

  const teachers = [
    { id: 'TCH-001', nip: '198501102010011001', name: 'Ustadz Ahmad Fauzi, S.Pd.I', subject: 'Fiqih & Ushul Fiqih', phone: '081234567801', role: 'Wali Kelas VII-A', status: 'Aktif' },
    { id: 'TCH-002', nip: '198803152012022002', name: 'Ustadzah Siti Maryam, S.Pd', subject: 'Bahasa Arab & Nahwu', phone: '081234567802', role: 'Wali Kelas VII-B', status: 'Aktif' },
    { id: 'TCH-003', nip: '198205202008011003', name: 'Ustadz Ridwan Hakim, M.Pd', subject: 'Tahfidz Al-Quran', phone: '081234567803', role: 'Wali Kelas VIII-A', status: 'Aktif' },
    { id: 'TCH-004', nip: '199007252015022004', name: 'Ustadzah Nurul Hidayah, S.Ag', subject: 'Akidah Akhlak', phone: '081234567804', role: 'Wali Kelas VIII-B', status: 'Aktif' },
    { id: 'TCH-005', nip: '198011122005011005', name: 'Ustadz Zainal Abidin, Lc', subject: 'Hadits & Tarikh Islam', phone: '081234567805', role: 'Wali Kelas IX-A', status: 'Aktif' },
    { id: 'TCH-006', nip: '198609082011012006', name: 'Ustadzah Fatimah Zahra, M.Ag', subject: 'Tafsir Al-Quran', phone: '081234567806', role: 'Wali Kelas IX-B', status: 'Aktif' },
    { id: 'TCH-007', nip: '197504031999031007', name: 'Ustadz Drs. H. Mulyadi', subject: 'Matematika Umum', phone: '081234567807', role: 'Wali Kelas X-MIPA', status: 'Aktif' },
    { id: 'TCH-008', nip: '198902142014022008', name: 'Ustadzah Aminah Salim, M.Pd', subject: 'Bahasa Inggris', phone: '081234567808', role: 'Wali Kelas XI-MIPA', status: 'Aktif' },
    { id: 'TCH-009', nip: '199201012018011009', name: 'Ustadz Muhammad Ilham, S.Kom', subject: 'Teknologi Informasi & Komputer', phone: '081234567809', role: 'Guru Mapel', status: 'Aktif' },
    { id: 'TCH-010', nip: '198406182009011010', name: 'Ustadz Syamsul Hadi, S.Si', subject: 'Fisika & IPA Terpadu', phone: '081234567810', role: 'Guru Mapel', status: 'Aktif' },
  ];

  const firstNamesL = ['Muhammad', 'Ahmad', 'Fauzan', 'Rizky', 'Hafizh', 'Farhan', 'Wildan', 'Ibrahim', 'Zuhdi', 'Yusuf', 'Ali', 'Bilal', 'Habib', 'Hamzah', 'Rayhan', 'Dani', 'Fikri', 'Taufiq', 'Arif', 'Salman'];
  const firstNamesP = ['Aisyah', 'Fatimah', 'Khadijah', 'Zahra', 'Salma', 'Nabila', 'Hana', 'Yasmin', 'Maryam', 'Rania', 'Safira', 'Syifa', 'Zulfa', 'Lathifah', 'Nadhira', 'Anisa', 'Fariha', 'Mutia', 'Wardah', 'Alya'];
  const lastNames = ['Pratama', 'Hidayat', 'Saputra', 'Ramadhan', 'Kurniawan', 'Hakim', 'Al-Ghifari', 'Al-Fatih', 'Siregar', 'Nugroho', 'Wibowo', 'Santoso', 'Utomo', 'Firdaus', 'Kusuma', 'Mahendra', 'Zulkarnaen', 'Arifin'];
  const cities = ['Jakarta Selatan', 'Bandung', 'Surabaya', 'Semarang', 'Yogyakarta', 'Surakarta', 'Malang', 'Cirebon', 'Tasikmalaya', 'Bogor'];

  // 150 Data Santri
  const students = [];
  for (let i = 0; i < 150; i++) {
    const isMale = (i % 2 === 0);
    const gender = isMale ? 'L' : 'P';
    const fn = isMale ? firstNamesL[i % firstNamesL.length] : firstNamesP[i % firstNamesP.length];
    const ln = lastNames[(i * 3) % lastNames.length];
    const name = `${fn} ${ln}`;
    const nis = `2024${String(i + 1).padStart(4, '0')}`;
    const clsObj = classes[i % classes.length];
    const dormName = isMale 
      ? (i % 3 === 0 ? 'Gedung Al-Fatih / Kmr 101' : (i % 3 === 1 ? 'Gedung Al-Faruq / Kmr 202' : 'Gedung Ibnu Sina / Kmr 301'))
      : (i % 2 === 0 ? 'Gedung Khadijah / Kmr 102' : 'Gedung Az-Zahra / Kmr 203');
    
    students.push({
      id: `STU-${i + 1}`,
      nis: nis,
      nisn: `008${Math.floor(1000000 + (i * 59231) % 8999999)}`,
      name: name,
      gender: gender,
      level: clsObj.level,
      class: clsObj.name,
      dorm: dormName,
      parent_name: `H. ${ln}, S.E.`,
      parent_phone: `0812${String(34567000 + i).slice(-8)}`,
      parent_job: 'Wiraswasta / Pegawai Swasta',
      birth_place: cities[i % cities.length],
      birth_date: `${10 + (i % 18)} Mei ${2010 - Math.floor(i / 30)}`,
      join_year: '2024/2025',
      status: (i === 148) ? 'Alumni' : ((i === 149) ? 'Mutasi' : 'Aktif'),
      avatar: `/assets/images/avatar/avatar-s-${(i % 26) + 1}.png`,
      qr_token: `KTS-PESANTREN-${nis}`,
      attendance_summary: { hadir: 92 + (i % 7), izin: (i % 3), sakit: (i % 2), alfa: (i % 10 === 0 ? 1 : 0) },
      violations_count: (i % 15 === 0 ? 1 : 0),
      achievements_count: 1 + (i % 3),
    });
  }

  // 20 Pendaftar PSB (Pipeline)
  const admissionStatuses = [
    'Menunggu Verifikasi', 'Menunggu Verifikasi', 'Perlu Perbaikan Berkas',
    'Terverifikasi', 'Terverifikasi', 'Menunggu Tes', 'Sudah Mengikuti Tes',
    'Lulus', 'Lulus', 'Lulus', 'Diterima', 'Diterima', 'Tidak Lulus', 'Draft'
  ];
  const admissions = [];
  for (let k = 1; k <= 20; k++) {
    const isM = (k % 2 === 1);
    const fn = isM ? firstNamesL[(k * 2) % firstNamesL.length] : firstNamesP[(k * 2) % firstNamesP.length];
    const ln = lastNames[(k * 5) % lastNames.length];
    const status = admissionStatuses[(k - 1) % admissionStatuses.length];
    const regNo = `PSB-2026-${String(k).padStart(4, '0')}`;

    admissions.push({
      id: `ADM-${k}`,
      registration_number: regNo,
      name: `${fn} ${ln}`,
      gender: isM ? 'L' : 'P',
      level_target: (k % 3 === 0) ? 'SMA' : 'SMP',
      batch: 'Gelombang 1 (Reguler)',
      origin_school: (k % 3 === 0) ? 'MTs Negeri 1 Surabaya' : 'SDIT Nurul Fikri',
      parent_name: `Drs. ${ln}`,
      parent_phone: `0821${String(11223300 + k).slice(-8)}`,
      register_date: `${1 + (k % 25)} Oktober 2026`,
      status: status,
      test_score: ['Sudah Mengikuti Tes', 'Lulus', 'Diterima', 'Tidak Lulus'].includes(status) ? {
        quran: 75 + (k % 20),
        arabic: 70 + (k % 25),
        academic: 72 + (k % 22),
        interview: 80 + (k % 18),
        average: Math.round((297 + (k % 80)) / 4)
      } : null,
      documents: {
        kartu_keluarga: 'Terverifikasi',
        akta_kelahiran: 'Terverifikasi',
        rapor_terakhir: ['Draft', 'Perlu Perbaikan Berkas'].includes(status) ? 'Perlu Perbaikan' : 'Terverifikasi',
        surat_sehat: 'Terverifikasi'
      }
    });
  }

  // 250 Judul Buku & 500 Eksemplar
  const baseBookTemplates = [
    { title: 'Matan Taqrib (Ghayah wa Taqrib)', author: 'Al-Qadhi Abu Syuja', category: 'Fiqih & Ibadah', publisher: 'Darul Kutub Al-Ilmiyah', year: 2021, isbn: '978-979-24-1101-1' },
    { title: 'Fathul Qorib Al-Mujib', author: 'Ibnu Qasim Al-Ghazi', category: 'Fiqih & Ibadah', publisher: 'Darul Minhaj', year: 2020, isbn: '978-979-24-1102-8' },
    { title: 'Al-Jurumiyah fi Ilmi An-Nahwi', author: 'Ibnu Ajurrum Ash-Shanhaji', category: 'Bahasa Arab', publisher: 'Maktabah Al-Madani', year: 2019, isbn: '978-979-24-1103-5' },
    { title: 'Al-Imrithi: Nadzom Jurumiyah', author: 'Syaikh Syarafuddin Yahya Al-Imrithi', category: 'Bahasa Arab', publisher: 'Penerbit Harokah', year: 2022, isbn: '978-979-24-1104-2' },
    { title: 'Safinatun Najah fi Ushuliddin', author: 'Salim bin Sumair Al-Hadhrami', category: 'Fiqih & Ibadah', publisher: 'Pustaka Amani', year: 2020, isbn: '978-979-24-1105-9' },
    { title: 'Ta\'limul Muta\'allim Thariqat Ta\'allum', author: 'Al-Imam Az-Zarnuji', category: 'Akhlak & Tasawuf', publisher: 'Darul Fikr', year: 2018, isbn: '978-979-24-1106-6' },
    { title: 'Riyadhus Shalihin min Kalami Sayyidil Mursalin', author: 'Imam An-Nawawi', category: 'Hadits', publisher: 'Darussalam Riyadh', year: 2021, isbn: '978-979-24-1107-3' },
    { title: 'Al-Arba\'in An-Nawawiyyah', author: 'Imam An-Nawawi', category: 'Hadits', publisher: 'Pustaka Imam Syafii', year: 2022, isbn: '978-979-24-1108-0' },
    { title: 'Tafsir Jalalain (Juz 1 - Juz 30)', author: 'Jalaluddin Al-Mahalli & As-Suyuthi', category: 'Tafsir Al-Quran', publisher: 'Darul Ma\'rifah', year: 2023, isbn: '978-979-24-1109-7' },
    { title: 'Bidayatul Hidayah', author: 'Hujjatul Islam Imam Al-Ghazali', category: 'Akhlak & Tasawuf', publisher: 'Darul Minhaj', year: 2020, isbn: '978-979-24-1110-3' },
    { title: 'Matematika Terpadu untuk SMP Kelas VII', author: 'M. Cholik Adinawan', category: 'Sains & Matematika', publisher: 'Erlangga Edukasi', year: 2023, isbn: '978-602-298-501-2' },
    { title: 'IPA Terpadu: Biologi & Fisika Kelas VIII', author: 'Marthen Kanginan', category: 'Sains & Matematika', publisher: 'Yrama Widya', year: 2022, isbn: '978-602-298-502-9' },
    { title: 'Bahasa Inggris: English in Focus Grade IX', author: 'Artono Wardiman', category: 'Bahasa & Sastra', publisher: 'Pusat Perbukuan Kemdikbud', year: 2021, isbn: '978-602-298-503-6' },
    { title: 'Fisika Dasar untuk SMA/MA Kelas X', author: 'Prof. Peter Soedojo', category: 'Sains & Matematika', publisher: 'UGM Press', year: 2022, isbn: '978-602-298-504-3' },
    { title: 'Sejarah Kebudayaan Islam Nusantara', author: 'Dr. H. Agus Sunyoto', category: 'Sejarah & Tarikh', publisher: 'LKiS Yogyakarta', year: 2020, isbn: '978-602-298-505-0' },
  ];

  const books = [];
  const copies = [];
  let copyIdCounter = 1;

  for (let b = 1; b <= 250; b++) {
    const tmpl = baseBookTemplates[(b - 1) % baseBookTemplates.length];
    const jilid = b > baseBookTemplates.length ? ` (Jilid ${Math.floor(b / baseBookTemplates.length) + 1})` : '';
    const bookId = `BK-${String(b).padStart(4, '0')}`;
    const bookTitle = `${tmpl.title}${jilid}`;

    books.push({
      id: bookId,
      isbn: `${tmpl.isbn}-${b}`,
      title: bookTitle,
      author: tmpl.author,
      category: tmpl.category,
      publisher: tmpl.publisher,
      year: tmpl.year,
      total_copies: 2,
      available_copies: (b % 5 === 0) ? 1 : 2,
      synopsis: 'Buku pegangan wajib santri Pesantren Terpadu untuk pembelajaran diniyah dan kurikulum formal.',
      cover: '/assets/images/samples/modern-teaching-concept-P7BTJU7.jpg'
    });

    for (let c = 1; c <= 2; c++) {
      const invCode = `INV-BK-${String(b).padStart(4, '0')}-${String(c).padStart(2, '0')}`;
      const isBorrowed = (b % 5 === 0 && c === 1);
      const isDamaged = (b % 37 === 0);
      const status = isBorrowed ? 'Dipinjam' : (isDamaged ? 'Rusak' : 'Tersedia');
      const studentPeminjam = isBorrowed ? students[(b * 3) % students.length] : null;

      copies.push({
        id: `CPY-${copyIdCounter}`,
        inventory_code: invCode,
        book_id: bookId,
        book_title: bookTitle,
        category: tmpl.category,
        call_number: `297.${String((b % 90) + 10)} ${tmpl.author.slice(0, 3).toUpperCase()}`,
        status: status,
        condition: isDamaged ? 'Rusak Ringan' : 'Baik',
        procurement_date: '15 Juli 2024',
        qr_token: `CPY-QR-${invCode}`,
        borrower: isBorrowed ? {
          student_id: studentPeminjam.id,
          student_name: studentPeminjam.name,
          student_nis: studentPeminjam.nis,
          borrow_date: '28 Oktober 2026',
          due_date: '04 November 2026'
        } : null
      });
      copyIdCounter++;
    }
  }

  // 75 Transaksi Sirkulasi
  const circulations = [];
  for (let cr = 1; cr <= 75; cr++) {
    const st = students[(cr * 7) % students.length];
    const cp = copies[(cr * 5) % copies.length];
    const isReturned = (cr > 25);
    const isOverdue = (cr <= 25 && cr % 4 === 0);

    circulations.push({
      id: `TRX-CIRC-${String(cr).padStart(4, '0')}`,
      student_id: st.id,
      student_name: st.name,
      student_nis: st.nis,
      student_class: st.class,
      copy_code: cp.inventory_code,
      book_title: cp.book_title,
      borrow_date: `${1 + (cr % 20)} Oktober 2026`,
      due_date: `${8 + (cr % 20)} Oktober 2026`,
      return_date: isReturned ? `${7 + (cr % 20)} Oktober 2026` : null,
      status: isReturned ? 'Selesai Dikembalikan' : (isOverdue ? 'Terlambat' : 'Sedang Dipinjam'),
      condition: isReturned ? 'Baik' : '-',
      fine: isOverdue ? 4000 : 0
    });
  }

  // 40 Tagihan Keuangan
  const bills = [];
  for (let bl = 1; bl <= 40; bl++) {
    const st = students[(bl * 3) % students.length];
    const billType = (bl % 3 === 0) ? 'Uang Masuk & Pangkal' : ((bl % 3 === 1) ? 'SPP & Konsumsi (November 2026)' : 'Biaya Ujian & Ekstrakurikuler');
    const amount = (bl % 3 === 0) ? 4500000 : ((bl % 3 === 1) ? 1250000 : 350000);
    const statuses = ['Lunas', 'Lunas', 'Belum Dibayar', 'Menunggu Verifikasi', 'Terlambat'];
    const bStatus = statuses[bl % statuses.length];

    bills.push({
      id: `INV-2026-${String(bl).padStart(4, '0')}`,
      student_id: st.id,
      student_name: st.name,
      student_nis: st.nis,
      student_class: st.class,
      title: billType,
      amount: amount,
      formatted_amount: 'Rp ' + amount.toLocaleString('id-ID'),
      due_date: '10 November 2026',
      status: bStatus,
      paid_date: ['Lunas', 'Menunggu Verifikasi'].includes(bStatus) ? '02 November 2026' : null,
      payment_method: ['Lunas', 'Menunggu Verifikasi'].includes(bStatus) ? 'Transfer Bank Syariah Indonesia (BSI)' : null
    });
  }

  // 25 Perizinan Santri Keasramaan
  const permissions = [];
  const permTypes = ['Izin Pulang (Keluarga)', 'Izin Berobat ke RS', 'Izin Lomba / Ekstrakurikuler', 'Izin Belanja Perlengkapan Santri'];
  const permStatuses = ['Disetujui', 'Menunggu Persetujuan', 'Disetujui', 'Selesai Kembali', 'Ditolak'];
  for (let p = 1; p <= 25; p++) {
    const st = students[(p * 4) % students.length];
    const pStatus = permStatuses[p % permStatuses.length];

    permissions.push({
      id: `PRM-2026-${String(p).padStart(4, '0')}`,
      student_id: st.id,
      student_name: st.name,
      student_nis: st.nis,
      student_class: st.class,
      dorm: st.dorm,
      type: permTypes[p % permTypes.length],
      reason: 'Keperluan keluarga mendesak dan kontrol kesehatan berkala.',
      departure_date: `${28 + (p % 3)} Oktober 2026`,
      return_plan: `${2 + (p % 4)} November 2026`,
      status: pStatus,
      approver: (pStatus !== 'Menunggu Persetujuan') ? 'Ustadz Ridwan Hakim, M.Pd (Pengasuh)' : '-',
      gate_checked_out: ['Disetujui', 'Selesai Kembali'].includes(pStatus),
      gate_checked_in: (pStatus === 'Selesai Kembali')
    });
  }

  return {
    dorms,
    classes,
    teachers,
    students,
    admissions,
    books,
    copies,
    circulations,
    bills,
    permissions,
  };
})();
