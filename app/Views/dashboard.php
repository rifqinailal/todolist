<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="m-3">
    <div class="mx-6">
        <h1 class="text-2xl sm:text-[30px] font-semibold">Dashboard</h1>
        <h1 class="text-sm sm:text-base font-semibold text-[#7f7f7f]">Lihat jumlah tugas yang masih menunggu penyelesaian dan yang sudah berhasil kamu selesaikan.</h1>
    </div>
    <div class="flex gap-4 justify-between mx-5 text-7xl mt-3">
        <div class="bg-primary w-full h-32 flex flex-col items-center justify-center rounded-xl text-white">
            <h1><?= $pendingTasks ?></h1>
            <p class="text-lg">Belum Selesai</p>
        </div>
        <div class="bg-primary w-full h-32 flex flex-col justify-center items-center rounded-xl text-white">
            <h1><?= $completedTasks ?></h1>
            <p class="text-lg">Selesai</p>
        </div>
    </div>
    <div class="mx-6 mt-5">
        <a href="<?= base_url('send-report') ?>" class="btn btn-secondary rounded-xl">
            Kirim Laporan via WhatsApp
        </a>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success mt-2">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-error mt-2">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')) : ?>
        <div class="alert alert-warning mt-2">
            <?= session()->getFlashdata('warning') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>