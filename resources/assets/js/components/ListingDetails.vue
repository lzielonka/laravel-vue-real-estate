<script>
  import Loader from './Loader';
  export default {
    name: 'ListingDetails',
    components: {
      Loader
    },
    props: ['listing', 'isLoading'],
  };
</script>

<template>
    <div class="modal fade" id="listing-details" tabindex="-1" role="dialog" aria-labelledby="listing-details" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Listing Details</h3>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <Loader v-if="isLoading" v-bind:isLoading="isLoading"/>
                    <div v-else>
                        <div v-if="listing">
                            <div class="col-12">
                                <span><b>Name:</b> {{ listing.name }}</span>
                            </div>
                            <div class="col-12">
                                <span><b>Location:</b> {{ listing.city.name }}, {{ listing.city.country }}</span>
                            </div>
                            <div class="col-12">
                                <span><b>Developer:</b> {{ listing.developer.name}}</span>
                            </div>
                            <div class="col-12">
                                <span><b>Price:</b> {{ listing.price }}</span>
                            </div>
                            <div class="col-12">
                                <span><b>On sale?:</b> {{ listing.isOnSale ? 'Yes' : 'No' }}</span>
                            </div>
                        </div>
                        <div v-else>
                            Listing not found
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>