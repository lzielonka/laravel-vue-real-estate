<template>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Country</th>
                    <th>Price</th>
                    <th>On sale</th>
                </tr>
            </thead>
            <tbody>
                <tr class="card card-body mb-2" v-for="listing in listings" v-bind:key="listing.id">
                    <td>{{ listing.id }}</td>
                    <td>{{ listing.name }}</td>
                    <td>{{ listing.city.country }}</td>
                    <td>{{ listing.price }}</td>
                    <td>{{ listing.isOnSale }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        listings: [],
      };
    },

    created() {
      this.fetchListings();
    },

    methods: {
      fetchListings() {
        fetch('/api/listings')
        .then(res => res.json())
        .then(res => {
          this.listings = res;
        })
        .catch(err => console.log(err));
      },
    }
  };
</script>