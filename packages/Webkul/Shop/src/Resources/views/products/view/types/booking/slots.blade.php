<v-book-slots :bookingProduct = "{{ $bookingProduct }}" />

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-book-slots-template"
    >
        <div>
            <x-shop::form.control-group.label class="required">
                {{ $title  ?? trans('booking::app.shop.products.view.types.booking.slots.book-an-appointment') }}
            </x-shop::form.control-group.label>

            <div class="grid grid-cols-2 gap-x-4">
                <!-- Select Date -->
                <x-shop::form.control-group class="!mb-0">
                    <x-shop::form.control-group.label class="hidden">
                        @lang('booking::app.shop.products.view.types.booking.slots.date')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="date"
                        class="py-4"
                        name="booking[date]"
                        rules="required"
                        :label="trans('booking::app.shop.products.view.types.booking.slots.date')"
                        :placeholder="trans('YYYY-MM-DD')"
                        data-min-date="today"
                        @change="getAvailableSlots"
                    />

                    <x-shop::form.control-group.error control-name="booking[date]" />
                </x-shop::form.control-group>

                <!-- Select Slots -->
                <x-shop::form.control-group class="!mb-0">
                    <x-shop::form.control-group.label class="hidden">
                        @lang('booking::app.shop.products.view.types.booking.slots.title')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        class="py-4"
                        name="booking[slot]"
                        rules="required"
                        v-model="selectedSlot"
                        :label="trans('booking::app.shop.products.view.types.booking.slots.title')"
                        :placeholder="trans('booking::app.shop.products.view.types.booking.slots.title')"
                    >
                        <option value="">
                            @lang('booking::app.shop.products.view.types.booking.slots.select-slot')
                        </option>
                        
                        <option v-if="! slots?.length">
                            @lang('booking::app.shop.products.view.types.booking.slots.no-slots-available')
                        </option>

                        <option
                            v-for="slot in slots"
                            :value="slot.timestamp"
                            v-text="slot.from + ' - ' + slot.to"
                        >
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error control-name="booking[slot]" />
                </x-shop::form.control-group>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-book-slots', {
            template: '#v-book-slots-template',

            props: ['bookingProduct', 'title'],

            data() {
                return {
                    slots: [],

                    selectedSlot: '',
                }
            },

            methods: {
                getAvailableSlots(params) {
                    let date = params.target.value;

                    this.$axios.get(`{{ route('shop.booking-product.slots.index', '') }}/${this.bookingProduct.id}`, {
                        params: { date }
                    })
                        .then((response) => {
                            this.slots = response.data.data;

                            this.selectedSlot = '';
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                setErrors(error.response.data.errors);
                            }
                        });
                }
            }
        });

    </script>
@endpushOnce
