import Vue from 'vue'

if (document.getElementById('cartApp')){
    Vue.component('cart-item-quantity', {
        template: `
            <div class="product-counter ml-lg-4">
            <button type="button" :disabled="data_quantity <= data_min"
                    @click="changeQuantity(-data_step)"><i class="fa fa-minus"></i></button>
            <input type="text" :id="'cart_item_'+id" class="form-control text-center text-bold" :value="data_quantity+unit"/>
            <button type="button"  :disabled="data_quantity >= data_max"
                    @click="changeQuantity(data_step)"><i class="fa fa-plus"></i></button>
            </div>
    `,
        props: {
            unit: {
                type: String,
                default: ''
            },
            quantity: {
                default: undefined
            },
            step: {
                default: '1'
            },
            min: {
                default: '1'
            },
            max: {
                default: '1'
            },
            id: {
                required: true
            },
            update: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                data_quantity: this.getDataQuantity(),
                data_step: parseFloat(this.step),
                data_min: parseFloat(this.min),
                data_max: parseFloat(this.max),
            }
        },
        methods: {
            changeQuantity(addition) {
                this.data_quantity += addition;
                this.$emit('quantityChange', {
                    quantity: this.data_quantity,
                    id: this.id
                })
            },
            resetQuantity() {
                this.data_quantity = parseFloat(this.quantity)
            },
            getDataQuantity() {
                let quantity = 0
                if (!this.quantity) {
                    quantity =  parseFloat(this.min)
                }else {
                    quantity = parseFloat(this.quantity)
                }
                return quantity ? quantity : 1
            }
        },
        watch: {
            update: function () {
                this.resetQuantity()
            }
        }
    })

    Vue.component('cart-grid', {
        props: ['cart_items', 'checkout_link'],
        data() {
            return {
                items: JSON.parse(this.cart_items),
                locale: window.locale,
                total: '',
                resetItems: false
            }
        },
        mounted() {
            this.getTotal()
        },
        methods: {
            image(item) {
                let media = item.model.product.media
                return media.length > 0 ? media[0] : ''
            },
            unit(item) {
                let unit = item.model.product.unit
                return unit ? unit.name[this.locale] : ''
            },
            async getTotal() {
                this.total = await axios.post('/api/cart/total').then(response => response.data)
            },
            onQuantityChange(data) {
                data['item'] = data['id']
                axios.post('/api/cart/quantity', data).then(response => {
                    this.total = response.data
                    this.items[this.items.findIndex(item => item.model_id == data['id'])].quantity = data['quantity']
                }).catch(err => {
                    this.resetItems = !this.resetItems
                    handleValidationError(err)
                })
            },
            onDeleteItem(id) {
                axios.post('/api/cart/delete', {id}).then(response => {
                    this.total = response.data
                    this.items = this.items.filter(item => item.model_id != id)
                    setCartNumber(this.total_items)
                }).catch(err => {
                    handleValidationError(err)
                })
            }
        },
        computed: {
          total_items() {
              let total = 0
              this.items.map(item => {
                  total += item.quantity
              })
              return total
          }
        },
        template: `
          <div>
          <div class="row">
              <div class="col order-first">
                  <div class="section-title">
                      <h3 class="toshiba-title text-bold no-margin mbmd">Shopping cart</h3>
                      <hr class="no-margin mtlg mblg t-line">
                  </div>
              </div>
              <div class="col order-last text-right">
                  <div class="cart-items mtsm">You have <span>{{ total_items }} </span> items in your cart</div>
              </div>
          </div>
          <div class="cart-items">
              <div class="row">
                  <div class="col-lg-12 col-md-6" v-for="item in items">
                      <div class="boxed mtlg">
                          <div class="cart-item">
                              <a href="" class="product-image-bg d-block mr-lg-4">
                                  <div class="product-img">
                                      <img :src="image(item)" alt="">
                                  </div>
                              </a>
                              <div class="product-info">
                                  <div class="toshiba-tag">
                                      <hr class="no-margin mtlg mblg t-line">
                                      <span class="d-inline-block mlmd text-bold text-uppercase text-brand">{{item.model.product.sku}}</span>
                                  </div>
                                  <a :href="'/product/'+item.model.slug">
                                      <h3 class="no-margin mtsm">{{ item.model.product.name[locale] }} </h3>
                                  </a>
                              </div>
                              <cart-item-quantity
                                  :id="item.model.id"
                                  :step="item.model.step"
                                  :unit="unit(item)"
                                  :min="item.model.min_quantity"
                                  :max="item.model.max_quantity"
                                  :quantity="item.quantity"
                                  :update="resetItems"
                                  @quantityChange="onQuantityChange"
                              ></cart-item-quantity>
                              <div class="product-footer ml-lg-4">
                                  <div class="price">{{ item.model.price }} EGP</div>
                                  <div class="cta">
                                      <button class="favorites mt-2"><i class="far fa-heart mrsm"></i>Add to favorites</button>
                                      <button @click="onDeleteItem(item.model.id)" class="favorites remove mt-2"><i class="far fa-trash-alt mrsm"></i>Remove</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>

          </div>
          <div class="row mt-4">
              <div class="col-lg-5 offset-lg-7 col-md-6">
                  <div class="subtotal">
                      <div class="d-flex justify-content-between">
                          <div class="order-sub">
                              <div class="sub text-bold">Order subtotal:</div>
                              <div class="items-no">{{ total_items }} items</div>
                          </div>
                          <div class="price order-last">{{ total }} EGP</div>
                      </div>
                  </div>
                  <a :href="checkout_link" class="btn text-capitalize d-block mt-4">checkout</a>
              </div>
          </div>
          </div>
    `
    })

    const cartApp = new Vue({
        el: '#cartApp',
    })
}
window.addToCart = (item, quantity = 1) => {
    axios.post('/api/cart', {
        item,
        quantity
    }).then((response) => {
        toastr.success(response.data.message)
        setCartNumber(response.data.count)
    }).catch(err => {
        handleValidationError(err)
    })
}

function setCartNumber(number) {
    $(".cart-number").text(number)
}

$("#city_id").change(function () {
    axios.post('/api/lookup/areas', {
        city_id: $(this).val()
    }).then((response) => {
        let options = ''
        for (let id in response.data) {
            options += `<option value="${id}">${response.data[id]}</option>`
        }
        $("#area_id").html(options)
    })
});

function handleValidationError(err) {
    const errors = err.response.data.errors
    for (let error in err.response.data.errors) {
        for (let message of errors[error]) {
            toastr.error(message)
        }
    }
}
