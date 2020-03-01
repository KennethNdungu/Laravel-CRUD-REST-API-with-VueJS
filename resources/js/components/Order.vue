<template>
    <div v-if="loading">
        <strong>Loading</strong>
    </div>
    <div v-else>
        <InsertOrder></InsertOrder>
        <h2>Orders</h2>
        <div>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Order No.</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr v-for="order in orders" v-bind:key="order">
                    <td>{{ order.id }}</td>
                    <td>{{ order.order_number }}</td>
                    <td><a class="btn btn-default">Edit</a></td>
                    <td>
                        <form action="/api/orders/{orders.id}" method="POST">
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
            orders: [],
            loading: false
        };
    },
    mounted() {
        this.getOrders();
    },

    methods: {
        getOrders() {
            this.loading = true;
            axios
                .get("http://solutech.com/api/orders")
                .then(response => {
                    this.loading = false;
                    this.orders = response.data.data;
                })
                .catch(error => {
                    this.loading = false;
                });
        }
    }
};
</script>
