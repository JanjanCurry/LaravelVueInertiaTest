<template>
    <h1>Hello {{ name }}</h1>
    <Nav />
</template>

<script>

    import Nav from  '../Shared/Nav';

    export default {
        props:{
        name: String
        },
        components: { Nav },
    };
</script>