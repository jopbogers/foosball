<div class="py-10">
    <h1 class="text-gray-300 text-center text-3xl mb-10">Season {{$season->name}}</h1>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
        <div
                class="bg-white dark:bg-gray-800 p-5 flex flex-col gap-5 overflow-hidden shadow-sm sm:rounded-lg text-gray-700 dark:text-gray-300">
            @foreach($matches as $match)
                <div class="dark:bg-gray-900 bg-gray-100 py-5 px-10  rounded-lg relative">
                    @if(auth()->user()->admin)
                        <a class="absolute top-5 right-5" href="{{route('edit.match', ['match' => $match])}}"><x-carbon-edit class="w-5 h-5"/></a>
                    @endif
                    <p class="text-center text-gray-500 text-sm font-bold">{{$match->getDate()}}</p>
                    <div class="gap-6 flex flex-col sm:flex-row">
                        <div class="flex-1 flex justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-medium">Team <span class="text-red-500">Red</span> <span
                                            class="text-center align-top text-gray-500 text-xs font-bold">{{$match->teamRedPoints()}}</span>
                                </h2>
                                @foreach($match->teamRed as $player)
                                    <div>
                                        <p class="text-lg {{$player->userRating->user->id == auth()->id() ? 'text-yellow font-bold': ''}}">{{$player->userRating->user->name}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-20 flex justify-center">
                                <p class="text-3xl font-bold text-center">{{$match->team_red_score}}</p>
                            </div>
                        </div>
                        <div class=" flex flex-1 sm:flex-row-reverse justify-between sm:justify-end sm:gap-10 items-center">
                            <div>
                                <h2 class="text-2xl font-medium">Team <span class="text-blue-500">Blue</span> <span
                                            class="text-center align-top text-gray-500 text-xs font-bold">{{$match->teamBluePoints()}}</span>
                                </h2>
                                @foreach($match->teamBlue as $player)
                                    <div>
                                        <p class="text-lg {{$player->userRating->user->id == auth()->id() ? 'text-yellow font-bold': ''}}">{{$player->userRating->user->name}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-20 flex justify-center">
                                <p class="text-3xl font-bold text-center">{{$match->team_blue_score}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $matches->links() }}
        </div>
    </div>
</div>
