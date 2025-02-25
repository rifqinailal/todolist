<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('./src/output.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div>
        <div class="navbar  bg-base-200">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 font-semibold">
                        <li class="hover:font-normal"><a href="/dashboard">Dashboard</a></li>
                        <li class="hover:font-normal"><a href="/">To-do-List</a></li>
                        <li class="hover:font-normal"><a href="/completed">Completed</a></li>
                        <li class="hover:font-normal"><a href="/pending">Pending</a></li>
                    </ul>
                </div>
                <a class="btn btn-ghost normal-case text-xl">RifqiProject</a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 font-bold">
                    <li class="hover:font-normal"><a href="/dashboard">Dashboard</a></li>
                    <li class="hover:font-normal"><a href="/">To-do-List</a></li>
                    <li class="hover:font-normal"><a href="/completed">Completed</a></li>
                    <li class="hover:font-normal"><a href="/pending">Pending</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="/image/profile.jpg" />
                        </div>
                    </label>
                    <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between">
                                Profile
                                <span class="badge">New</span>
                            </a>
                        </li>
                        <li><a>Settings</a></li>
                        <li><a>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div>
        <main>
            <div class="flex flex-row justify-center">
                <div class="m-4 w-full border-2 border-base-300 rounded-lg">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>