<?php

namespace Database\Seeders;

use App\Models\{Blok, Rumah, KartuKeluarga, AnggotaKeluarga, User, Keuangan, UnitDarurat, NomorDarurat, Kegiatan, Absensi};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'Admin RT 02',
            'email' => 'admin@rt02.test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Blok, Rumah, Kartu Keluarga, Anggota Keluarga
        $blok = Blok::create(['nama_blok' => 'F1']);
        $rumah = Rumah::create(['blok_id' => $blok->id, 'nomor_rumah' => 'F1-1']);
        $kk = KartuKeluarga::create(['rumah_id' => $rumah->id, 'nomor_kk' => '3271010101010001']);

        $userWarga = User::create([
            'name' => 'Budi Santoso',
            'email' => 'warga@rt02.test',
            'password' => bcrypt('password'),
            'role' => 'warga',
        ]);

        $anggota = AnggotaKeluarga::create([
            'kartu_keluarga_id' => $kk->id,
            'user_id' => $userWarga->id,
            'nama' => 'Budi Santoso',
            'nik' => '6471010101010001',
            'tempat_lahir' => 'Balikpapan',
            'tanggal_lahir' => '1990-05-10',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'Wiraswasta',
            'golongan_darah' => 'O',
            'status_perkawinan' => 'Kawin',
            'status_hubungan_keluarga' => 'Kepala Keluarga',
        ]);

        // Keuangan
        Keuangan::create([
            'tanggal' => now(),
            'jenis' => 'income',
            'kategori' => 'Iuran',
            'nama_barang' => 'Iuran Warga Bulan Ini',
            'jumlah' => 1,
            'harga_satuan' => 50000,
            'total' => 50000,
            'saldo' => 50000,
        ]);

        // Nomor Darurat
        $unit = UnitDarurat::create(['nama_unit' => 'Pemadam Kebakaran']);
        NomorDarurat::create([
            'unit_darurat_id' => $unit->id,
            'lokasi' => 'Balikpapan Timur',
            'nomor_telepon' => '0800000',
        ]);

        // Kegiatan + Absensi
        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => 'Kerja Bakti',
            'slug' => Str::slug('Kerja Bakti ' . now()->timestamp),
            'tanggal' => now(),
            'deskripsi' => 'Kerja bakti membersihkan lingkungan RT',
        ]);

        Absensi::create([
            'kegiatan_id' => $kegiatan->id,
            'anggota_keluarga_id' => $anggota->id,
            'status_hadir' => 'hadir',
        ]);
    }
}