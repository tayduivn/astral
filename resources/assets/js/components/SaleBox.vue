<template>
  <div class="item">
    <div class="content">
      <!-- Header-->
      <div class="sale box header">
        <sui-dropdown
          class="icon small black"
          icon="ellipsis vertical"
          button
          pointing
          floating
        >
          <sui-dropdown-menu>
            <sui-dropdown-item
              @click="$router.push({ name: 'show', params: { id: sale.id } })"
            >
              <sui-icon name="eye"></sui-icon>
              View
            </sui-dropdown-item>
            <sui-dropdown-item
              @click="$router.push({ name: 'edit', params: { id: sale.id } })"
            >
              <sui-icon name="edit"></sui-icon>
              Edit
            </sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        Sale #{{ sale.id }}
        <div class="ui red label" v-if="sale.refund == true">
          <i class="reply icon"></i>
          refund
        </div>
        <div :class="getSaleLabelColor(sale.status)">
          <i :class="getSaleIcon(sale.status)"></i>
          {{ sale.status }}
        </div>
        <div class="ui label">
          $ {{ parseFloat(sale.total).toFixed(2) }}
          <div class="detail">total</div>
        </div>
        <div class="ui label">
          $ {{ paid }}
          <div class="detail">paid</div>
        </div>
        <div class="ui label">
          $ {{ balance }}
          <div class="detail">balance</div>
        </div>
        <div class="ui top right attached basic label">
          <i class="user circle icon"></i>
          {{ sale.customer.id == 1 ? 'System' : `${sale.customer.firstname} ${sale.customer.lastname}` }}
          <span v-if="sale.customer.role.id != 1"
            >({{ sale.customer.role.name }})</span
          >
          <div class="detail" v-if="sale.organization.id != 1">
            <i class="university icon"></i>{{ sale.organization.name }}
          </div>
        </div>
      </div>
      <!-- Meta -->
      <div class="meta">
        <i class="user circle icon"></i>
        {{ sale.creator.id == 1 ? 'System' : `${sale.creator.firstname}` }} |
        <i class="pencil icon"></i>
        {{ format(new Date(sale.created_at), $dateFormat.long) }}
        ({{
          distanceInWords(new Date(), new Date(sale.created_at), {
            addSuffix: true
          })
        }})
        <span v-if="sale.updated_at != sale.created_at">
          | <i class="edit icon"></i>
          {{ format(new Date(sale.updated_at), $dateFormat.long) }}
          ({{
            distanceInWords(new Date(), new Date(sale.updated_at), {
              addSuffix: true
            })
          }})
        </span>
        <span v-if="sale.memos && sale.memos.length > 0">
          | <i class="comment alternate icon"></i> {{ sale.memos.length }}
        </span>
      </div>

      <div class="ui two column grid" v-if="sale.events.length > 0">
        <div class="column" v-for="event in sale.events" :key="event.id">
          <div class="ui items">
            <div class="item">
              <div class="ui tiny image">
                <img src="/astral-logo-dark.png" v-if="event.show_id == 1" />
                <img :src="event.show.cover" :alt=" event.show.id == 1 ? event.memo : event.show.name" v-else />
              </div>
              <div class="content">
                <div class="meta">
                  <div
                    v-if="event.show_id != 1"
                    class="ui label"
                    style="border: white 1px solid; background-color: transparent; color: white;"
                  >
                    {{ event.show.type }}
                  </div>
                  <div
                    class="ui event-type label"
                    :style="{
                      color: 'white',
                      backgroundColor: event.type.color,
                      border: 'white 1px solid'
                    }"
                  >
                    {{ event.type.name }}
                  </div>
                </div>
                <div class="header">{{ event.show.id == 1 ? event.memo : event.show.name }}</div>
                <div class="meta">
                  {{ format(new Date(event.start), $dateFormat.long) }}
                  ({{
                    distanceInWords(new Date(), new Date(event.start), {
                      addSuffix: true
                    })
                  }})
                </div>
                <div class="meta">
                  <div
                    class="ui label"
                    v-for="product in products"
                    :key="product.id"
                    style="border-color: white; background-color: transparent; color: white; border-width: 1px"
                  >
                    <i class="box icon"></i>{{ product.name }}
                    <div class="detail">
                      {{ product.quantity }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import axios from 'axios'

  export default {
    props: ['sale'],

    data: () => ({
      products: []
    }),

    async created() {
      await this.fetchProducts()
    },

    methods: {
      async fetchProducts() {
        try {
          const response = await axios.get(`/api/sale/${this.sale.id}`)
          this.products = response.data.products
        } catch (error) {
          alert(`Unable to fetch products: ${error.message}`)
        }
      }
    },

    computed: {
      ...mapGetters(['currencySettings']),

      paid() {
        let paid = this.sale.payments.reduce(
          (total, current) => total + parseFloat(current.tendered),
          0
        )
        let change_due = this.sale.payments.reduce(
          (total, current) => total + parseFloat(current.change_due),
          0
        )
        return (paid - change_due).toLocaleString(
          'en-US',
          this.currencySettings
        )
      },

      balance() {
        let balance = parseFloat(this.sale.total) - parseFloat(this.paid)
        return balance.toLocaleString('en-US', this.currencySettings)
      }
    }
  }
</script>

<style scoped>
  .ui.small.black.button {
    background-color: transparent;
  }
</style>
