<template>
    <div class="w-full pb-4" v-if="!busy">
        <div class="py-1" v-if="action.length===0">
            <select v-model="action"
                    class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400 cursor-default"
            >
                <option v-for="action in allowedActions" :value="action.value">{{ action.text }}</option>
            </select>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
            <template v-if="action==='checked_set'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Set application checked state:</div>
                <div class="py-1 md:py-4">
                    <input type="checkbox" v-model="checked_value" class="text-emerald-600 h-5 w-5">
                </div>
                <div class="text-base font-bold text-gray-900 py-1 md:py-4">Enter a note:</div>
                <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                </div>
            </template>

            <template v-if="action==='id_checked'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Set ID checked state:</div>
                <div class="py-1 md:py-4">
                    <input type="checkbox" v-model="id_checked_value" class="text-emerald-600 h-5 w-5">
                </div>
                <div class="text-base font-bold text-gray-900 py-1 md:py-4">Enter a note:</div>
                <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                </div>
            </template>

            <template v-if="action==='proposed'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Propose an action:</div>
                <div class="py-1 md:py-4">
                    <select v-model="proposed_value"
                            class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400">
                        <option value="">Select ...</option>
                        <option value="accept">Accept</option>
                        <option value="accept_conditionally">Accept Conditionally</option>
                        <option value="defer">Defer</option>
                        <option value="decline">Decline</option>
                        <option value="alternative">Alternative</option>
                        <option value="withdraw">Withdraw</option>
                    </select>
                </div>
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Enter a note:</div>
                <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                </div>
            </template>

            <template v-if="action==='status_set'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Set status:</div>
                <div class="py-1 md:py-4">
                    <select v-model="status_value"
                            class="rounded text-center text-white text-base bg-accent-600 hover:bg-accent-400">
                        <option value="">Choose a status ...</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="accepted_conditionally">Accepted Conditionally</option>
                        <option value="deferred">Deferred</option>
                        <option value="declined">Declined</option>
                        <option value="withdrawn">Application Withdrawn</option>
                    </select>
                </div>
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Enter a note:</div>
                <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                </div>
            </template>

            <template v-if="action==='add_note'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Enter a note:</div>
                <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                </div>
            </template>

            <template v-if="action==='duplicated'">
                <div class="py-1 md:py-2">
                    <span class="text-base font-bold text-gray-900">Duplicate this Application:</span><br>
                    <span class="text-sm font-bold text-red-600">Please be sure you want to go ahead</span>
                </div>
                <div class="block">
                    <div class="text-base font-bold text-gray-900 py-1 md:py-2">Enter a note:</div>
                    <div class="py-1 md:py-4">
                    <textarea v-model="note" rows="2" cols="30"
                              class="w-full bg-gray-50 rounded focus:text-gray-900 focus:bg-white focus:border-accent-600 focus:outline-none"></textarea>
                    </div>
                </div>
            </template>

            <template v-if="action.length > 0 && action !== 'send_contract'">
                <div class=""></div>
                <div class="py-1 md:py-4">
                    <button v-if="entryValid" @click="addEntry"
                            class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400">
                        Save your input
                    </button>
                    <button v-else disabled="disabled"
                            class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-400 cursor-not-allowed">
                        Save your input
                    </button>

                    <button
                        class="ml-4 inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                        @click="resetValues">
                        Cancel
                    </button>
                </div>
            </template>
            <template v-if="action==='send_contract'">
                <div class="text-base font-bold text-gray-900 py-1 md:py-2">Send a contract to the student ...</div>
                <div class="py-1">
                    <button @click="sendContract"
                            class="inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                            style="width: 90px!important; min-width: 90px !important;"
                    >
                        Send
                    </button>
                    <button
                        class="ml-4 inline-block font-medium px-2 py-2 text-center text-white text-base rounded bg-accent-600 hover:bg-accent-400"
                        @click="resetValues">
                        Cancel
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReviewAdminActions",
    props: {
        busy: {
            type: Boolean,
            required: true
        },
        status: {
            type: String,
            required: true
        },
        checked: {
            type: Boolean,
            required: true
        },
        idChecked: {
            type: Boolean,
            required: true
        },
        contractSent: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            action: '',
            // initialise to values supplied as props
            initialCheckedValue: this.checked,
            initialIdCheckedValue: this.idChecked,
            initialStatusValue: this.status,
            checked_value: this.checked,
            id_checked_value: this.idChecked,
            status_value: this.status,
            proposed_value: '',
            note: '',
            action_value: ''
        }
    },
    emits: ['entryAdded', 'sendContract'],
    methods: {
        addEntry() {
            if (this.action === 'checked_set') {
                this.action_value = this.checked_value === true ? 'true' : 'false';
            } else if (this.action === 'id_checked') {
                this.action_value = this.id_checked_value === true ? 'true' : 'false';
            } else if (this.action === 'status_set') {
                this.action_value = this.status_value;
                this.initialCheckedValue = true;
                this.checked_value = true;
            } else if (this.action === 'proposed') {
                this.action_value = this.proposed_value
            } else if (this.action === 'add_note') {
                this.action_value = 'note';
            } else if (this.action === 'duplicated') {
                this.action_value = 'true';
            }
            let entry = {
                action: this.action,
                action_value: this.action_value,
                note: this.note
            }
            this.$emit('entryAdded', entry);
            this.resetValues();
        },
        sendContract() {
            this.$emit('sendContract');
            this.resetValues();
        },
        resetValues() {
            this.action = '';
            this.action_value = '';
            this.proposed_value = '';
            this.note = '';
            this.initialCheckedValue = this.checked_value;
            this.initialIdCheckedValue = this.id_checked_value;
            this.initialStatusValue = this.status_value;
        },
        cancel() {
            this.clearValues();
        }
    },
    computed: {
        entryValid() {
            let valid = false;
            if (this.action === 'checked_set') {
                valid = this.initialCheckedValue !== this.checked_value
            } else if (this.action === 'id_checked') {
                valid = this.initialIdCheckedValue !== this.id_checked_value
            }  else if (this.action === 'status_set') {
                valid = this.initialStatusValue !== this.status_value
            } else if (this.action === 'proposed') {
                valid = this.proposed_value.length > 0
            } else if (this.action === 'add_note') {
                valid = this.note.length > 0
            } else if (this.action === 'duplicated') {
                valid = true
            }
            return valid;
        },
        allowedActions() {
            let actions = [
                {
                    text: 'Select an action ...',
                    value: ''
                },
                {
                    text: 'Set application checked',
                    value: 'checked_set'
                },
                {
                    text: 'Set ID checked',
                    value: 'id_checked'
                },
                {
                    text: 'Propose an action',
                    value: 'proposed'
                },
                {
                    text: 'Add a note',
                    value: 'add_note'
                },
                {
                    text: 'Set the application status',
                    value: 'status_set'
                },
                {
                    text: 'Duplicate the application',
                    value: 'duplicated'
                }
            ]
            if (this.contractSent) {
                actions.push({
                    text: 'Send new contract',
                    value: 'send_contract'
                })
            } else {
                actions.push({
                    text: 'Send contract',
                    value: 'send_contract'
                })
            }
            return actions;
        }
    }
}
</script>

<style scoped>

</style>
