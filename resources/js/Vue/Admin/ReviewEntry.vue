<template>
    <div class="w-full pt-1 pb-4" :class="borderClass" v-if="visible">
        <div class="grid grid-cols-6 w-full">
            <div class="col-span-4 text-base font-bold text-gray-900">{{ entry.admin_name }}</div>
            <div class="col-span-2">{{ entry.created_at }}</div>

            <!-- propose -->
            <template v-if="entry.action === 'proposed'">
                <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                <div class="col-span-2">
                    <span
                        class="px-1 font-bold bg-accent-200" :style="{ color: entry.bg_color }">{{
                            entry.action_text_short
                        }}
                    </span>
                    <span class="block text-gray-400 px-0 bg-none font-normal">proposed</span>
                </div>
                <template v-if="canDelete">
                    <div class="col-span-4"></div>
                    <div class="col-span-2">
                        <span class="inline-block px-0 py-2" @click="deleteEntry">
                            <font-awesome-icon icon="fa-solid fa-trash-can" class="text-red-600 h-5 w-5 bg-white cursor-pointer"
                                               title="Delete your entry"/>
                        </span>
                    </div>
                </template>
            </template>

            <!-- set application checked -->
            <template v-if="entry.action === 'checked_set'">
                <template v-if="entry.note">
                    <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                    <div class="col-span-2"></div>
                </template>
                <div
                    class="col-span-4 mt-2 py-2 text-base font-semibold">{{ entry.action_text }}
                </div>
                <div class="col-span-2 mt-2 py-2">
                    <font-awesome-icon v-if="entry.action_value === 'true'" icon="fas fa-check-square"
                                       class="text-emerald-600 h-5 w-5"/>
                    <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                       class="text-red-600 h-5 w-5 mr-1 bg-gray-200"/>
                </div>
            </template>

            <!-- set application checked -->
            <template v-if="entry.action === 'id_checked'">
                <template v-if="entry.note">
                    <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                    <div class="col-span-2"></div>
                </template>
                <div
                    class="col-span-4 mt-2 py-2 text-base font-semibold">{{ entry.action_text }}
                </div>
                <div class="col-span-2 mt-2 py-2">
                    <font-awesome-icon v-if="entry.action_value === 'true'" icon="fas fa-check-square"
                                       class="text-emerald-600 h-5 w-5"/>
                    <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                       class="text-red-600 h-5 w-5 mr-1 bg-gray-200"/>
                </div>
            </template>

            <!-- set status -->
            <template v-if="entry.action === 'status_set'">
                <template v-if="entry.note">
                    <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                    <div class="col-span-2"></div>
                </template>
                <div
                    class="col-span-4 mt-2 py-2 text-base font-semibold">{{ entry.action_text }}
                </div>
                <div class="col-span-2 mt-2 py-2" v-if="entry.action !== 'add_note'">
                    <span
                        class="px-1 font-bold bg-accent-200" :style="{ color: entry.bg_color }"> {{
                            entry.action_text_short
                        }}
                    </span>
                </div>
            </template>

            <!-- duplicated -->
            <template v-if="entry.action === 'duplicated'">
                <template v-if="entry.note">
                    <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                    <div class="col-span-2"></div>
                </template>
                <div
                    class="col-span-4 mt-2 py-2 text-base font-semibold" >{{ entry.action_text }}
                    <span v-if="entry.duplicated_to_application_id !==0">
                        <br><a :href="urlToDuplicate" target='_blank' class='cursor-pointer underline font-semibold text-accent-900 hover:text-accent-600'>Review Duplicate</a>
                    </span>
                </div>
                <div class="col-span-2 mt-2 py-2" v-if="entry.action !== 'add_note'">
                    <span
                        class="px-1 font-bold bg-accent-200" :style="{ color: entry.bg_color }"> {{
                            entry.action_text_short
                        }}
                    </span>
                </div>
            </template>

            <!-- add note -->
            <template v-if="entry.action === 'add_note'">
                <div class="col-span-4 text-sm md:text-base pr-3 pt-2">{{ entry.note }}</div>
                <template v-if="canDelete">
                    <div class="col-span-2">
                        <span class="inline-block px-0 py-2" @click="deleteEntry">
                            <font-awesome-icon icon="fa-solid fa-trash-can" class="text-red-600 h-5 w-5 bg-white cursor-pointer"
                                               title="Delete your entry"/>
                        </span>
                    </div>
                </template>
            </template>

            <template v-if="entry.action === 'contract_sent'">
                <div
                    class="col-span-4 mt-2 py-2 text-base font-semibold">{{ entry.action_text }}
                </div>
                <div class="col-span-2 mt-2 py-2" v-if="entry.action !== 'add_note'">
                    <span style="color: green"
                        class="px-1 font-bold bg-accent-200" > {{
                            entry.action_text_short
                        }}
                    </span>
                </div>
            </template>


        </div>
    </div>
</template>

<script>

import urlJoin from 'url-join';
export default {
    name: "ReviewEntry",
    props: {
        entry: {
            type: Object,
            required: true
        },
        last: {
            type: Boolean,
            required: true
        },
        adminUserId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            visible: true
        }
    },
    computed: {
        borderClass() {
            if (this.last) {
                return ""
            } else {
                return "border-b-2 border-gray-200"
            }
        },
        canDelete() {
            return this.entry.can_delete && this.adminUserId === this.entry.admin_user_id;
        },
        urlToDuplicate() {
            if (this.entry.duplicated_to_application_id !== 0) {
                return urlJoin(process.env.MIX_APP_URL, `/student/applications/admin/${this.entry.duplicated_to_application_id}`);
            }
        }
    },
    emits: ['entryDeleted'],
    methods: {
        deleteEntry() {
            this.visible = false;
            this.$emit('entryDeleted', this.entry.id);
        }
    }
}
</script>

<style scoped>

</style>
