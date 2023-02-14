@if ($isMobile)
    <div class="mt-2 flex-col justify-between items-center w-full">
        <div
            @if(($expressionValid === true && $queryError === false) || count($expressionItems) == 0)
                class="h-12 w-full justify-start flex items-center py-2 border border-accent-600 rounded-md bg-white"
            @else
                class="h-12 w-full justify-start flex items-center py-2 border-2 border-red-500 rounded-md bg-white"
            @endif
        >
            @foreach($expressionItems as $index => $expressionItem)
                <div
                    class="p-2 border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 rounded-md mx-1 hover:cursor-pointer whitespace-nowrap"
                    wire:click="removeExpressionItem('{{ $index }}')"
                >{{ $expressionItem }}</div>
            @endforeach
            @if(count($expressionItems) > 0)
                <i wire:click="clearExpression" title="clear"
                   class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 px-2 pb-2 pt-1 text-xl"></i>
            @endif
        </div>
        <div
            class="mt-2 h-12 flex items-center w-full py-2 border border-accent-600 rounded-md bg-white">
            @foreach($operators as $operator)
                <div
                    class="p-2 text-center border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 rounded-md mx-3 hover:cursor-pointer"
                    wire:click="addOperator('{{ $operator }}')"
                >{{ $operator }}</div>
            @endforeach
        </div>
        <div class="">
            <div class="text-sm py-2 text-accent-600">Click a tag below to add it to the expression.
                Click an operator above to insert it into the expression. Click an item to remove it from the expression.
                When done, click the 'Apply Query' button below.
            </div>
            <ul class="max-w-full h-56 max-h-56 overflow-scroll p-3 border border-accent-600 rounded-md bg-white">
                @foreach($searchItems as $searchItem)
                    <li class="text-left px-1 py-2 list-none border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 hover:cursor-pointer rounded-md"
                        wire:click="addSearchItem('{{ $searchItem }}')"
                    >{{ $searchItem }}</li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-start mt-2">
            <button wire:click="applyQuery"
                    @if ($expressionValid === true && $queryError === false && count($expressionItems) > 0)
                        class="cursor-pointer font-medium px-2 py-2 text-center text-white text-sm rounded bg-accent-600 hover:bg-accent-400"
                    @else
                        class="cursor-not-allowed inline-block font-medium px-2 py-2 text-center text-white text-sm rounded bg-accent-400"
                @endif
            >
                Apply Query
            </button>
        </div>
    </div>
@else
    <div class="mt-4 flex w-full">
        <div class="">
            <ul class="max-w-40 h-56 max-h-56 overflow-scroll p-3 border border-accent-600 rounded-md bg-white">
                @foreach($searchItems as $searchItem)
                    <li class="text-left px-1 py-2 list-none border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 hover:cursor-pointer rounded-md"
                        wire:click="addSearchItem('{{ $searchItem }}')"
                    >{{ $searchItem }}</li>
                @endforeach
            </ul>
            <div class="text-sm py-2 text-accent-600">Click a tag to add it to the expression</div>
        </div>
        <div class="">
            <div
                class="ml-10 h-16 flex items-center w-80 max-w-80 py-2 border border-accent-600 rounded-md bg-white">
                @foreach($operators as $operator)
                    <div
                        class="p-2 text-center border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 rounded-md mx-3 hover:cursor-pointer"
                        wire:click="addOperator('{{ $operator }}')"
                    >{{ $operator }}</div>
                @endforeach
            </div>
            <div class="text-sm ml-10 py-2 text-accent-600">Click an operator to insert it into the expression<br>
                <a class="hover:underline" href="https://chortle.ccsu.edu/java5/Notes/chap40/ch40_16.html"
                   target="_blank">Click here for information on boolean operator precedence</a>
            </div>
            <div
                @if(($expressionValid === true && $queryError === false) || count($expressionItems) == 0)
                    class="mt-10 ml-10 h-16 w-120 min-w-120 justify-start flex items-center py-2 border border-accent-600 rounded-md bg-white"
                @else
                    class="mt-10 ml-10 h-16 w-120 min-w-120 justify-start flex items-center py-2 border-2 border-red-500 rounded-md bg-white"
                @endif
            >
                @foreach($expressionItems as $index => $expressionItem)
                    <div
                        class="p-2 border hover:border-accent-600 w-full hover:text-white hover:bg-accent-600 rounded-md mx-1 hover:cursor-pointer whitespace-nowrap"
                        wire:click="removeExpressionItem('{{ $index }}')"
                    >{{ $expressionItem }}</div>
                @endforeach
                @if(count($expressionItems) > 0)
                    <i wire:click="clearExpression" title="clear"
                       class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 px-2 pb-2 pt-1 text-xl"></i>
                @endif
            </div>
            <div class="ml-10 text-sm py-2 text-accent-600">Click an item to remove it from the expression</div>
            @if ($queryErrorMessage)
                <div class="mt-1 ml-10 text-red-500 font-bold bg-white w-full h-4">{{ $queryErrorMessage }}</div>
            @endif
        </div>
        <div class="flex justify-start items-end ml-10 mb-10">
            <button wire:click="applyQuery"
                    @if ($expressionValid === true && $queryError === false && count($expressionItems) > 0)
                        class="mt-4 cursor-pointer  font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                    @else
                        class="cursor-not-allowed inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400"
                @endif
            >
                Apply Query
            </button>
        </div>
    </div>
@endif

