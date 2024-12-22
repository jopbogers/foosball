<x-alert type="success" class="bg-green-700/50 absolute rounded-xl bottom-10 right-10 w-max text-green-100 p-4" x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"/>
