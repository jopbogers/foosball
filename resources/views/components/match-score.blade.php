@props(['team'])

<ul class="grid gap-4 grid-cols-7 justify-center md:grid-cols-11 mx-auto my-4 relative">
    @for ($i = 0; $i <= 10; $i++)
        <li class="z-20">
            <input type="radio" id="{{$team . '_'. $i}}" name="score{{$team}}" value="{{$i}}" wire:model.change="score{{$team}}" class="hidden peer" required />
            <label for="{{$team . '_'. $i}}" class="inline-flex items-center justify-between w-full py-4 px-1.5 border  rounded-lg cursor-pointer hover:text-gray-300 border-gray-400 peer-checked:text-yellow peer-checked:border-yellow text-gray-400 bg-gray-800 hover:bg-gray-700 peer-checked:bg-gray-700">
                <div class="w-full text-lg font-semibold text-center">{{$i}}</div>
            </label>
        </li>
    @endfor
</ul>
