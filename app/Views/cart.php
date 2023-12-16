<!DOCTYPE html>
<html class="bg-white">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cart</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('css/styles.css'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the toast */
        #toast {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem;
            background-color: #C51841;
            color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="w-screen h-screen">
        <?php include 'navbar.php'; ?>
        <h1 class="font-text text-lg md:text-2xl font-bold text-black mx-8 lg:mx-16 mt-8">My Order Summary</h1>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mx-8 lg:mx-16 py-8">
            <div class="col-span-1 lg:col-span-2">
                <?php if (count($restoran) !== 0) : ?>
                    <?php foreach ($restoran as $restoranitem) : ?>
                        <div class="flex flex-row space-x-4">
                            <figure class="w-[30%]"><img src="<?= $restoranitem['image']; ?>" alt="Foto" class="rounded-xl" /></figure>
                            <div class="flex flex-col space-y-2 my-auto md:py-4">
                                <h1 class="font-text text-lg md:text-2xl font-bold text-black"><?= $restoranitem['namaRestoran']; ?></h1>
                                <p class="font-text text-black"><?= $restoranitem['totalKalori']; ?> Kalori | <span class="distanceResult font-text text-black"></span> km</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>

                <?php endif ?>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mx-8 lg:mx-16 pb-16">
            <div class="col-span-1 lg:col-span-2 divide-y divide-black">
                <?php if (count($restoran) !== 0) : ?>
                    <?php foreach ($cart as $makananitem) : ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 py-4">
                            <div class="col-span-1 row-span-1">
                                <h2 class="font-text font-bold text-black text-lg"><?= $makananitem['foodName']; ?></h2>
                                <p class="font-text text-black"><?= $makananitem['foodKalori']; ?> Kalori | <span class="priceResult font-text text-black font-semibold">Jumlah : <?= $makananitem['quantity']; ?> x <?= 'Rp ' . number_format(esc($makananitem['foodHarga']), 0, ',', '.'); ?> -> <?= 'Rp ' . number_format(esc($makananitem['foodHarga'] * $makananitem['quantity']), 0, ',', '.'); ?></span></p>
                            </div>
                            <div class="col-span-1 row-span-1 mt-4 md:mt-8 flex justify-end mr-4 space-x-4">
                                <button data-foodid="<?= $makananitem['foodId']; ?>" class="substract bg-[#FFCBCB] hover:bg-[#ffacac] btn btn-sm btn-circle text-black text-bold text-4xl pb-12 px-6 border-0">-</button>
                                <button data-foodid="<?= $makananitem['foodId']; ?>" class="add bg-[#FFCBCB] hover:bg-[#ffacac] btn btn-sm btn-circle text-black text-bold text-4xl pb-12 px-6 border-0">+</button>
                                <button data-foodid="<?= $makananitem['foodId']; ?>" class="delete bg-red-600 hover:bg-red-800 btn btn-sm btn-circle text-black text-bold text-3xl pb-11 pt-1 px-6 border-0">X</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h1 class="font-text text-lg md:text-2xl font-bold text-black text-center mb-4">No food in cart</h1>
                <?php endif ?>
            </div>
            <div class="col-span-1 ">
                <div class="flex flex-col border-2 rounded-xl shadow-xl p-8">
                    <h1 class="font-text text-lg md:text-2xl font-bold text-black text-center mb-4">Payment Summary</h1>
                    <div class="flex justify-between my-2">
                        <p class="font-text text-black">Subtotal : </p>
                        <p class="subtotal font-text text-black"></p>
                    </div>
                    <div class="flex justify-between my-2">
                        <p class="font-text text-black">Delivery Fee : </p>
                        <p class="delivery font-text text-black"></p>
                    </div>
                    <div class="flex justify-between my-2">
                        <p class="font-text text-black">Order Fee : </p>
                        <p class="order font-text text-black"></p>
                    </div>
                    <div class="flex justify-between mt-8 mb-4">
                        <p class="font-text text-black text-lg font-bold">Total Payment : </p>
                        <p class="total font-text text-black text-lg font-bold"></p>
                    </div>
                    <div class="flex justify-between my-0">
                        <p class="font-text text-black text-lg font-bold">Balance : </p>
                        <p class="balance font-text text-black text-lg font-bold"></p>
                    </div>
                    <?php if (count($restoran) !== 0) : ?>
                        <button class="pay bg-[#C51841] hover:bg-[#5e1f2e] text-white text-bold text-2xl mt-4 py-2 rounded-lg">PLACE ORDER</button>
                    <?php else : ?>
                        <button class="btn btn-disabled pay bg-[#C51841] hover:bg-[#5e1f2e] text-white text-bold text-2xl mt-4 py-2 rounded-lg">PLACE ORDER</button>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
    <div id="toast"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var customerLokasiX = <?= json_encode($lokasiX) ?>;
        var customerLokasiY = <?= json_encode($lokasiY) ?>;
        var restoran = <?= json_encode($restoran) ?>;
        var cart = <?= json_encode($cart) ?>;

        $(document).ready(function() {
            function showToast(message) {
                var toast = $('#toast');
                toast.text(message);
                toast.fadeIn();

                // Hide the toast after 2 seconds
                setTimeout(function() {
                    toast.fadeOut();
                }, 2000);
            }
            const balance = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(<?= json_encode($saldo) ?>);
            $('.balance').append(balance);

            var restoranId;
            if (restoran.length !== 0) {
                restoranId = restoran[0]['id'];
            }

            function countFoodPrice(cart) {
                var totalFoodPrice = 0;
                Object.keys(cart).forEach(function(key) {
                    totalFoodPrice += cart[key]["quantity"] * cart[key]["foodHarga"];
                })
                return totalFoodPrice;
            }
            const formattedFoodPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(countFoodPrice(cart));
            $('.subtotal').append(formattedFoodPrice);

            function countDeliveryFee(customerLokasiX, customerLokasiY, restoran) {
                if (restoran.length !== 0) {
                    return countDistance(customerLokasiX, customerLokasiY, restoran[0]['lokasiX'], restoran[0]['lokasiY']) * 3000;
                } else {
                    return 0;
                }
            }
            const formattedDeliveryFee = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(countDeliveryFee(customerLokasiX, customerLokasiY, restoran));
            $('.delivery').append(formattedDeliveryFee);

            function countProcessTime(cart) {
                var totalProcessTime = 0;
                Object.keys(cart).forEach(function(key) {
                    totalProcessTime += parseInt(cart[key]["foodWaktuProses"]);
                })
                return totalProcessTime;
            }
            const formattedOrderFee = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(countProcessTime(cart) * 100);
            $('.order').append(formattedOrderFee);

            function countTotalPrice(customerLokasiX, customerLokasiY, restoran, cart) {
                return countProcessTime(cart) * 100 + countDeliveryFee(customerLokasiX, customerLokasiY, restoran) + countFoodPrice(cart);
            }

            const formattedTotalPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(countTotalPrice(customerLokasiX, customerLokasiY, restoran, cart));
            $('.total').append(formattedTotalPrice);



            function countDistance(x1, y1, x2, y2) {
                const deltaX = x2 - x1;
                const deltaY = y2 - y1;
                // Euclidean distance formula
                const distance = Math.sqrt(deltaX ** 2 + deltaY ** 2);
                const roundedDistance = distance.toFixed(1);
                return parseFloat(roundedDistance);
            }
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8081/restoranbyid/' + restoranId,
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        const distance = countDistance(item.lokasiX, item.lokasiY, customerLokasiX, customerLokasiY);
                        $('.distanceResult').eq(index).append(distance);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });

            $('.add').on('click', function() {
                const foodId = $(this).data('foodid');
                updateCart(foodId, 'add');
            });

            // Subtract button click event
            $('.substract').on('click', function() {
                const foodId = $(this).data('foodid');
                updateCart(foodId, 'subtract');
            });

            // Delete button click event
            $('.delete').on('click', function() {
                const foodId = $(this).data('foodid');
                updateCart(foodId, 'delete');
            });

            $('.pay').on('click', function() {
                placeOrder(countProcessTime(cart), countTotalPrice(customerLokasiX, customerLokasiY, restoran, cart));
            });

            function placeOrder(lamaPemesanan, totalHarga) {
                if (<?= $saldo ?> >= countTotalPrice(customerLokasiX, customerLokasiY, restoran, cart)) {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost:8080/cart/placeOrder',
                        data: {
                            lamaPemesanan: lamaPemesanan,
                            totalHarga: totalHarga
                        },
                        success: function(response) {
                            // Handle the response from the server (e.g., update the UI)
                            console.log(response);
                            window.location.reload();
                            // Optionally, you can reload the page or update the UI without a page refresh
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                } else {
                    showToast("Not enough balance!!!")
                }

            }

            function updateCart(foodId, action) {
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:8080/cart/updateCart',
                    data: {
                        foodId: foodId,
                        action: action
                    },
                    success: function(response) {
                        // Handle the response from the server (e.g., update the UI)
                        console.log(response);
                        window.location.reload();
                        // Optionally, you can reload the page or update the UI without a page refresh
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
</body>

</html>