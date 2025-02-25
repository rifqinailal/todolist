<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="px-6 sm:px-11">
    <div class="mt-3">
        <h1 class="text-2xl sm:text-[30px] font-semibold">Todolist</h1>
        <h1 class="text-sm sm:text-base font-semibold text-[#7f7f7f]">Kelola Waktu, Selesaikan Tugas, Capai Target!</h1>
    </div>

    <div class="hidden sm:block mt-10">
        <div class="border-b border-black pb-3">
            <ul class="grid grid-cols-5 text-center font-semibold">
                <li>Judul tugas</li>
                <li>Deskripsi tugas</li>
                <li>Tanggal di buat</li>
                <li>Deadline</li>
                <li>Status</li>
            </ul>
        </div>
    </div>
    <div class="flex flex-col px-4 sm:px-12">
        <!-- mobile -->
        <?php foreach ($tasks as $item) : ?>
            <?php if ($item == 0) : ?>
                <h1>tambahkan list baru</h1>
            <?php endif ?>
            <div class="block sm:hidden border border-black rounded-lg my-4 p-4">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-semibold">Judul tugas</span>
                        <span><?= $item['title']; ?></span>

                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Deskripsi tugas</span>
                        <span><?= $item['description']; ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Tanggal di buat</span>
                        <span><?= date('d/m/Y', strtotime($item['created_at'])); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Deadline</span>
                        <span><?= date('d/m/Y', strtotime($item['deadline'])); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold">Status:</span>
                        <div class="badge badge-neutral"><span><?= $item['status']; ?></span></div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <!-- desktop -->
    <?php if (count($tasks) == 0) : ?>
        <h1 class="font-semibold text-xl sm:text-2xl text-center m-10 bg-primary text-black py-2 rounded-lg">tambahkan list baru</h1>
    <?php endif ?>
    <?php foreach ($tasks as $item) : ?>
        <div class="hidden sm:grid grid-cols-5 items-center border border-black rounded-lg my-4 py-3">
            <h1 class="text-center"><span><?= $item['title']; ?></span></h1>
            <h1 class="text-center"><span><?= $item['description']; ?></span></h1>
            <h1 class="text-center"><span><?= date('d/m/Y', strtotime($item['created_at'])); ?></span></h1>
            <h1 class="text-center"><span><?= date('d/m/Y', strtotime($item['deadline'])); ?></span></h1>
            <div class="flex justify-center">
                <div class="btn btn-primary"><span><?= $item['status']; ?></span></div>
            </div>
        </div>
    <?php endforeach ?>

</div>
<?= $this->endSection() ?>