<div id="toast" class="relative flex items-center bg-red-500 border-l-4 border-red-700 py-2 px-3 mt-4 shadow-md mb-2 animated-toast">
    <!-- close button -->
    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
        </svg>
    </div>
    <!-- icons -->
    <div class="text-red-500 rounded-full bg-white mr-3">
        <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
        </svg>
    </div>
    <!-- message -->
    <div class="text-white max-w-xs ">
        {{ $slot }}
    </div>
</div>

<style>
    .animated-toast{
        animation:disappear 1.5s 1;
        -webkit-animation:disappear 1.5s 1;
        animation-fill-mode: forwards;

        animation-delay:3s;
        -webkit-animation-delay:3s;
        -webkit-animation-fill-mode: forwards;
    } 

    @keyframes disappear{
        from {opacity :1;}
        to {opacity :0;}
    }

    @-webkit-keyframes disappear{
        from {opacity :1;}
        to {opacity :0;}
    }
</style>