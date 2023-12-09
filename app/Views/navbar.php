<div class="w-screen py-4 bg-[#FFEFEF]">
    <div class="flex flex-row justify-between mx-4 md:mx-8">
        <div class="flex flex-row">
            <a href="https://imgbb.com/" class="my-auto"><img src="https://i.ibb.co/mbVpMgb/logo.png" alt="logo" border="0" class="w-[50%] h-[50%] md:w-[100%] md:h-[100%]"></a>
            <h1 class="font-logo my-auto ml-4 text-2xl hidden md:flex text-black">SNAPBITE</h1>
        </div>
        <?php if (session()->get('isLoggedIn')) : ?>
        <div class="flex flex-row space-x-2 md:space-x-8">
            <button class="font-text font-semibold bg-[#FFEFEF] px-4 md:px-8 rounded-md text-sm md:text-lg text-black py-2 my-auto hover:bg-[#FFCBCB]">Home</button>
            <button class="font-text font-semibold bg-[#FFEFEF] px-4 md:px-8 rounded-md text-sm md:text-lg text-black py-2 my-auto hover:bg-[#FFCBCB]">My Order</button>
            <div class="dropdown dropdown-end">
                <button tabindex="0" class="m-1">
                    <svg class="my-auto w-6 h-6 md:w-12 md:h-12 text-black -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul tabindex="0" class="dropdown-content z-[1] bg-[#FFCBCB] hover:bg-[#ffacac] rounded-xl w-40">
                    <li>
                        <form action="/logout" method="GET">
                            <button class="font-text font-semibold text-black w-full py-2">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<script>
</script>