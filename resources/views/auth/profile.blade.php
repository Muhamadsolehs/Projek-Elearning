@extends('layouts.app')

@section('title', 'Profil Pengguna & Keamanan')

@section('breadcrumb')
<nav class="flex text-xs text-slate-500 font-medium mb-1">
    <ol class="inline-flex items-center space-x-1">
        <li class="inline-flex items-center"><a href="/dashboard" class="text-primary-600 hover:underline">SIM-Pesantren</a></li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="inline-flex items-center text-slate-500">Akun</li>
        <li><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i></li>
        <li class="text-slate-800 font-bold">Profil Saya</li>
    </ol>
</nav>
@endsection

@section('page-title')
Pengaturan Profil & Keamanan Akun
@endsection

@section('page-subtitle')
Kelola informasi akun pengguna, foto profil avatar, dan ubah kata sandi sistem.
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6" x-data="{
    saveProfile() {
        $store.sim.addToast('Profil Disimpan', 'Informasi profil pengguna berhasil diperbarui.', 'success');
    },
    updatePassword() {
        $store.sim.addToast('Kata Sandi Diperbarui', 'Kata sandi akun Anda berhasil diubah dengan sukses.', 'success');
    }
}">

    <!-- INFO PROFIL CARD -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-2xs space-y-5">
        <div class="flex items-center gap-4 pb-4 border-b border-slate-100">
            <img :src="$store.sim.roles[$store.sim.currentRole]?.avatar" class="w-16 h-16 rounded-2xl border-2 border-primary-600 object-cover" alt="">
            <div>
                <h3 class="text-base font-extrabold text-slate-900" x-text="$store.sim.roles[$store.sim.currentRole]?.name"></h3>
                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-primary-50 text-primary-800 border border-primary-200" x-text="$store.sim.roles[$store.sim.currentRole]?.title"></span>
            </div>
        </div>

        <form @submit.prevent="saveProfile()" class="space-y-4 text-xs">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" :value="$store.sim.roles[$store.sim.currentRole]?.name" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-bold">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Email Resmi</label>
                    <input type="email" value="pengguna@pesantren.sch.id" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp</label>
                    <input type="text" value="081234567890" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Peran Pengguna (Role)</label>
                    <input type="text" :value="$store.sim.roles[$store.sim.currentRole]?.title" disabled class="w-full px-3 py-2 border border-slate-200 rounded-xl bg-slate-50 text-slate-500 font-bold">
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="px-5 py-2 bg-primary-800 hover:bg-primary-900 text-white font-bold text-xs rounded-xl shadow-xs">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

    <!-- UBAH PASSWORD CARD -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-2xs space-y-4">
        <h3 class="text-sm font-bold text-slate-900 pb-2 border-b border-slate-100 flex items-center gap-2">
            <i data-lucide="lock" class="w-4 h-4 text-primary-700"></i>
            <span>Ubah Kata Sandi (Password)</span>
        </h3>

        <form @submit.prevent="updatePassword()" class="space-y-4 text-xs">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Saat Ini</label>
                <input type="password" required placeholder="••••••••" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Baru</label>
                    <input type="password" required placeholder="Minimal 8 karakter" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Ulangi Kata Sandi Baru</label>
                    <input type="password" required placeholder="Ulangi sandi baru" class="w-full px-3 py-2 border border-slate-300 rounded-xl">
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-xs">
                    Perbarui Kata Sandi
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
