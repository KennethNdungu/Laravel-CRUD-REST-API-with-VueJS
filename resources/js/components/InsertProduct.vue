<template>
    <div>
        <h1>Add Products</h1>
        <form method="POST" action="/api/products" @submit="AddProducts()">
            <div class="form-group row">
                <input
                    type="text"
                    name="name"
                    v-model="name"
                    class="form-control"
                    placeholder="EnterName"
                    required="name"
                />
            </div>
            <div class="form-group row">
                <input
                    type="text"
                    name="description"
                    v-model="description"
                    class="form-control"
                    placeholder="Enter Description"
                    required="description"
                />
            </div>
            <div class="form-group row">
                <input
                    type="text"
                    name="quantity"
                    v-model="quantity"
                    class="form-control"
                    placeholder="Enter Quantity"
                    required="quantity"
                />
            </div>
            <input type="submit" value="Add Product" class="btn btn-primary" />
        </form>
        <hr />
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            decription: "",
            quantity: ""
        };
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
