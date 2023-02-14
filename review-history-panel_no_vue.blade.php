@props(['application', 'reviewEntries'])

<div class="w-full bg-white rounded-3xl block p-6 shadow box-border overflow-x-scroll">
    <div class="w-full text-xl font-bold text-gray-900 border-b-2 border-gray-200 pt-4 mb-4">Admin History
    </div>

    @if ($reviewEntries && count($reviewEntries))
        @foreach ($reviewEntries as $entry)
            @if ($loop->last)
                <div class="grid grid-cols-6 w-full pt-1 pb-4">
                    @else
                        <div class="grid grid-cols-6 w-full border-b-2 border-gray-200 pt-1 pb-4">
                            @endif
                            <x-admin.review-entry :entry="$entry"/>
                        </div>
                        @endforeach
                        @else
                            <div class="w-full">No entries yet</div>
                        @endif

                        <div class="w-full">
                            <div class="w-full text-xl font-bold text-gray-900 border-b-2 border-gray-200 mb-6">Admin Actions
                            </div>

                            <div class="py-4">
                                <select name="" id=""
                                        class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400">
                                    <option value="">Select an action ...</option>
                                    <option value="">Set checked status</option>
                                    <option value="">Propose a status</option>
                                    <option value="">Add a note</option>
                                    <option value="">Set the final status</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 w-full">
                                <div class="text-base font-bold text-gray-900 py-4">Set checked state:</div>
                                <div class="py-4">
                                    <input type="checkbox" value="" checked class="text-green-600 h-5 w-5">
                                </div>

                                <div class="text-base font-bold text-gray-900 py-4">Enter a note:</div>
                                <div class="py-4">
                                    <textarea name="note" rows="4" cols="30"
                                        class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                                </div>

                                <div class="text-base font-bold text-gray-900 py-4">Propose an action:</div>
                                <div class="py-4">
                                    <select name="" id=""
                                            class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400">
                                        <option value="">Select ...</option>
                                        <option value="">Accept</option>
                                        <option value="">Reject</option>
                                        <option value="">Alternative</option>
                                    </select>
                                </div>

                                <div class="text-base font-bold text-gray-900 py-4">Set status:</div>
                                <div class="py-4">
                                    <select name="" id=""
                                            class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400">
                                        <option value="">Choose a status ...</option>
                                        <option value="">Pending</option>
                                        <option value="">Accepted</option>
                                        <option value="">Rejected</option>
                                    </select>
                                </div>

                                <div class=""></div>
                                <div class="py-4">
                                    <a class="inline-block font-medium px-6 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                                       href=""
                                       role="button">
                                        Save your input
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
