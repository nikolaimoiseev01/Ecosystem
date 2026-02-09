<footer x-data="{ isMediaClub: window.location.pathname === '/media-club' }" x-show="!isMediaClub"
    class="bg-green-500 text-white mt-auto rounded-tl-[200px] rounded-tr-[200px] md:rounded-none flex flex-col gap-8 items-center text-white py-16">
    <h1 class="">КОНТАКТЫ</h1>
    <h2 class="text-white">cu_ecosistema@mail.ru</h2>
    <a href="{{route('portal.masterskaya')}}">Прошлые курсы</a>
    <p class="text-sm text-center">Организовано Всероссийским общественным экологическим движением «Экосистема»
        </p>
</footer>
