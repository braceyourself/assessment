@props(['store'])

<script>
    function data() {
        return {
            form_data: {
                interval: null,
                email: '{{Auth::user()->email}}',
                _token: '{{csrf_token()}}'
            },
            test: 'testing!',
            message: null,
            error_message: null,
            errors: null,
            journal_count: null,
            show_json: false,
            show_export_form: false,
            exported: false,
            // runs on component mount
            init() {
                this.clearForm()
            },

            // utility
            closeForm() {
                this.show_export_form = false;
            },

            clearForm() {
                this.form_data.interval = null;
                this.exported = false;
                this.clearMessages();
            },

            clearMessages() {
                this.message = null;
                this.error_message = null;
                this.errors = null;
            },

            // check if there are any journal entries for the selected interval
            selectInterval(store_id, interval) {
                this.error_message = null;

                axios.get(`/stores/${store_id}/journal?interval=${interval}`)
                    .then(res => {
                        this.journal_count = res.data.total;

                        if (this.journal_count === 0) {
                            this.error_message = "There are no records for this time period."
                        } else {
                            this.form_data.interval = interval;
                        }
                    })


            },

            // send the post request for starting the export
            sendExportRequest(store_id) {
                this.clearMessages()

                axios.post(`/stores/${store_id}/export`, this.form_data).then(res => {
                    this.message = res.data.message;
                    this.show_export_form = false;
                    this.exported = true;

                    setTimeout(() => this.clearMessages(), 3000);
                }).catch(err => {
                    this.error_message = err.response.data.message
                    this.errors = err.response.data.errors

                    setTimeout(() => this.clearMessages(), 10000);
                })

            },
            showExportButton() {
                return this.form_data.email !== null
                    && this.form_data.interval !== null
                    && this.exported === false
            }
        }
    };
</script>

<div class="border p-4 m-4 shadow sm:max-w-md overflow-hidden bg-blend-lighten flex-grow-0"
     style="border-top-color: {{$store->brand->color}}; border-top-width: 10px; max-width: 25rem; width: 25rem;"
     x-data="data()">

    <div style="
        top: -16px;
        background-color: {{$store->brand->color}};
        position: relative;
        max-width: 50px;
        text-align: center;
        color: white;
        margin: 0 auto;
    ">{{$store->number}}</div>

    <div class="flex flex-row justify-between">
        <div>
            <x-key-value label="Address:">
                <div class="pl-4">
                    <div>{{$store->address}}</div>
                    <div>{{$store->city}} {{$store->state}}, {{$store->zip_code}}</div>
                </div>
            </x-key-value>
            <x-key-value label="Revenue: " :value="'$'.number_format($store->total_revenue)"/>
            <x-key-value label="Food Cost:" :value="'$'.number_format($store->total_food_expense)"/>
            <x-key-value label="Labor Cost:" :value="'$'.number_format($store->total_labor_expense)"/>
            <x-key-value label="Net Profit" :value="'$'.number_format($store->net_profit)"/>
        </div>

{{--        store logo--}}
        <div style="
                padding-top: 7px;
                width: 45px;
                height: 45px;
                max-width: 45px;
                max-height: 45px;
                text-align: center;
                background-color: {{$store->brand->color}};
                color: white;
                border-radius: 25px;
                border: solid;
                font-family: system-ui;
                text-shadow: 1px 1px 4px black;
                top: -30px;
                position: relative;
                ">
            {{$store->brand->logo_text}}
        </div>
    </div>

    <hr class="m-4">

    {{--    Form response messages--}}
    <div class="flex justify-center" x-transition:enter="transition all">
        <div style="color: red"
             x-show="error_message"
             x-text="error_message"></div>

        <div x-show="message"
             x-text="message"></div>
    </div>

    <div>
        <x-button style="background-color: {{$store->brand->color}}" class="my-2 w-full justify-center"
                  x-show="show_export_form === false"
                  @click="show_export_form = true">
            Export Store Data
        </x-button>

        <div x-show="show_export_form">
            <div x-show="form_data.interval === null" class="flex flex-nowrap overflow-auto pt-4">
                @foreach(\App\Models\Journal::intervals() as $time_interval => $datetime)
                    <button class="border p-2"
                            @click="selectInterval('{{$store->id}}', '{{$time_interval}}')">
                        {{ strtoupper($time_interval) }}
                    </button>
                @endforeach
            </div>

            <div x-show="form_data.interval">
                <x-label value="Email"/>
                <x-input type="email"
                         name="email"
                         help="We'll send the export to this email address"
                         x-model:value="form_data.email"/>

                <div style="color: red"
                     x-show="errors.email"
                     x-text="errors.email"></div>
            </div>


            <div class="flex flex-row justify-between mt-2">
                <x-button x-show="showExportButton()"
                          @click="sendExportRequest('{{$store->id}}')"
                          style="background-color: {{$store->brand->color}}; border-collapse: {{$store->brand->color}}">
                    Export
                </x-button>
                <div x-show="showExportButton() === false"></div>

                <x-button x-show="show_export_form === true"
                          style="background-color: #a90202;"
                          @click="closeForm()">
                    <span x-show="!exported">Cancel</span>
                    <span x-show="exported">Close</span>
                </x-button>
            </div>

        </div>

    </div>


    {{--    <div x-show="show_export_form === false">--}}
    {{--        <x-button class="my-2 w-full justify-center" @click="show_json = !show_json">Show Json</x-button>--}}
    {{--        <div x-show="show_json" class="overflow-auto">--}}
    {{--            <hr class="m-4">--}}
    {{--            <pre lang="json">@json($store, JSON_PRETTY_PRINT)</pre>--}}
    {{--        </div>--}}
    {{--    </div>--}}

</div>