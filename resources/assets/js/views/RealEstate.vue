<template>
    <div>
        <ListingForm v-bind:developers="developers" v-bind:cities="cities" v-on:add-form-submitted="addListing"/>
        <ListingsFilter v-bind:developers="developers" v-bind:cities="cities" v-on:filters-changed="updateFilters"/>
        <ListingsList v-bind:listings="listings" v-on:open-details="openDetails"/>
        <ListingDetails v-bind:listing="detailedListing"/>
    </div>
</template>

<script>
  import ListingForm from '../components/ListingForm';
  import ListingsFilter from '../components/ListingsFilter';
  import ListingsList from '../components/ListingsList';
  import ListingDetails from '../components/ListingDetails';

  export default {
    name: 'RealEstate',
    components: {
      ListingForm,
      ListingsFilter,
      ListingsList,
      ListingDetails,
    },
    created() {
      this.fetchCities();
      this.fetchDevelopers();
      this.fetchListings();
    },
    mounted() {
      this.$on('new-listing-added', this.fetchListings);
      this.$on('new-filters-selected', this.fetchListings);
    },
    data() {
      return {
        cities: [],
        developers: [],
        listings: [],
        filters: {},
        detailedListing: null
      };
    },
    methods: {
      openDetails(listing) {
        this.detailedListing = listing;
        $('#listing-details').modal('show');
      },
      async addListing(listing) {
        const request = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          method: 'POST',
          body: JSON.stringify(listing),
        };
        await fetch('/api/listings', request).catch(res => console.log(res));
        this.$emit('new-listing-added');
      },
      updateFilters(filters) {
        this.filters = filters;
        this.$emit('new-filters-selected');
      },
      fetchCities() {
        fetch('/api/cities').then(res => res.json()).then(cities => {
          this.cities = cities;
        }).catch(err => console.log(err));
      },
      fetchDevelopers() {
        fetch('/api/developers').then(res => res.json()).then(developers => {
          this.developers = developers;
        }).catch(err => console.log(err));
      },
      fetchListings() {
        fetch(`/api/listings${this.encodeFilters()}`).then(res => res.json()).then(listings => {
          this.listings = listings;
        }).catch(err => console.log(err));
      },
      encodeFilters() {
        const params = Object.keys(this.filters).map(key => key + '=' + this.filters[key]).join('&');
        console.log(params);

        return params.length ? '?' + params : '';
      },
    },
  };
</script>