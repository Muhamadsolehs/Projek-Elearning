/**
 * SIM-PESANTREN TERINTEGRASI - ALPINE.JS APPLICATION ENGINE
 * Mengelola state interaktif, role switcher (11 roles), filter, pagination, scanner kamera, & QR generator.
 */

document.addEventListener('alpine:init', () => {
  const masterData = window.SIM_PESANTREN_DATA || {};

  Alpine.store('sim', {
    // Current Active Role & Session
    currentRole: 'super-admin',
    currentStudentSelected: null,
    academicYear: '2026/2027',
    semester: 'Ganjil',

    // Role Metadata
    roles: {
      'super-admin': {
        key: 'super-admin',
        title: 'Super Admin',
        name: 'Ust. H. Abdurrahman, M.Pd.I',
        badge: 'Akses Penuh',
        color: 'bg-red-100 text-red-800 border-red-200',
        avatar: '/assets/images/avatar/avatar-s-1.png',
        homeUrl: '/dashboard/super-admin'
      },
      'administrator': {
        key: 'administrator',
        title: 'Administrator Pesantren',
        name: 'Ust. H. Syarif Hidayatullah, S.T.',
        badge: 'Administrasi Umum',
        color: 'bg-blue-100 text-blue-800 border-blue-200',
        avatar: '/assets/images/avatar/avatar-s-2.png',
        homeUrl: '/dashboard/administrator'
      },
      'psb': {
        key: 'psb',
        title: 'Admin Penerimaan (PSB)',
        name: 'Ust. Zainal Abidin, Lc',
        badge: 'Panitia PSB',
        color: 'bg-emerald-100 text-emerald-800 border-emerald-200',
        avatar: '/assets/images/avatar/avatar-s-3.png',
        homeUrl: '/dashboard/psb'
      },
      'akademik': {
        key: 'akademik',
        title: 'Admin Akademik',
        name: 'Ust. Drs. H. Mulyadi',
        badge: 'Kurikulum & Jadwal',
        color: 'bg-indigo-100 text-indigo-800 border-indigo-200',
        avatar: '/assets/images/avatar/avatar-s-4.png',
        homeUrl: '/dashboard/akademik'
      },
      'guru': {
        key: 'guru',
        title: 'Guru / Ustadz',
        name: 'Ust. Ahmad Fauzi, S.Pd.I',
        badge: 'Pengampu Fiqih',
        color: 'bg-amber-100 text-amber-800 border-amber-200',
        avatar: '/assets/images/avatar/avatar-s-5.png',
        homeUrl: '/dashboard/guru'
      },
      'wali-kelas': {
        key: 'wali-kelas',
        title: 'Wali Kelas',
        name: 'Usth. Siti Maryam, S.Pd',
        badge: 'Wali Kelas VII-B',
        color: 'bg-purple-100 text-purple-800 border-purple-200',
        avatar: '/assets/images/avatar/avatar-s-6.png',
        homeUrl: '/dashboard/wali-kelas'
      },
      'keasramaan': {
        key: 'keasramaan',
        title: 'Admin Keasramaan / Pengasuh',
        name: 'Ust. Ridwan Hakim, M.Pd',
        badge: 'Kepala Asrama Putra',
        color: 'bg-teal-100 text-teal-800 border-teal-200',
        avatar: '/assets/images/avatar/avatar-s-7.png',
        homeUrl: '/dashboard/keasramaan'
      },
      'keuangan': {
        key: 'keuangan',
        title: 'Bendahara / Keuangan',
        name: 'Hj. Wahyuni Rahayu, S.E., M.Ak',
        badge: 'Kasir & Bendahara',
        color: 'bg-emerald-100 text-emerald-800 border-emerald-200',
        avatar: '/assets/images/avatar/avatar-s-8.png',
        homeUrl: '/dashboard/keuangan'
      },
      'perpustakaan': {
        key: 'perpustakaan',
        title: 'Petugas Perpustakaan',
        name: 'Usth. Fatimah Zahra, S.I.Pust',
        badge: 'Pustakawan Utama',
        color: 'bg-sky-100 text-sky-800 border-sky-200',
        avatar: '/assets/images/avatar/avatar-s-9.png',
        homeUrl: '/dashboard/perpustakaan'
      },
      'santri': {
        key: 'santri',
        title: 'Santri (Portal Santri)',
        name: 'Muhammad Pratama (NIS: 20240001)',
        badge: 'Santri Aktif VII-A',
        color: 'bg-blue-100 text-blue-800 border-blue-200',
        avatar: '/assets/images/avatar/avatar-s-10.png',
        homeUrl: '/dashboard/santri'
      },
      'wali-santri': {
        key: 'wali-santri',
        title: 'Wali Santri (Portal Wali)',
        name: 'H. Bambang Pratama, S.E.',
        badge: 'Wali dari 2 Santri',
        color: 'bg-amber-100 text-amber-800 border-amber-200',
        avatar: '/assets/images/avatar/avatar-s-11.png',
        homeUrl: '/dashboard/wali-santri'
      }
    },

    // Reactive Data Collections
    students: [...(masterData.students || [])],
    admissions: [...(masterData.admissions || [])],
    books: [...(masterData.books || [])],
    copies: [...(masterData.copies || [])],
    circulations: [...(masterData.circulations || [])],
    bills: [...(masterData.bills || [])],
    permissions: [...(masterData.permissions || [])],
    teachers: [...(masterData.teachers || [])],
    dorms: [...(masterData.dorms || [])],
    classes: [...(masterData.classes || [])],

    // Toasts Notification System
    toasts: [],
    addToast(title, message, type = 'success') {
      const id = Date.now();
      this.toasts.push({ id, title, message, type });
      setTimeout(() => {
        this.toasts = this.toasts.filter(t => t.id !== id);
      }, 4000);
    },

    // Role Switcher
    switchRole(newRoleKey) {
      if (!this.roles[newRoleKey]) return;
      this.currentRole = newRoleKey;
      localStorage.setItem('sim_active_role', newRoleKey);
      this.addToast('Peran Diperbarui', `Beralih ke tampilan: ${this.roles[newRoleKey].title}`, 'info');
      // Redirect to role dashboard if path is /dashboard or role home
      const currentPath = window.location.pathname;
      if (currentPath.includes('/dashboard')) {
        window.location.href = `/dashboard/${newRoleKey}`;
      }
    },

    // Sound Beep Effect for Scanner Feedback
    playBeep(success = true) {
      try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.type = success ? 'sine' : 'sawtooth';
        osc.frequency.setValueAtTime(success ? 880 : 320, ctx.currentTime);
        gain.gain.setValueAtTime(0.15, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.2);
        osc.start(ctx.currentTime);
        osc.stop(ctx.currentTime + 0.2);
      } catch (e) {
        // AudioContext not allowed or muted
      }
    },

    init() {
      const savedRole = localStorage.getItem('sim_active_role');
      if (savedRole && this.roles[savedRole]) {
        this.currentRole = savedRole;
      }
      
      // Auto detect current page role if in /dashboard/{role}
      const match = window.location.pathname.match(/\/dashboard\/([a-z\-]+)/);
      if (match && this.roles[match[1]]) {
        this.currentRole = match[1];
      }
    }
  });
});
