<i id="hamburger_icon" class="fa-solid fa-bars fixed right-4 md:right-6 top-4 md:top-6 text-2xl md:text-4xl cursor-pointer"></i>
<i id="close_icon" class="hidden z-50 fa-solid fa-xmark fixed right-4 md:right-6 top-4 md:top-6 text-2xl md:text-4xl cursor-pointer"></i>
<div class="side_wrapper w-full">
    <div class="side_menu_off pt-4">
        <h5 class="text-base text-white px-5">Menu</h5>

        <div class="py-4 overflow-y-auto">
            <ul class="space-y-4">
                <li class="side_li">
                    <a href="/" class="flex items-center p-2 text-white text-4xl hover:text-gray-100 group">
                        <span class="ms-3">Works</span>
                    </a>
                </li>
                <li class="side_li">
                    <a href="https://www.instagram.com/reha.biridge?igsh=MWwwN3ZqMDVheG1rNQ==" target="blank" class="flex items-center p-2 text-white text-4xl hover:text-gray-100 group">
                        <span class="ms-3">About</span>
                    </a>
                </li>
                <li class="side_li">
                    <a href="#" class="flex items-center p-2 text-white text-4xl hover:text-gray-100 group">
                        <span class="ms-3">Contact</span>
                    </a>
                </li>
                @cannot('read')
                    <li class="side_li">
                        <a href="/login" class="flex items-center p-2 text-white text-4xl hover:text-gray-100 group">
                            <span class="ms-3">Login</span>
                        </a>
                    </li>
                @endcannot
                @can('read')
                    <li class="side_li">
                        <a href="/login" class="flex items-center p-2 text-white text-4xl hover:text-gray-100 group">
                            <span class="ms-3">My page</span>
                        </a>
                    </li>
                @endcan
                @can('read')
                    <li class="side_li">
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center p-2">
                            @csrf
                            <button type="submit" class="flex items-center text-white text-4xl hover:text-gray-100 group">
                                <span class="ms-3">Logout</span>
                            </button>
                        </form>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
