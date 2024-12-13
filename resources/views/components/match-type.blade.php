@props(['disabled' => false])

<ul class="grid w-full gap-6 md:grid-cols-2 max-w-3xl mx-auto my-12">
    <li>
        <input type="radio" id="1v1" name="type" value="1v1" wire:model.change="matchType" class="hidden peer" required />
        <label for="1v1" class="inline-flex items-center justify-between w-full p-6 border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:text-yellow peer-checked:border-yellow text-gray-400 bg-gray-800 hover:bg-gray-700 peer-checked:bg-gray-700">
            <div class="w-full text-lg font-semibold text-center">1v1</div>
        </label>
    </li>
    <li>
        <input type="radio" id="2v2" name="type" value="2v2" wire:model.change="matchType" class="hidden peer" required />
        <label for="2v2" class="inline-flex items-center justify-between w-full p-6 border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:text-yellow peer-checked:border-yellow text-gray-400 bg-gray-800 hover:bg-gray-700 peer-checked:bg-gray-700">
            <div class="w-full text-lg font-semibold text-center">2v2</div>
        </label>
    </li>
</ul>
