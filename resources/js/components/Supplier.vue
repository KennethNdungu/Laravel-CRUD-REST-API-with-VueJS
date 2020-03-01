<template>
    <div v-if="loading">
        <strong>Loading</strong>
    </div>
    <div v-else>
        <InsertSupplier></InsertSupplier>
        <h2>Suppliers</h2>
        <div>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr v-for="supplier in suppliers" v-bind:key="supplier">
                    <td>{{ supplier.id }}</td>
                    <td>{{ supplier.name }}</td>
                    <td>
                        <a
                            href="/api/suppliers/{supplier.id}"
                            class="btn btn-default"
                            >Edit</a
                        >
                    </td>
                    <td>
                        <form
                            action="/api/suppliers/{supplier.id}"
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
            suppliers: [],
            loading: false
        };
    },
    mounted() {
        this.getSuppliers();
    },

    methods: {
        getSuppliers() {
            this.loading = true;
            axios
                .get("http://solutech.com/api/suppliers")
                .then(response => {
                    this.loading = false;
                    this.suppliers = response.data.data;
                })
                .catch(error => {
                    this.loading = false;
                });
        }
    }
};
</script>
