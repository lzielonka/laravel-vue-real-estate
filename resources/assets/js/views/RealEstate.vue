<template>
    <div>
        <ListingForm v-bind:listingFormErrors="listingFormErrors" v-bind:developers="developers" v-bind:cities="cities" v-on:add-form-submitted="addListing"/>
        <ListingsFilter v-bind:developers="developers" v-bind:cities="cities" v-on:filters-changed="updateFilters"/>
        <ListingsList v-bind:listings="listings" v-on:open-details="openDetails"/>
        <ListingDetails v-bind:listing="detailedListing" v-bind:isLoading="listingIsLoading"/>
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
      this.$on('listing-addition-failed', this.parseResponseErrors);
    },
    data() {
      return {
        cities: [],
        developers: [],
        listings: [],
        filters: {},
        detailedListing: null,
        listingIsLoading: true,
        listingFormErrors: [],
      };
    },
    methods: {
      addListing(listing) {
        const request = {
          headers: {'Accept': 'application/json','Content-Type': 'application/json'},
          method: 'POST',
          body: JSON.stringify(listing),
        };
        fetch('/api/listings', request)
          .then(res => res.json().then(content => ({content: content, failed: res.status !== 201})))
          .then(res => {
            if (res.failed) {
                return this.$emit('listing-addition-failed', res.content);
            }
            this.listingFormErrors = [];

            return this.$emit('new-listing-added');
          })
          .catch(res => {
            console.log(res);
        });
      },
      parseResponseErrors(res) {
        this.listingFormErrors = [];
        Object.keys(res).map(key => {
          this.listingFormErrors.push(res[key][0]);
        });
      },
      openDetails(listingId) {
        this.listingIsLoading = true;
        $('#listing-details').modal('show');
        fetch(`/api/listings/${listingId}`)
          .then(res => 404 === res.status ? null : res.json())
          .then(listing => {
            this.listingIsLoading = false;
            this.detailedListing = listing;
        }).catch(err => console.log(err));
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

        return params.length ? '?' + params : '';
      },
    },
  };
</script>