import Vue from 'vue'

if (document.getElementById('paymentApp')) {
    Vue.component('payment-confirmation', {
        template: `
            <div class="confirm-loader align-items-center justify-content-center">
                <div class="text-center mb-5" v-if="status === 'pending'">
                    <div class="fa-3x">
                        <i class="fas fa-spinner fa-pulse"></i>
                    </div>
                    <h3>Confirming Payment</h3>
                </div>
                <div class="text-center mb-5" v-else-if="status === 'success'">
                    <div class="fa-3x text-success">
                        <i class="fas fa-check"></i>
                    </div>
                    <h3 class="text-success">Payment Success</h3>
                    <div class="mt-4">
                        <a class="btn btn-primary mr-3" href="/">Homepage</a>
                        <a class="btn btn-secondary mr-3" href="/orders">My orders</a>
                    </div>
                </div>
                <div class="text-center mb-5" v-else-if="status === 'failed'">
                    <div class="fa-3x text-danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <h3 class="text-danger">Payment Failed</h3>
                    <div class="mt-4">
                        <a class="btn btn-primary" href="/checkout">Try another payment method</a>
                    </div>
                </div>
            </div>
        `,
        props: {
            reference_number : {
                required: true,
                type: String
            }
        },
        data() {
          return {
              status: 'pending'
          }
        },
        mounted() {
            setInterval(() => this.checkStatus(), 2000)
        },
        methods: {
            checkStatus()
            {
                if (this.status === 'pending') {
                    axios.post('/billing/check', {
                        merchant_reference: this.reference_number
                    }).then((response) => {
                        this.status = response.data
                    })
                }
            }
        }
    })
    const paymentApp = new Vue({
        el: '#paymentApp',
    })
}
