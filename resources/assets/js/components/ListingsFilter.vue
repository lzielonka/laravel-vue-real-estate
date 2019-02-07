<template>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Filter listings</div>
            <div class="panel-body">
                <form @submit="formSubmitted">
                    <div class="form-group">
                        <label for="city">Location</label>
                        <select class="form-control" v-model="selectedCityId" name="city" id="city">
                            <option :selected="selectedCityId === -1" value="-1">All</option>
                            <option v-for="city in cities" :selected="selectedCityId === city.id" v-bind:value="city.id">
                                {{ city.name }}, {{ city.country }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="developer">Developer</label>
                        <select class="form-control" v-model="selectedDeveloperId" name="developer" id="developer">
                            <option :selected="selectedDeveloperId === -1" value="-1">All</option>
                            <option v-for="developer in developers" :selected="selectedDeveloperId === developer.id" v-bind:value="developer.id">
                                {{ developer.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control" min="1" max="2147483648" v-model="price" name="price" placeholder="Price upper limit">
                    </div>
                    <div class="form-group">
                        <label for="isOnSale">Is on sale</label>
                        <select class="form-control" v-model="isOnSale" name="isOnSale" id="isOnSale">
                            <option value="-1" :selected="isOnSale === -1">All</option>
                            <option value="0" :selected="isOnSale === 0">No</option>
                            <option value="1" :selected="isOnSale === 1">Yes</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    <span v-on:click="resetFilters" class="btn btn-danger mb-2">Clear</span>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ListingsFilter',
    props: ['developers', 'cities'],
    computed: {},
    data() {
      return {
        selectedCityId: -1,
        selectedDeveloperId: -1,
        price: '',
        isOnSale: -1,
      };
    },
    methods: {
      formSubmitted(e) {
        e.preventDefault();
        this.applyFilters();
      },
      resetFilters() {
          this.selectedCityId = -1;
          this.selectedDeveloperId = -1;
          this.price = '';
          this.isOnSale = -1;

          this.applyFilters();
      },
      buildFilters() {
        let filters = {};
        if (this.isOnSale >= 0) {
          filters.isOnSale = this.isOnSale;
        }
        if (this.selectedCityId > 0) {
          filters.city_id = this.selectedCityId;
        }
        if (this.selectedDeveloperId > 0) {
          filters.developer_id = this.selectedDeveloperId;
        }
        if (this.price > 0 && this.price <= 2147483648) {
          filters.price = this.price;
        }

        return filters;
      },
      applyFilters() {
        this.$emit('filters-changed', this.buildFilters());
      },
    },
  };
</script>