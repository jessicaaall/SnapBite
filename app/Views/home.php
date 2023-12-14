<!DOCTYPE html>
<html class="bg-white">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Restoran</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css?v=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Exa:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="w-screen h-screen">
        <?php include 'navbar.php'; ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-4 mx-8 lg:mx-16 pt-8 pb-16">
            <div class="col-span-1 lg:col-span-2 xl:col-span-3">
                <form id="searchForm" method='get' action='<?= base_url(); ?>'>
                </form>
            </div>
            <div class="col-span-1">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="font-text label-text text-black">Filter kalori</span>
                    </div>
                    <select id="kaloriFilter" class="select select-bordered bg-white font-text text-black">
                        <option selected class="font-text text-black">Semua</option>
                        <option class="font-text text-black">Low</option>
                        <option class="font-text text-black">Medium</option>
                        <option class="font-text text-black">High</option>
                    </select>
                </label>
            </div>
            <div class="col-span-4">
                <div id="restoranContainer" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-4">
                    <?php foreach ($restoran as $restoranitem) : ?>
                        <!-- RESTORAN CARD -->
                        <div class="card shadow-xl">
                            <figure><img src="<?= $restoranitem['image']; ?>" alt="Foto" /></figure>
                            <div class="my-4 mx-4 cardbody">
                                <h2 class="font-text font-bold text-black"><?= $restoranitem['namaRestoran']; ?></h2>
                                <p class="font-text text-black"><?= $restoranitem['totalKalori']; ?> Kalori | <span class="distanceResult font-text text-black"></span></p>
                                <div class="card-actions justify-end">
                                    <button data-restaurant-id="<?= $restoranitem['id']; ?>" class="pesan bg-[#FFCBCB] text-black font-semibold font-text w-24 h-12 hover:bg-[#ffacac] rounded-xl">Pesan</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            var customerLokasiX = <?= json_encode($lokasiX) ?>;
            var customerLokasiY = <?= json_encode($lokasiY) ?>;
            $(document).ready(function() {
                var datarestoran;
                $.ajax({
                    type: 'GET',
                    url: 'http://localhost:8081/restoranAPI/',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(index, item) {
                            const distance = countDistance(item.lokasiX, item.lokasiY, customerLokasiX, customerLokasiY);
                            $('.distanceResult').eq(index).append(distance + " km");
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                $('#restoranContainer').on('click', '.pesan', function() {
                    // Get the restaurant ID from the data attribute
                    var restaurantID = $(this).data('restaurant-id');

                    // Redirect to the page with the specific restaurant ID
                    window.location.href = '<?= base_url('makanan/'); ?>' + restaurantID;
                });
                $('#kaloriFilter').change(function() {
                    var selectedValue = $(this).val();
                    if (selectedValue === 'Semua') {
                        selectedValue = '';
                    }
                    $.ajax({
                        type: 'GET',
                        url: 'http://localhost:8081/restoranAPI/' + selectedValue,
                        dataType: 'json',
                        success: function(data) {
                            datarestoran = data;
                            updateRestoranList(data);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });

                function countDistance(x1, y1, x2, y2) {
                    const deltaX = x2 - x1;
                    const deltaY = y2 - y1;
                    // Euclidean distance formula
                    const distance = Math.sqrt(deltaX ** 2 + deltaY ** 2);
                    const roundedDistance = distance.toFixed(1);
                    return parseFloat(roundedDistance);
                }


                function updateRestoranList(data) {
                    var restoranContainer = $('#restoranContainer');
                    restoranContainer.empty();

                    $.each(data, function(index, item) {
                        restoranContainer.append('<div class="card shadow-xl"><figure><img src="' + item.image + '" alt="Foto" /></figure><div class="my-4 mx-4 cardbody"><h2 class="font-text font-bold text-black">' + item.namaRestoran + '</h2><p class="font-text text-black">' + item.totalKalori + ' Kalori | <span class="distanceResult font-text text-black"></span></p><div class="card-actions justify-end"><button data-restaurant-id=' + item.id + ' class="pesan bg-[#FFCBCB] text-black font-semibold font-text w-24 h-12 hover:bg-[#ffacac] rounded-xl">Pesan</button></div></div></div>');
                        const distance = countDistance(item.lokasiX, item.lokasiY, customerLokasiX, customerLokasiY);
                        // var distanceSpan = $('<p class="distanceResult font-text text-black"></p>');
                        // distanceSpan.text(distance + " km");
                        $('.distanceResult').eq(index).append(distance + " km");
                    });
                }
            });
        </script>
</body>

</html>