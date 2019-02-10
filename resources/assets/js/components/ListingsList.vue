<template>
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Available listings</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Developer</th>
                            <th>Price</th>
                            <th>On sale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="listing in listings" v-bind:key="listing.id" v-on:click="showDetails(listing.id)">
                            <td>{{ listing.id }}</td>
                            <td>{{ listing.name }}</td>
                            <td>{{ listing.city.name }}, {{ listing.city.country }}</td>
                            <td>{{ listing.developer.name }}</td>
                            <td>{{ listing.price }}</td>
                            <td>{{ listing.isOnSale }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ListingList',
    props: ['listings'],
    methods: {
      showDetails(listingId) {
        this.$emit('open-details', listingId);
      }
    }
  };
</script>
<style scoped>
    tr {
        cursor: pointer;
    }
</style>