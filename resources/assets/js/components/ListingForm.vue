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
                    </div>
                    <div class="form-group">
                        <label for="city">Developer</label>
                        <select class="form-control" v-model="selectedDeveloperId" name="developer" id="developer">
                            <option v-for="developer in developers" :selected="selectedDeveloperId === developer.id"
                                    v-bind:value="developer.id">{{ developer.name }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" class="form-control" type="text" v-model="name" name="name" placeholder="Property name...">
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input id="price" class="form-control" type="number" min="1" max="2147483648" v-model="price" name="price" placeholder="Property price...">
                    </div>
                    <div class="form-group">
                        <label for="isOnSale">Is on sale</label>
                        <select class="form-control" v-model="isOnSale" name="isOnSale" id="isOnSale">
                            <option value="0" :selected="isOnSale === 0">No</option>
                            <option value="1" :selected="isOnSale === 1">Yes</option>
                        </select>
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
    props: ['developers', 'cities'],
    data() {
      return {
        selectedCityId: -1,
        selectedDeveloperId: -1,
        name: '',
        price: '',
        isOnSale: 0,
      };
    },
    methods: {
      clearInputs() {
        this.name = '';
        this.price = '';
      },
      isFormValid() {
        return (
            this.selectedDeveloperId > 0 &&
            this.selectedCityId > 0 &&
            this.price > 0 &&
            this.price <= 2147483648 &&
            this.name.length > 5
        );
      },
      formSubmitted(e) {
        e.preventDefault();
        if (!this.isFormValid()) {
          return false;
        }

        const listing = {
          name: this.name,
          price: this.price,
          isOnSale: this.isOnSale,
          city_id: this.selectedCityId,
          developer_id: this.selectedDeveloperId,
        };

        this.clearInputs();
        this.$emit('add-form-submitted', listing);
      },
    },
  };
</script>