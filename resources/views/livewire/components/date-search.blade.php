@push('scripts')
    <script>
        var picker = new Pikaday({
            field: document.getElementById('myDate' + '{{$whichDate}}_{{$ident}}'),
            trigger: document.getElementById('openDate' + '{{$whichDate}}_{{$ident}}'),
            format: 'D MMM YYYY',
            defaultDate: new Date(),
            onSelect: function() {
                var displayDate = this.getDate().toDateString();
                var theDate = toIsoString(this.getDate()).substring(0,10);
                @this.set('displayDate', displayDate);
                @this.set('theDate', theDate);
            }
        });

        // https://stackoverflow.com/questions/17415579/how-to-iso-8601-format-a-date-with-timezone-offset-in-javascript
        function toIsoString(date) {
            var tzo = -date.getTimezoneOffset(),
                dif = tzo >= 0 ? '+' : '-',
                pad = function(num) {
                    return (num < 10 ? '0' : '') + num;
                };

            return date.getFullYear() +
                '-' + pad(date.getMonth() + 1) +
                '-' + pad(date.getDate()) +
                'T' + pad(date.getHours()) +
                ':' + pad(date.getMinutes()) +
                ':' + pad(date.getSeconds()) +
                dif + pad(Math.floor(Math.abs(tzo) / 60)) +
                ':' + pad(Math.abs(tzo) % 60);
        }
    </script>
@endpush

<div  class="flex relative {{$classes?? ''}}" title="{{ $placeholder ?? '' }}">
    <div wire:ignore>
        <input wire:model="displayDate"
               placeholder="{{ $placeholder ?? 'No date selected' }}"
               class="w-full border-t border-b border-l border-accent-600 focus:outline-none p-2 rounded-l-md focus:bg-white focus:border-accent-400 focus:outline-none"
               style="width: 145px !important;"
               name="my_date"
               id="myDate{{$whichDate}}_{{$ident}}"
        />
        <input type="hidden" wire:model="theDate" />
    </div>

        @if(empty($displayDate))
            <i class="cursor-pointer fa-regular fa-calendar-days text-accent-600  hover:text-accent-400 px-2 text-3xl border border-accent-600 hover:border-accent-400 rounded-r-md" id="openDate{{$whichDate}}_{{$ident}}"  title="Select a date"></i>
        @else
            <i class="cursor-pointer hidden fa-regular fa-calendar-days text-accent-600  hover:text-accent-400 px-2 text-3xl border border-accent-600 hover:border-accent-400 rounded-r-md" id="openDate{{$whichDate}}_{{$ident}}"  title="Select a date"></i>
            <i id="clearDate" title="clear" wire:click="clear" class="cursor-pointer fa-regular fa-xmark text-accent-600 hover:text-accent-400 px-3 pt-1 text-xl border border-accent-600 hover:border-accent-400 rounded-r-md"></i>
        @endif

</div>

