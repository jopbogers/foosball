<div class="py-10">
    <h1 class="text-gray-300 text-center text-3xl mb-10">Season {{$season->name}}</h1>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table-auto w-full !max-w-full">
                <thead class="bg-gray-900/50 drop-shadow">
                <tr class="text-left font-bold  text-gray-300">
                    <th class="p-2 pl-10 sm:w-32">Place</th>
                    <th class="p-2">Name</th>
                    <th class="p-2 pr-10 sm:pr-2">Points</th>
                    <th class="p-2 hidden sm:table-cell">W</th>
                    <th class="p-2 hidden sm:table-cell">L</th>
                    <th class="p-2 hidden sm:table-cell">GF</th>
                    <th class="p-2 hidden sm:table-cell">GA</th>
                    <th class="p-2 hidden sm:table-cell pr-10">GD</th>

                </tr>
                </thead>
                <tbody>
                @foreach($season->players as $player)
                    <tr class="border-t border-gray-900">
                        <td class="p-2 pl-10 sm:w-32 text-gray-300">
                            <div class="flex items-center my-auto gap-2">
                                <p>{{$loop->index + 1}}</p>
                            </div>
                        </td>
                        <td class="p-2 text-gray-300 min-w-max">
                            <div class="flex min-w-max overflow-hidden items-center gap-2">
                                <p
                                    class="text-ellipsis overflow-hidden whitespace-nowrap w-24 sm:w-fit  {{$player->user->id == auth()->id() ? 'text-yellow font-bold': ''}}"
                                >{{$player->user->name}}
                                </p>
                            </div>
                        </td>
                        <td class="p-2 w-32 text-gray-300/50 ">{{round($player->rating)}}</td>
                        <td class="hidden sm:table-cell p-2 w-20 text-gray-300/50">{{$player->wins}}</td>
                        <td class="hidden sm:table-cell p-2 w-20 text-gray-300/50">{{$player->losses}}</td>
                        <td class="hidden sm:table-cell p-2 w-20 text-gray-300/50">{{$player->goals_for}}</td>
                        <td class="hidden sm:table-cell p-2 w-20 text-gray-300/50">{{$player->goals_against}}</td>
                        <td class="hidden sm:table-cell p-2 pr-10 w-20 text-gray-300/50">{{$player->goals_for - $player->goals_against}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
