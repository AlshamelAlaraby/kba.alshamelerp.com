import Vue from 'vue'

Vue.component('voucher', {
    template: `
        <div>
        <div class="coupon">
            <div><strong>Have a coupon?</strong></div>
            <div class="coupon-input" v-if="!hasVoucher">
                <input type="text" v-model="voucher.code" class="form-control" placeholder="coupon code">
                <button type="button" class="coupon-submit" @click="applyVoucher()">Apply</button>
            </div>
            <div class="coupon-input" v-else>
                <input type="hidden" name="voucher_id" :value="voucher.id">
                <input type="text" :value="voucher.code" readonly class="form-control">
                <button type="button" class="btn btn-default" @click="removeVoucher()" ><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="checkout-info mt-4">
            <table class="table table-sm table-borderless">
                <tbody>
                <tr v-if="voucher.discount">
                    <td>Sub total:</td>
                    <td><span> {{ total }} EGP</span></td>
                </tr>
                <tr v-if="voucher.discount">
                    <td>Discount:</td>
                    <td><span class="text-danger">-{{ voucher.discount }} EGP</span></td>
                </tr>
                <tr>
                    <td>Total:</td>
                    <td><span class="text-primary">{{ total - voucher.discount }} EGP</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    `,
    props: ['total', 'current_voucher'],
    mounted() {
        this.voucher = this.voucherData
    },
    data() {
        return {
            voucher: {},
            hasVoucher: !!this.current_voucher
        }
    },
    methods: {
        applyVoucher() {
            axios.post('/api/voucher/check', {
                voucher: this.voucher.code
            }).then((response) => {
                this.hasVoucher = true
                this.voucher = response.data
            }).catch((err) => {
                toastr.error(err.response.data.message)
            })
        },
        removeVoucher() {
            this.hasVoucher = false
            this.voucher = this.voucherData
        },
    },
    computed: {
        voucherData()
        {
            return this.current_voucher ? JSON.parse(this.current_voucher) : {
                id: '',
                code: '',
                discount: 0,
            }
        }
    }
})

var voucherApp = new Vue({
    el: '#voucherApp'
})
