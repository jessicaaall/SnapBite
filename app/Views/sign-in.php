<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/styles.css'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="w-screen h-screen bg-[#FFEFEF]">
        <?php include 'navbar.php'; ?>
        <div class="flex justify-center bg-[#FFEFEF]">
            <div class="container w-max h-max mt-36 mx-8 px-10 py-16 md:p-16 bg-white rounded-3xl">
                <div class="col-5">
                    <h1 class="font-text font-bold text-xl md:text-3xl text-center mb-4 text-black">SIGN IN</h1>
                    <h1 class="font-text font-normal text-sm md:text-sm text-center mb-4 text-black">Welcome back! Please sign in to your account</h1>
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div id="alert-border-2" class="flex items-center p-4 mb-4 rounded-xl text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                <?= session()->getFlashdata('msg') ?>
                            </div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-2" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo base_url(); ?>/AuthController/loginAuth" method="post">
                        <div class="flex flex-col mb-4">
                            <label class="font-text font-medium text-sm md:text-md mb-1 text-black">Username</label>
                            <input type="text" name="username" placeholder="Enter your username" value="<?= set_value('username') ?>" class="form-control py-2 px-4 bg-[#F5F5F5] rounded-lg border-2 border-[#DDDDDD] text-black">
                        </div>
                        <div class="flex flex-col">
                            <label class="font-text font-medium text-sm md:text-md mb-1 text-black">Password</label>
                            <input type="password" name="password" placeholder="Enter your password" class="form-control py-2 px-4 bg-[#F5F5F5] rounded-lg border-2 border-[#DDDDDD] text-black">
                        </div>

                        <div class="">
                            <button type="submit" class="font-text font-bold bg-[#C51841] w-full mt-8 rounded-md text-[#FFFFFF] py-2">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>