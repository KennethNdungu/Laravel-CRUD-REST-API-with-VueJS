<template>
    <div v-if="loading">
        <strong>Loading</strong>
    </div>

    <div v-else>
        <InsertProduct></InsertProduct>

        <h2>Product List</h2>
        <div>
            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr v-for="product in products" v-bind:key="product">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.quantity }}</td>
                    <td>
                        <a
                            href="/api/products/{product.id}"
                            class="btn btn-default"
                            >Edit</a
                        >
                    </td>
                    <td>
                        <form
                            action="/api/products/{products.id}"
                            method="POST"
                        >
                            <input
                                type="hidden"
                                name="_method"
                                value="DELETE"
                            />

                            <!-- delete button -->
                            <button
                                type="submit"
                                class="btn btn-danger float-right"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [],
            loading: false
        };
    },
    mounted() {
        this.getProducts();
    },

    methods: {
        getProducts() {
            this.loading = true;
            axios
                .get("http://solutech.com/api/products")
                .then(response => {
                    this.loading = false;
                    this.products = response.data.data;
                })
                .catch(error => {
                    this.loading = false;
                });
        }
    }
};
</script>
