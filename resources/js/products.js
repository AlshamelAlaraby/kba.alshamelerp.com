import {PaginationPlugin} from 'bootstrap-vue'
import {insertParam, removeParam, getUrlQueryParams} from './helpers'
import {renderFilterSlider} from './front'
import Vue from 'vue'
const queryString = require('query-string');

Vue.use(PaginationPlugin)

if (document.getElementById('productsApp')) {
    Vue.component('products-list', {
        template: `
            <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <aside class="category-side">
                            <div class="filter-head">
                                <div class="row">
                                    <div class="col order-first">
                                        <div class="filter-title">
                                            <img src="/assets/front/images/icons/filter.svg" alt=""
                                                 class="mrxs align-bottom">
                                            <span class="text-capitalize">filter</span>
                                        </div>
                                    </div>
                                    <div class="col order-last text-right">
                                        <a href="#" class="brand-link">Reset all</a>
                                    </div>
                                </div>
                            </div>
                            <form action="" class="filter">
                                <div class="filter-group mtxxlg">
                                    <div class="filter-group-title text-uppercase mblg">Brand</div>
                                    <div class="checkbox-custom" v-for="brand in filters_data.brands">
                                        <input
                                            type="checkbox"
                                            name="energyClass"
                                            :value="brand.id"
                                            :id="brand.name"
                                            v-model="filters.brand"
                                            class="form-checkbox pull-left">
                                        <label :for="brand.name"
                                               class="pull-left text-capitalize">{{ brand.name }}</label>
                                    </div>
                                </div>
                                <div class="filter-group mtxxlg">
                                    <div class="filter-group-title text-uppercase mblg">Price
                                    </div>
                                    <div id="range-slider"></div>
                                    <div class="range-data">
                                        <div class="row">
                                            <div class="col order-first text-left">
                                                <input type="text" name="capacity-min" class="sliderValue text-right"
                                                       ref="priceMinInput"
                                                       :value="minPrice"
                                                       data-index="0" disabled>
                                                <span>EGP</span>
                                            </div>
                                            <div class="col order-last text-right mrxs">
                                                <input type="text" name="capacity-max" class="sliderValue text-right"
                                                       ref="priceMaxInput"
                                                       :value="maxPrice"
                                                       data-index="1" disabled>
                                                <span>EGP</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-group mtxxlg" v-for="attribute in filters_data.attributes">
                                    <div class="filter-group-title text-uppercase mblg">{{ attribute.name }}</div>
                                    <div class="checkbox-custom" v-for="attribute_value in attribute.values">
                                        <input type="checkbox" :name="attribute.name" v-model="filters.attributes[attribute.id]" :value="attribute_value" :id="attribute_value"
                                               class="form-checkbox pull-left">
                                        <label :for="attribute_value" class="pull-left text-capitalize">{{ attribute_value }}</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button class="btn" type="button"
                                            @click="applyFilter()">Apply
                                    </button>
                                </div>
                            </form>
                        </aside>
                    </div>
                    <div class="col-sm-9">
                        <div class="products">
                            <div class="result mblg">
                                Showing <span> {{ items.meta.total }} </span>Results
                            </div>
                            <div class="row">
                                <div class="col-sm-4" v-for="item in items.data">
                                    <div class="product-card">
                                        <a href="#" class="product-image-bg d-block">
                                            <div class="product-img">
                                                <img :src="item.product.img" alt="">
                                            </div>
                                        </a>
                                        <div class="product-info mtlg">
                                            <div class="toshiba-tag">
                                                <hr class="no-margin mtlg mblg t-line">
                                                <span
                                                    class="d-inline-block mlmd text-bold text-uppercase text-brand">{{ item.product.brand.name }}</span>
                                            </div>
                                            <a href="#">
                                                <h3 class="no-margin mtsm">{{ item.product.name }}</h3>
                                            </a>
                                            <div class="price mtlg">{{ item.price }} EGP</div>
                                            <a @click="addToCart(item)" href="#" class="btn mtlg">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <b-pagination
                                        :total-rows="items.meta.total"
                                        :per-page="items.meta.per_page"
                                        first-text="First"
                                        prev-text="Prev"
                                        next-text="Next"
                                        last-text="Last"
                                        @change="onPageChange"
                                    ></b-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        `,
        props: {},
        data() {
            return {
                items: {
                    data: [],
                    meta: {}
                },
                filters: {
                    brand: [],
                    attributes: {}
                },
                filters_data: {
                    brands: [],
                    attributes: []
                },
                locale: window.locale
            }
        },
        mounted() {
            this.setDefaultFilters()
            this.getFiltersData((filters)=>this.fetchItems(filters))
        },
        methods: {
            fetchItems(filters = null) {
                axios.get(`/api/products/${this.category}`, {params: filters ? filters : this.filters}).then(response => {
                    this.items.data = response.data.data
                })
            },
            getFiltersData(callback = null)
            {
                axios.get(`/api/products/${this.category}/filters`).then(response => {
                    this.filters_data = response.data
                    let attributes = {}
                    response.data.attributes.map((attribute, index)=>{
                        attributes[attribute.id] = this.filters.attributes[index] ? this.filters.attributes[index].split(',') : []
                        delete this.filters.attributes[index]
                    })
                    this.filters.attributes = attributes
                    this.$nextTick(function () {
                        this.renderSlider()
                    })
                    if (callback) callback(this.filters)
                })
            },
            addToCart(item) {
                window.addToCart(item.id, item.min_quantity)
            },
            onPageChange(page) {
                this.pushToFilters('page', page)
                this.fetchItems()
                $("html, body").animate({scrollTop: 0}, "slow")
            },
            setDefaultFilters() {
                let params = queryString.parse(window.location.search, {arrayFormat: 'index'})
                this.filters = {...this.filters, ...params}
            },
            renderSlider() {
                renderFilterSlider(
                    this.filters_data.min_price,
                    this.filters_data.max_price,
                    this.minPrice,
                    this.maxPrice
                )
            },
            applyFilter() {
                this.pushToFilters('min_price', this.$refs.priceMinInput.value)
                this.pushToFilters('max_price', this.$refs.priceMaxInput.value)
                for (let key of Object.keys(this.filters)) {
                    if (Array.isArray(this.filters[key])) {
                        for (let value in this.filters[key]){
                            insertParam(`${key}[]`, this.filters[key][value])
                        }
                    }else if (typeof this.filters[key] === 'object'){
                        for (let attr_key of Object.keys(this.filters[key])){
                            insertParam(`${key}[${attr_key}]`, encodeURIComponent(this.filters[key][attr_key]))
                        }
                    }else {
                        insertParam(key, this.filters[key])
                    }
                }
                this.fetchItems()
            },
            pushToFilters(key, val) {
                this.filters[key] = val
            }
        },
        computed: {
            category() {
                let segments = window.location.href.split("/")
                return parseInt(segments[segments.length - 1])
            },
            maxPrice() {
                return this.filters.max_price ? this.filters.max_price : this.filters_data.max_price
            },
            minPrice() {
                return this.filters.min_price ? this.filters.min_price : this.filters_data.min_price
            }
        }
    })
    const productsApp = new Vue({
        el: '#productsApp',
    })
}
