<template>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Add new listing</div>
            <div class="panel-body">
                <form @submit="formSubmitted">
                    <div class="form-group">
                        <label for="city">Location</label>
                        <select class="form-control" v-model="selectedCityId" name="city" id="city">
                            <option v-for="city in cities" :selected="selectedCityId === city.id" v-bind:value="city.id">
                                {{ city.name }}, {{ city.country }}
                            </option>
                        </select>
                        <span class="form-error" v-show="cityError.length">{{ cityError }}</span>
                    </div>
                    <div class="form-group">
                        <label for="developer">Developer</label>
                        <select class="form-control" v-model="selectedDeveloperId" name="developer" id="developer">
                            <option v-for="developer in developers" :selected="selectedDeveloperId === developer.id"
                                    v-bind:value="developer.id">{{ developer.name }}
                            </option>
                        </select>
                        <span class="form-error" v-show="developerError.length">{{ developerError }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input  id="name" class="form-control" type="text" v-model="name" name="name" placeholder="Property name...">
                        <span class="form-error" v-show="nameError.length">{{ nameError }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input id="price" class="form-control" type="number" min="1" max="2147483648" v-model="price" name="price" placeholder="Property price...">
                        <span class="form-error" v-show="priceError.length">{{ priceError }}</span>
                    </div>
                    <div class="form-group">
                        <label for="isOnSale">Is on sale</label>
                        <select class="form-control" v-model="isOnSale" name="isOnSale" id="isOnSale">
                            <option value="0" :selected="isOnSale === 0">No</option>
                            <option value="1" :selected="isOnSale === 1">Yes</option>
                        </select>
                    </div>
                    <div class="form-error m-b text-center" v-if="listingFormErrors.length">
                        <h4><strong>Listing addition failed:</strong></h4>
                        <div class="col-12" v-for="error in listingFormErrors">
                            <span>- {{ error }}</span>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ListingForm',
    props: ['developers', 'cities', 'listingFormErrors'],
    data() {
      return {
        selectedCityId: -1,
        selectedDeveloperId: -1,
        name: '',
        price: '',
        isOnSale: 0,
        nameError: '',
        priceError: '',
        developerError: '',
        cityError: '',
      };
    },
    methods: {
      clearInputs() {
        this.name = '';
        this.price = '';
      },
      isFormValid() {
        this.nameError = this.priceError = this.cityError = this.developerError = '';

        if (this.name.length < 5) {
          this.nameError = 'Name must be at least 5 characters long.';
        }
        if (this.name.length > 191) {
          this.nameError = 'Maximum allowed name length is 191 characters.';
        }
        if (this.selectedDeveloperId < 1) {
          this.developerError = 'Please select a developer.';
        }
        if (this.selectedCityId < 1) {
          this.cityError = 'Please select a city.';
        }
        if (this.price < 1) {
          this.priceError = 'Minimum allowed price is 1';
        }
        if (this.price > 2147483648) {
          this.priceError = 'Maximum allowed price is 2147483648';
        }

        return 0 === (this.developerError + this.cityError + this.nameError + this.priceError).length;
      },
      formSubmitted(e) {
        e.preventDefault();
        if (!this.isFormValid()) {
          return false;
        }
        const listing = {
          name: this.name,
          price: parseInt(this.price),
          isOnSale: parseInt(this.isOnSale),
          city_id: this.selectedCityId,
          developer_id: this.selectedDeveloperId,
        };
        this.clearInputs();
        this.$emit('add-form-submitted', listing);
      },
    },
  };
</script>

<style scoped>
    .form-error {
        color: #ff5f62;
    }
</style>