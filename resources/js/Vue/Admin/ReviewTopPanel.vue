<template>
    <div class="hidden lg:block w-full bg-white rounded-3xl p-6 shadow">
        <div
            class="grid grid-cols-4 w-full"
        >
            <div class="flex col-span-2">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Student</span>
                </div>
                <div class="pb-4">
                    {{ application.userFullName }}
                </div>
            </div>

            <div class="flex">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Application Checked</span>
                </div>
                <div class="">
                    <font-awesome-icon v-if="application.checked" icon="fas fa-check-square"
                                       class="text-emerald-600 h-5 w-5"/>
                    <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                       class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
                </div>

                <div class="ml-4 flex">
                    <div>
                        <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">ID Checked</span>
                    </div>
                    <div class="">
                        <font-awesome-icon v-if="application.idChecked" icon="fas fa-check-square"
                                           class="text-emerald-600 h-5 w-5"/>
                        <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                           class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
                    </div>
                </div>

            </div>

            <div class="flex">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Submitted</span>
                </div>
                <div>
                    {{ application.submitted }}
                </div>
            </div>

            <div class="flex col-span-2">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Course</span>
                </div>
                <div class="pb-4">
                    {{ application.courseGroupTitle }}
                </div>
            </div>

            <div class="flex">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Application Status</span>
                </div>
                <div class="">
                    <span class="px-3 bg-accent-200 font-bold" :style="{color: statusTextColor}">{{ application.statusText }}</span>
                </div>
            </div>

            <div class="flex">
                <div class="inline-block text-base font-bold text-gray-900 w-24 pb-4">Linked</div>
                <div>
                    <font-awesome-icon v-if="application.linked" icon="fas fa-check-square" class="text-emerald-600 h-5 w-5"/>
                    <a v-else class="cursor-pointer" :href="urlToLinkCourse" target="_blank" title="Link the application"><font-awesome-icon  icon="fa-solid fa-xmark " class="text-red-500 h-5 w-5 bg-gray-200"/></a>
                </div>
            </div>

            <div class="flex col-span-2">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Contract</span>
                </div>
                <div class="pb-4">
                    {{ contract.filename }}
                </div>
            </div>

            <div class="flex">
                <div>
                    <span class="inline-block text-base font-bold text-gray-900 pb-4 w-24">Contract Status</span>
                </div>
                <div class="">
                    <span class="px-3 bg-accent-200 capitalize font-bold" :style="{color: contract.statusTextColour}">{{ contract.status }}</span>
                    <br>
                    <span class="text-sm">{{ contract.updated}}</span>
                    <br>
                    <span v-if="contractsSent > 1" class="text-xs">(Contract {{ contractsSent }})</span>
                </div>
            </div>

            <div class="flex items-center">
                <template  v-if="contract.status === 'Sent' || contract.status === 'Viewed' ">
                    <button type="button" name="getLinkBtn"  @click="getLink"
                            class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                            style="width: 90px!important; min-width: 90px !important;"
                            :disabled="fetchingLink"
                             title="Save link to your clipboard"
                    >
                        Get Link
                    </button>
                    <span class="text-xs ml-2">Save link to your clipboard</span>
                </template>
                <button  v-else-if="contract.status === 'Signed'" type="button" name="downloadBtn" @click="downloadContract"
                         class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                         style="width: 90px!important; min-width: 90px !important;"
                         :disabled="downloadingContract"
                >
                    Download
                </button>
                <div v-else class="">

                </div>
            </div>
        </div>
    </div>

    <!-- tablet-->
    <div class="hidden md:block lg:hidden w-full lg:w-2/3 xl:-1/2 bg-white rounded-3xl p-6 shadow">

        <div
            class="grid grid-cols-7 w-full"
        >
            <div>
                <span class="inline-block text-base font-bold text-gray-900 pb-4">Student</span>
            </div>
            <div class="col-span-3 pb-4">
                {{ application.userFullName }}
            </div>

            <div class="pb-4">
                <span class="inline-block text-base font-bold text-gray-900">Application Checked</span>
                <font-awesome-icon v-if="application.checked" icon="fas fa-check-square"
                                   class="text-emerald-600 h-5 w-5"/>
                <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                   class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
            </div>
            <div class="col-span-2">
                <span class="inline-block text-base font-bold text-gray-900 w-full">ID Checked</span>
                <font-awesome-icon v-if="application.idChecked" icon="fas fa-check-square"
                                   class="text-emerald-600 h-5 w-5"/>
                <font-awesome-icon v-else icon="fa-solid fa-xmark"
                                   class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
            </div>

            <div>
                <span class="inline-block text-base font-bold text-gray-900  pb-4">Course</span>
            </div>
            <div class="col-span-3 pb-4">
                {{ application.courseGroupTitle }}
            </div>

            <div>
                <span class="inline-block text-base font-bold text-gray-900  pb-4">Application Status</span>
            </div>
            <div class="col-span-2">
                <span class="px-3 bg-accent-200 font-bold" :style="{color: statusTextColor}">{{
                        application.statusText
                    }}</span>
            </div>

            <div>
                <span class="inline-block text-base font-bold text-gray-900  pb-4">Submitted</span>
            </div>
            <div class="col-span-3">
                {{ application.submitted }}
            </div>

            <div>
                <span class="inline-block text-base font-bold text-gray-900  pb-4">Linked</span>
            </div>
            <div>
                <font-awesome-icon v-if="application.linked" icon="fas fa-check-square"
                                   class="text-emerald-600 h-5 w-5"/>
                <a v-else class="cursor-pointer" :href="urlToLinkCourse" target="_blank" title="Link the application">
                    <font-awesome-icon  icon="fa-solid fa-xmark " class="text-red-500 h-5 w-5 bg-gray-200"/>
                </a>
            </div>
            <div>
            </div>

            <div>
                <span class="inline-block text-base font-bold text-gray-900  pb-4">Contract</span>
            </div>
            <div class="pb-4">
                {{ contract.filename }}
            </div>
            <div class="col-span-2 pb-4 text-left" :style="{color: contract.statusTextColour}">
                {{ contract.status }}<br>
                <span class="text-sm">{{ contract.updated}}</span>
            </div>

            <div class="col-span-3">
                <template  v-if="contract.status === 'Sent' || contract.status === 'Viewed' ">
                    <button type="button" name="getLinkBtn"  @click="getLink"
                            class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                            style="width: 90px!important; min-width: 90px !important;"
                            :disabled="fetchingLink"
                            title="Save link to your clipboard"
                    >
                        Get Link
                    </button>
                    <span class="text-xs ml-2">Save link to your clipboard</span>
                </template>
                <button  v-else-if="contract.status === 'Signed'" type="button" name="downloadBtn" @click="downloadContract"
                         class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                         style="width: 90px!important; min-width: 90px !important;"
                         :disabled="downloadingContract"
                >
                    Download
                </button>
                <div v-else class="">

                </div>
            </div>
        </div>
    </div>
    <!-- mobile-->
    <div class="block md:hidden w-full bg-white rounded-3xl p-6 shadow">
        <div
            class="md:hidden grid grid-cols-2 w-full"
        >
            <div class="col-span-2 pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Student</span>
            </div>
            <div class="col-span-2 pb-3">
                {{ application.userFullName }}
            </div>

            <div class="col-span-2 pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Course</span>
            </div>
            <div class="pb-3 col-span-2">
                {{ application.courseGroupTitle }}
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Submitted</span>
            </div>
            <div class="pb-3">
                {{ application.submitted }}
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Application Checked</span>
            </div>
            <div class="pb-3">
                <font-awesome-icon v-if="application.checked===1" icon="fas fa-check-square"
                                   class="text-emerald-600 h-5 w-5"/>
                <font-awesome-icon v-else icon="fa-solid fa-xmark" class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">ID Checked</span>
            </div>
            <div class="pb-3">
                <font-awesome-icon v-if="application.idChecked===1" icon="fas fa-check-square"
                                   class="text-emerald-600 h-5 w-5"/>
                <font-awesome-icon v-else icon="fa-solid fa-xmark" class="flex text-red-600 h-5 w-5 h-5 w-5 mr-1 bg-gray-200"/>
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Application Status</span>
            </div>
            <div>
                <span class="px-3  bg-accent-200 font-bold font-bold" :style="{color: statusTextColor}">{{ application.statusText }}</span>
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Linked</span>
            </div>
            <div class="pb-3">
                <font-awesome-icon v-if="application.linked" icon="fas fa-check-square" class="text-emerald-600 h-5 w-5"/>
                <a v-else class="cursor-pointer" :href="urlToLinkCourse" target="_blank" title="Link the application">
                    <font-awesome-icon  icon="fa-solid fa-xmark " class="text-red-500 h-5 w-5 bg-gray-200"/>
                </a>
            </div>
            <div class="col-span-2 pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Contract</span>
            </div>
            <div class="pb-3 col-span-2">
                {{ contract.filename }}
            </div>

            <div class="pb-3">
                <span class="inline-block text-base font-bold text-gray-900">Contract Status</span>
            </div>
            <div>
                <span class="px-3 bg-accent-200 font-bold capitalize font-bold" :style="{color: contract.statusTextColour}">{{ contract.status }}</span>
                <br>
                <span class="text-sm">{{ contract.updated}}</span>
            </div>

            <div class="pb-3">
                <template  v-if="contract.status === 'Sent' || contract.status === 'Viewed' ">
                    <button type="button" name="getLinkBtn"  @click="getLink"
                            class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                            style="width: 90px!important; min-width: 90px !important;"
                            :disabled="fetchingLink"
                            title="Save link to your clipboard"
                    >
                        Get Link
                    </button>
                    <span class="text-xs ml-2">Save link to your clipboard</span>
                </template>
                <button  v-else-if="contract.status === 'Signed'" type="button" name="downloadBtn" @click="downloadContract"
                         class="h-9 max-h-9 text-white  text-sm rounded bg-gray-400 hover:font-bold hover:bg-accent-600"
                         style="width: 90px!important; min-width: 90px !important;"
                         :disabled="downloadingContract"
                >
                    Download
                </button>
                <div v-else class="">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import urlJoin from 'url-join';

export default {
    name: "ReviewTopPanel",
    props: {
        applicationDataJson: {
            type: String,
            required: true
        },
        contractDataJson: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            application: {},
            contract: {},
            contractsSent: null,
            fetchingLink: false,
            downloadingContract: false
        }
    },
    computed: {
        statusTextColor() {
            if (this.application.status === 'declined') {
                return 'red';
            } else if (this.application.status === 'accepted') {
                return 'green';
            } else if (this.application.status === 'accepted_conditionally') {
                return 'orange';
            } else if (this.application.status === 'deferred') {
                return 'orange';
            } else {
                return 'gray';
            }
        },
        urlToLinkCourse() {
            return urlJoin(process.env.MIX_VLE_URL, `admin/?studentimpersonationcourses=${this.application.userId}`);
        }
    },
    created() {
        this.application = JSON.parse(this.applicationDataJson);
        let contracts = JSON.parse(this.contractDataJson);
        this.contract = contracts['files'][0];
        this.contractsSent = contracts['files'].length;
    },
    mounted() {
        this.emitter.on('update-data', (data) => {
            this.application.checked = data.checked;
            this.application.idChecked = data.idChecked;
            this.application.statusText = data.statusText;
            this.application.status = data.status;
        });
        this.emitter.on('update-contract-data', (data) => {
            this.contract.filename = data.filename;
            this.contract.status = data.statusText;
            this.contract.statusTextColour = data.statusTextColour;
            this.contract.updated = data.updated;
            this.contract.pandadoc_file_id = data.id;
            this.contractsSent = this.contractsSent + 1;
        });
    },
    methods: {
        getLink() {
            const urlGetLink = urlJoin(process.env.MIX_APP_URL, `/pandadoc-service/getlink/${this.contract.pandadoc_file_id}`);
            axios.get(urlGetLink).then(response => {
                this.fetchingLink = true;
                if (response.status === 200) {
                    const link = response.data;
                    window.navigator.clipboard.writeText(link);
                    this.fetchingLink = false;
                } else {
                    console.log('error on fetching link', response.status)
                }
            }).catch(error => {
                console.log(error);
            })
            this.fetchingLink = false;
        },
        downloadContract() {
            const urlDownloadLink = urlJoin(process.env.MIX_APP_URL, `/pandadoc-service/download/${this.contract.pandadoc_file_id}`);
            window.open(urlDownloadLink, "_blank");
            this.downloadingContract = false;
        }
    }
}
</script>

<style scoped>

</style>
