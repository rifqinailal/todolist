<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="px-6 sm:px-11">
    <div class="mt-3">
        <h1 class="text-2xl sm:text-[30px] font-semibold">Todolist</h1>
        <h1 class="text-sm sm:text-base font-semibold text-[#7f7f7f]">Kelola Waktu, Selesaikan Tugas, Capai Target!</h1>
    </div>
    <div class="mt-2">
        <a href="#"><!-- Open the modal using ID.showModal() method -->
            <button class="btn btn-primary font-semibold" onclick="my_modal_1.showModal()">Tambah</button>
            <dialog id="my_modal_1" class="modal">
                <div class="modal-box">
                    <div>
                        <form action="/create" method="POST">
                            <?= csrf_field(); ?>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Judul</span>
                                </label>
                                <input type="text" placeholder="Masukkan judul tugas" class="input input-bordered w-full"
                                    name="title" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Deskripsi</span>
                                </label>
                                <input type="text" placeholder="Masukkan deskripsi tugas" class="input input-bordered w-full"
                                    name="description" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Deadline</span>
                                </label>
                                <input type="date" placeholder="Pilih tanggal deadline" class="input input-bordered w-full"
                                    name="deadline" />
                            </div>
                            <button type="submit" class="btn btn-secondary mt-2">Tambah</button>
                        </form>
                    </div>
                    <div class="modal-action">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                    </div>
                </div>
            </dialog>
        </a>
    </div>
    <div class="hidden sm:block mt-10">
        <div class="border-b border-black pb-3">
            <ul class="grid grid-cols-6 text-center font-semibold">
                <li>Judul tugas</li>
                <li>Deskripsi tugas</li>
                <li>Tanggal di buat</li>
                <li>Deadline</li>
                <li>Status</li>
                <li>Tindakan</li>
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
                    <div class="flex justify-center mt-6 gap-2">
                        <a href="/delete/<?= $item['id']; ?>"> <button class="btn btn-error">hapus</button></a>
                        <div>
                            <a href="#">
                                <button class="btn btn-warning font-semibold" onclick="my_modal_2.showModal()">Edit</button>
                                <dialog id="my_modal_2" class="modal">
                                    <div class="modal-box">
                                        <div>
                                            <form action="/update/<?= $item['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <div class="form-control w-full">
                                                    <label class="label">
                                                        <span class="label-text">Judul</span>
                                                    </label>
                                                    <input type="text" placeholder="Masukkan judul tugas"
                                                        class="input input-bordered w-full"
                                                        name="title"
                                                        value="<?= $item['title']; ?>" />
                                                </div>
                                                <div class="form-control w-full">
                                                    <label class="label">
                                                        <span class="label-text">Deskripsi</span>
                                                    </label>
                                                    <input type="text" placeholder="Masukkan deskripsi tugas"
                                                        class="input input-bordered w-full"
                                                        name="description"
                                                        value="<?= $item['description']; ?>" />
                                                </div>
                                                <div>
                                                    <div class="form-control">
                                                        <label class="label cursor-pointer">
                                                            <span class="label-text">Belum</span>
                                                            <input type="radio" name="status" value="Pending"
                                                                class="radio checked:bg-error"
                                                                <?= ($item['status'] == 'Pending') ? 'checked' : ''; ?> />
                                                        </label>
                                                    </div>
                                                    <div class="form-control">
                                                        <label class="label cursor-pointer">
                                                            <span class="label-text">Tugas Selesai</span>
                                                            <input type="radio" name="status" value="Completed"
                                                                class="radio checked:bg-primary"
                                                                <?= ($item['status'] == 'Completed') ? 'checked' : ''; ?> />
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-control w-full">
                                                    <label class="label">
                                                        <span class="label-text">Deadline</span>
                                                    </label>
                                                    <input type="date" placeholder="Pilih tanggal deadline"
                                                        class="input input-bordered w-full"
                                                        name="deadline"
                                                        value="<?= date('Y-m-d', strtotime($item['deadline'])); ?>" />
                                                </div>
                                                <button type="submit" class="btn btn-secondary mt-2">Edit</button>
                                            </form>
                                        </div>
                                        <div class="modal-action">
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            </a>
                        </div>
                        <div>
                            <a href="/updateStatus/<?= $item['id']; ?>">
                                <button class="btn btn-primary <?= ($item['status'] == 'Pending') ? 'btn-error' : 'btn-sucsess' ?>">
                                    <?= ($item['status'] == 'Pending') ? 'Selesaikan' : 'Selesai' ?>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <!-- desktop -->
    <?php if (count($tasks) == 0) : ?>
        <h1 class="font-semibold text-xl sm:text-2xl text-center m-10 bg-primary text-white py-2 rounded-lg">tambahkan list baru</h1>
    <?php endif ?>
    <?php foreach ($tasks as $item) : ?>
        <div class="hidden sm:grid grid-cols-6 items-center border border-black rounded-lg my-4 py-3">
            <h1 class="text-center"><span><?= $item['title']; ?></span></h1>
            <h1 class="text-center"><span><?= $item['description']; ?></span></h1>
            <h1 class="text-center"><span><?= date('d/m/Y', strtotime($item['created_at'])); ?></span></h1>
            <h1 class="text-center"><span><?= date('d/m/Y', strtotime($item['deadline'])); ?></span></h1>
            <div class="flex justify-center">
                <div class="badge badge-neutral"><span><?= $item['status']; ?></span></div>
            </div>
            <div class="flex justify-center">
                <div class="flex flex-col items-center w-16 gap-2">
                    <a href="/delete/<?= $item['id']; ?>"> <button class="btn btn-error">hapus</button></a>
                    <div>
                        <a href="#">
                            <button class="btn btn-warning font-semibold" onclick="my_modal_<?= $item['id']; ?>.showModal()">Edit</button>
                            <dialog id="my_modal_<?= $item['id']; ?>" class="modal">
                                <div class="modal-box">
                                    <div>
                                        <form action="/update/<?= $item['id']; ?>" method="POST">
                                            <?= csrf_field(); ?>
                                            <div class="form-control w-full">
                                                <label class="label">
                                                    <span class="label-text">Judul</span>
                                                </label>
                                                <input type="text" placeholder="Masukkan judul tugas"
                                                    class="input input-bordered w-full"
                                                    name="title"
                                                    value="<?= $item['title']; ?>" />
                                            </div>
                                            <div class="form-control w-full">
                                                <label class="label">
                                                    <span class="label-text">Deskripsi</span>
                                                </label>
                                                <input type="text" placeholder="Masukkan deskripsi tugas"
                                                    class="input input-bordered w-full"
                                                    name="description"
                                                    value="<?= $item['description']; ?>" />
                                            </div>
                                            <div>
                                                <div class="form-control">
                                                    <label class="label cursor-pointer">
                                                        <span class="label-text">Belum</span>
                                                        <input type="radio" name="status" value="Pending"
                                                            class="radio checked:bg-error"
                                                            <?= ($item['status'] == 'Pending') ? 'checked' : ''; ?> />
                                                    </label>
                                                </div>
                                                <div class="form-control">
                                                    <label class="label cursor-pointer">
                                                        <span class="label-text">Tugas Selesai</span>
                                                        <input type="radio" name="status" value="Completed"
                                                            class="radio checked:bg-primary"
                                                            <?= ($item['status'] == 'Completed') ? 'checked' : ''; ?> />
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-control w-full">
                                                <label class="label">
                                                    <span class="label-text">Deadline</span>
                                                </label>
                                                <input type="date" placeholder="Pilih tanggal deadline"
                                                    class="input input-bordered w-full"
                                                    name="deadline"
                                                    value="<?= date('Y-m-d', strtotime($item['deadline'])); ?>" />
                                            </div>
                                            <button type="submit" class="btn btn-secondary mt-2">Edit</button>
                                        </form>
                                    </div>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                        </a>
                    </div>
                    <div>
                        <a href="/updateStatus/<?= $item['id']; ?>">
                            <button class="btn btn-primary <?= ($item['status'] == 'pending') ? 'btn-error' : 'btn-sucsess' ?>">
                                <?= ($item['status'] == 'pending') ? 'Selesaikan' : 'Selesai' ?>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

</div>
<?= $this->endSection() ?>